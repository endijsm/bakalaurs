<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\StudyCourse;
use App\IndependentTask;
use App\User;
use App\TypeOfTest;
use App\BasicLiterature;
use App\AdditionalLiterature;
use App\OtherInformationSource;
use App\StudyProgram;
use App\Faculty;
use App\StudyProgramPart;
use App\StudyCourseResult;
use App\AdditionalStudyCourseResult;
use App\Evaluation;
use App\StudyCourseSubject;
use App\StudyProgramResult;
use App\CalendarPlan;
use Auth;

class StudyCoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('canAddCourseDescriptions', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('canViewCourseDescriptions', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'courses' => StudyCourse::paginate(10), // should be changed later to at least 20
            'number_of_added_courses' => StudyCourse::count(),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
            'paginate' => 1, // courses should be paginated (variable is set to 1 - true)
            'search' => 0 // search is not made (variable is set to 0 - false)
        ];

        return view('courses.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data = [
            //'lecturers' => Lecturer::all()->pluck('select_option', 'id'),
            'lecturers' => User::where('is_lecturer','1')->get()->pluck('select_option', 'id'),
            'types_of_tests' => TypeOfTest::pluck('type_of_test', 'id'),
            'study_program_parts' => StudyProgramPart::pluck('part', 'id'),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
            'study_program_results' => StudyProgramResult::all()->pluck('select_option', 'id'),
        ];
        
        return view('courses.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input());

        $c_course = 0;

        // if course IS c course
        if($request->has('c_courses_chbox'))
        {
            $c_course = 1;
            $this->validate($request, [
                'course_name' => 'required',
                'course_name_eng' => Rule::requiredIf(!$request->has('eng_chbox')), // field is not required if eng_chbox is checked
                'lecturers' => 'required|array|min:1',
                'LAIS_code' => 'required',
                'type_of_test' => 'required',
                'kp' => 'required|integer|min:1|max:20',
                'number_of_lectures' => 'required|integer|min:0|max:100',
                'number_of_seminars' => 'required|integer|min:0|max:100',
                'prerequisites' => 'required',
                'study_program_part' => 'required',
                'objective' => 'required',
                'additional_course_results' => 'required|array|min:1',
                'additional_course_results.*' => 'required|string|min:3',
                'independent_tasks' => 'required|array|min:1',
                'independent_tasks.*' => 'required|string|min:3',
                'percent' => 'required|array|min:1',
                'percent.*' => 'required|integer|min:1|max:100',
                'evaluation' => 'required|array|min:1',
                'evaluation.*' => 'required|string|min:3',
                'course_subjects' => 'required|array|min:1',
                'course_subjects.*' => 'required|string|min:3',
                'calendar_plan_lecture_num' => 'required|array|min:1',
                'calendar_plan_lecture_num.*' => 'required|string|min:1',
                'calendar_plan_subject' => 'required|array|min:1',
                'calendar_plan_subject.*' => 'required|string|min:3',
                'calendar_plan_type' => 'required|array|min:1',
                'calendar_plan_type.*' => 'required|string|min:3',
                'basic_literature' => 'required|array|min:1',
                'basic_literature.*' => 'required|string|min:3'      
            ], [
                'course_name.required' => "Nav aizpildīts lauks 'Kursa nosaukums' !",
                'course_name_eng.required' => "Nav aizpildīts lauks 'Kursa nosaukums angļu valodā' !",
                'lecturers.required' => "Nav norādīts neviens pasniedzējs!",
                'LAIS_code.required' => "Nav aizpildīts lauks 'LAIS kods' !",
                'type_of_test.required' => "Nav norādīta pārbaudes forma!",
                'kp.required' => "Nav aizpildīts lauks 'Kredītpunkti' !",
                'kp.integer' => "Ievades laukā 'Kredītpunkti' jāievada skaitlis!",
                'kp.min' => "Nepareizi aizpildīts lauks 'Kredītpunkti' !",
                'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
                'number_of_lectures.required' => "Nav aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.integer' => "Ievades laukā 'Lekciju skaits' jāievada skaitlis!",
                'number_of_lectures.min' => "Nepareizi aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.max' => "Ievadītais lekciju skaits ir pārāk liels!",
                'number_of_seminars.required' => "Nav aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.integer' => "Ievades laukā 'Praktisko nodarbību skaits' jāievada skaitlis!",
                'number_of_seminars.min' => "Nepareizi aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.max' => "Ievadītais praktisko nodarbību skaits ir pārāk liels!",
                'prerequisites.required' => "Nav aizpildīts lauks 'Nepieciešamās zināšanas kursa uzsākšanai' !",
                'study_program_part.required' => "Nav norādīta studiju programmas daļa!",
                'objective.required' => "Nav aizpildīts lauks 'Studiju kursa mērķis' !",
                'additional_course_results.*.required' => "Nav pievienots studiju kursa rezultāts!",
                'additional_course_results.*.min' => "Pievienotais studiju kursa rezultāts ir pārāk īss!",
                'independent_tasks.*.required' => "Nav pievienots studējošo patstāvīgā darba organizācijas veids' !",
                'independent_tasks.*.min' => "Ieraksts laukā 'Patstāvīgā darba organizācijas veids' ir pārāk īss!",
                'percent.*.required' => "Nav norādīti procenti sadaļā 'Studiju rezultātu vērtēšana' !",
                'percent.*.integer' => "Procenti sadaļā 'Studiju rezultātu vērtēšana' jāievada kā skaitlis!",
                'percent.*.min' => "Ievadītajai procentu vērtībai sadaļā 'Studiju rezultātu vērtēšana' jābūtu vismaz 1!",
                'percent.*.max' => "Ievadītā procentu vērtība sadaļā 'Studiju rezultātu vērtēšana' nevar būt lielāka par 100!",
                'evaluation.*.required' => "Nav norādīts novērtējuma veids sadaļā 'Studiju rezultātu vērtēšana' !",
                'evaluation.*.min' => "Ieraksts laukā 'Novērtējuma veids' ir pārāk īss!",
                'course_subjects.*.required' => "Nav pievienota neviena tēma sadaļā 'Studiju kursa saturs' !",
                'course_subjects.*.min' => "Ieraksts laukā 'Tēmas nosaukums' ir pārāk īss!",
                'calendar_plan_lecture_num.*.required' => "Nav norādīts nodarbības numurs sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.required' => "Nav norādīta nodarbīas tēma sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.min' => "Ieraksts laukā 'Tēmas nosaukums (kalendārais plāns)' ir pārāk īss!",
                'calendar_plan_type.*.required' => "Nav norādīts nodarbības veids sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_type.*.min' => "Ieraksts laukā 'Nodarbības veids (kalendārais plāns)' ir pārāk īss!",
                'basic_literature.*.required' => "Nav pievienots pamatliteratūras ieraksts!",
                'basic_literature.*.min' => "Ieraksts laukā 'Pamatliteratūra' ir pārāk īss!",
            ]);
        }
        else // if course IS NOT c course
        {
            $this->validate($request, [
                'faculty' => 'required',
                'study_program' => 'required|array|min:1',
                'course_name' => 'required',
                'course_name_eng' => Rule::requiredIf(!$request->has('eng_chbox')), // field is not required if eng_chbox is checked
                'lecturers' => 'required|array|min:1',
                'LAIS_code' => 'required',
                'type_of_test' => 'required',
                'kp' => 'required|integer|min:1|max:20',
                'number_of_lectures' => 'required|integer|min:0|max:100',
                'number_of_seminars' => 'required|integer|min:0|max:100',
                'prerequisites' => 'required',
                'study_program_part' => 'required',
                'objective' => 'required',
                'course_results' => 'nullable|array',
                'independent_tasks' => 'required|array|min:1',
                'independent_tasks.*' => 'required|string|min:3',
                'percent' => 'required|array|min:1',
                'percent.*' => 'required|integer|min:1|max:100',
                'evaluation' => 'required|array|min:1',
                'evaluation.*' => 'required|string|min:3',
                'course_subjects' => 'required|array|min:1',
                'course_subjects.*' => 'required|string|min:3',
                'calendar_plan_lecture_num' => 'required|array|min:1',
                'calendar_plan_lecture_num.*' => 'required|string|min:1',
                'calendar_plan_subject' => 'required|array|min:1',
                'calendar_plan_subject.*' => 'required|string|min:3',
                'calendar_plan_type' => 'required|array|min:1',
                'calendar_plan_type.*' => 'required|string|min:3',
                'basic_literature' => 'required|array|min:1',
                'basic_literature.*' => 'required|string|min:3',       
            ],[
                'faculty.required' => 'Nav norādīta fakultāte!',
                'study_program.required' => "Nav norādīta neviena atbilstošā studiju programma!",
                'course_name.required' => "Nav aizpildīts lauks 'Kursa nosaukums' !",
                'course_name_eng.required' => "Nav aizpildīts lauks 'Kursa nosaukums angļu valodā' !",
                'lecturers.required' => "Nav norādīts neviens pasniedzējs!",
                'LAIS_code.required' => "Nav aizpildīts lauks 'LAIS kods' !",
                'type_of_test.required' => "Nav norādīta pārbaudes forma!",
                'kp.required' => "Nav aizpildīts lauks 'Kredītpunkti' !",
                'kp.integer' => "Ievades laukā 'Kredītpunkti' jāievada skaitlis!",
                'kp.min' => "Nepareizi aizpildīts lauks 'Kredītpunkti' !",
                'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
                'number_of_lectures.required' => "Nav aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.integer' => "Ievades laukā 'Lekciju skaits' jāievada skaitlis!",
                'number_of_lectures.min' => "Nepareizi aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.max' => "Ievadītais lekciju skaits ir pārāk liels!",
                'number_of_seminars.required' => "Nav aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.integer' => "Ievades laukā 'Praktisko nodarbību skaits' jāievada skaitlis!",
                'number_of_seminars.min' => "Nepareizi aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.max' => "Ievadītais praktisko nodarbību skaits ir pārāk liels!",
                'prerequisites.required' => "Nav aizpildīts lauks 'Nepieciešamās zināšanas kursa uzsākšanai' !",
                'study_program_part.required' => "Nav norādīta studiju programmas daļa!",
                'objective.required' => "Nav aizpildīts lauks 'Studiju kursa mērķis' !",
                'independent_tasks.*.required' => "Nav pievienots studējošo patstāvīgā darba organizācijas veids' !",
                'independent_tasks.*.min' => "Ieraksts laukā 'Patstāvīgā darba organizācijas veids' ir pārāk īss!",
                'percent.*.required' => "Nav norādīti procenti sadaļā 'Studiju rezultātu vērtēšana' !",
                'percent.*.integer' => "Procenti sadaļā 'Studiju rezultātu vērtēšana' jāievada kā skaitlis!",
                'percent.*.min' => "Ievadītajai procentu vērtībai sadaļā 'Studiju rezultātu vērtēšana' jābūtu vismaz 1!",
                'percent.*.max' => "Ievadītā procentu vērtība sadaļā 'Studiju rezultātu vērtēšana' nevar būt lielāka par 100!",
                'evaluation.*.required' => "Nav norādīts novērtējuma veids sadaļā 'Studiju rezultātu vērtēšana' !",
                'evaluation.*.min' => "Ieraksts laukā 'Novērtējuma veids' ir pārāk īss!",
                'course_subjects.*.required' => "Nav pievienota neviena tēma sadaļā 'Studiju kursa saturs' !",
                'course_subjects.*.min' => "Ieraksts laukā 'Tēmas nosaukums' ir pārāk īss!",
                'calendar_plan_lecture_num.*.required' => "Nav norādīts nodarbības numurs sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.required' => "Nav norādīta nodarbīas tēma sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.min' => "Ieraksts laukā 'Tēmas nosaukums (kalendārais plāns)' ir pārāk īss!",
                'calendar_plan_type.*.required' => "Nav norādīts nodarbības veids sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_type.*.min' => "Ieraksts laukā 'Nodarbības veids (kalendārais plāns)' ir pārāk īss!",
                'basic_literature.*.required' => "Nav pievienots pamatliteratūras ieraksts!",
                'basic_literature.*.min' => "Ieraksts laukā 'Pamatliteratūra' ir pārāk īss!",
            ]);
        }
        if(($request->input('results_rb') == 'direct_results') && !$c_course)
        {
            $program_results = $request->input('program_results');
            if(empty($program_results))
            {
                return back()->withErrors('Nav pievienots neviens studiju programmas studiju rezultāts!')->withInput();
            }
        }
        if(($request->input('results_rb') == 'linked_results') && !$c_course)
        {
            $course_results = $request->input('course_results');
            foreach($course_results as $course_result)
            {
                if($course_result == null)
                {
                    return back()->withErrors('Pārbaudiet studiju rezultātu ievades laukus! Vismaz 1 tukšs ievades lauks!')->withInput();
                }
            }
        }

        // Create Study Course
        $course = new StudyCourse;
        $course->name = $request->input('course_name');
        $course->name_eng = $request->input('course_name_eng');
        $course->LAIS_code = $request->input('LAIS_code');
        $course->type_of_test_id = $request->input('type_of_test');
        $course->kp = $request->input('kp');
        $course->number_of_lectures = $request->input('number_of_lectures');
        $course->number_of_seminars = $request->input('number_of_seminars');
        $course->prerequisites = $request->input('prerequisites');
        $course->study_program_part_id = $request->input('study_program_part');
        $course->objective = $request->input('objective');
        $course->author_id = auth()->user()->id;
        $course->faculty_id = $request->input('faculty');
        if($request->has('c_courses_chbox'))
        {
            $course->c_course = 1;
            $course->faculty_id = 0;
        }
        if($request->has('eng_chbox'))
        {
            $course->eng = 1;
        }
        if($request->input('results_rb') == 'direct_results')
        {
            $course->direct_results = 1;
        }
        else
        {
            $course->direct_results = 0;
        }
        $course->save();

        // Lecturers
        $lecturers_to_add = $request->input('lecturers');
        foreach($lecturers_to_add as $lecturer_to_add)
        {
            if(!empty($lecturer_to_add))
            {   
                $lecturer = User::find($lecturer_to_add);
                $course->lecturers()->save($lecturer);
            }
        }

        // Study Course Results

        if($request->has('c_courses_chbox')) // add study course results for c course
        {
            $course_results = $request->input('additional_course_results');
            foreach($course_results as $course_result)
            {
                if(!empty($course_result))
                {     
                    $new_course_result = new AdditionalStudyCourseResult();
                    $new_course_result->result=$course_result;
                    $new_course_result->study_course_id = $course->id;
                    $new_course_result->save();       
                }
            }
        }
        else // course is not c course
        {
            // direct results
            if($course->direct_results) 
            {
                // Study Program Results
                $study_program_results = $request->input('program_results');
                if(!empty($study_program_results))
                {
                    foreach($study_program_results as $study_program_result)
                    {
                        if(!empty($study_program_result))
                        {   
                            $program_result = StudyProgramResult::find($study_program_result);
                            $course->study_program_results()->save($program_result);
                        }
                    }
                }
                // add optional course results
                $course_results = $request->input('additional_course_results');
                if(!empty($course_results))
                {
                    foreach($course_results as $course_result)
                    {
                        if(!empty($course_result))
                        {     
                            $new_course_result = new AdditionalStudyCourseResult();
                            $new_course_result->result=$course_result;
                            $new_course_result->study_course_id = $course->id;
                            $new_course_result->save();       
                        }
                    }
                }
            }
            else // linked results - link each course result to one or many study program result/results
            {
                $course_results = $request->input('course_results');
                $numberOfLinkedProgramResults = $request->input('number_of_program_results');
            
                $i=1;
                for($i; $i <= $numberOfLinkedProgramResults; $i++)
                {
                    $new_course_result = new StudyCourseResult();
                    $new_course_result->result=$course_results[$i-1];
                    $new_course_result->study_course_id = $course->id;
                    $new_course_result->save();

                    $study_program_results = $request->input('program_results'.$i);
                    if(!empty($study_program_results))
                    {
                        foreach($study_program_results as $study_program_result)
                        {
                            if(!empty($study_program_result))
                            {   
                                $program_result = StudyProgramResult::find($study_program_result);
                                $new_course_result->study_program_results()->save($program_result); // link course result with study program result
                                //$course->study_program_results()->save($program_result); // no reason to save result as study program result because
                                                                                            // it is already linked to specific course result
                            }
                        }
                    }
                }
                // input has optional course results which are not linked to study program results
                $additional_course_results = $request->input('additional_course_results');
                foreach($additional_course_results as $additional_course_result)
                {
                    if(!empty($additional_course_result))
                    {     
                        $new_course_result = new AdditionalStudyCourseResult();
                        $new_course_result->result=$additional_course_result;
                        $new_course_result->study_course_id = $course->id;
                        $new_course_result->save();       
                    }
                }
            }
        }

        // Independent Tasks
        $independent_tasks = $request->input('independent_tasks');
        foreach($independent_tasks as $independent_task)
        {
            if(!empty($independent_task))
            {     
                $new_independent_task = new IndependentTask();
                $new_independent_task->task=$independent_task;
                $new_independent_task->study_course_id = $course->id;
                $new_independent_task->save();       
            }
        }
        //$independent_task = new IndependentTask;;
        //$independent_task->task = $request->input('independent_task');
        //$course->independent_tasks()->save($independent_task);


        // Evaluation
        $percent = $request->input('percent');
        $evaluation = $request->input('evaluation');
        for($i=0; $i < count($evaluation); $i++)
        {
            $new_evaluation = new Evaluation();
            $new_evaluation->percent=$percent[$i];
            $new_evaluation->type_of_evaluation=$evaluation[$i];
            $new_evaluation->study_course_id = $course->id;
            $new_evaluation->save();
        }

        // Study Course Subjects
        $course_subjects = $request->input('course_subjects');
        foreach($course_subjects as $course_subject)
        {
            if(!empty($course_subject))
            {
                $new_course_subject = new StudyCourseSubject();
                $new_course_subject->subject = $course_subject;
                $new_course_subject->study_course_id = $course->id;
                $new_course_subject->save();
            }
        }

        // Calendar plan
        $lecture_number = $request->input('calendar_plan_lecture_num');
        $subject = $request->input('calendar_plan_subject');
        $type = $request->input('calendar_plan_type');

        for($i=0; $i < count($subject); $i++)
        {
            $new_calendar_plan = new CalendarPlan;
            $new_calendar_plan->lecture_num=$lecture_number[$i];
            $new_calendar_plan->subject=$subject[$i];
            $new_calendar_plan->type_of_lecture=$type[$i];
            $new_calendar_plan->study_course_id = $course->id;
            $new_calendar_plan->save();
        }

        // Basic literature
        $basic_literatures = $request->input('basic_literature');
        foreach($basic_literatures as $basic_literature)
        {
            if(!empty($basic_literature))
            {
                $new_basic_literature = new BasicLiterature;
                $new_basic_literature->name = $basic_literature;
                $new_basic_literature->study_course_id = $course->id;
                $new_basic_literature->save();
            }
        }

        // Additional literature
        $additional_literatures = $request->input('additional_literature');
        foreach($additional_literatures as $additional_literature)
        {
            if(!empty($additional_literature))
            {
                $new_additional_literature = new AdditionalLiterature;
                $new_additional_literature->name = $additional_literature;
                $new_additional_literature->study_course_id = $course->id;
                $new_additional_literature->save();
            }
        }

        // Other Information Sources
        $other_information_sources = $request->input('other_information_sources');
        foreach($other_information_sources as $other_information_source)
        {
            if(!empty($other_information_source))
            {
                $new_other_information_source = new OtherInformationSource;
                $new_other_information_source->name = $other_information_source;
                $new_other_information_source->study_course_id = $course->id;
                $new_other_information_source->save();
            }
        }

        if(!$request->has('c_courses_chbox')) // set study programs only if course is not C course
        {
            // Study Program
            $study_programs = $request->input('study_program');
            foreach($study_programs as $study_program)
            {
                if(!empty($study_program))
                {   
                    $program_to_add = StudyProgram::find($study_program);
                    $course->study_programs()->save($program_to_add);
                }
            }
        }
        
        return redirect('/courses')->with('success', 'Studiju kurss pievienots veiksmīgi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = StudyCourse::findOrFail($id);
        if($course->eng)
        {
            return view('courses.show_eng')->with('course', $course);
        }

        return view('courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // only course description authors and users with higher priviledges than lecturers can edit course descriptions
        $study_course = StudyCourse::findOrFail($id);
        if(Auth::user()->is_lecturer && Auth::user()->id != $study_course->author->id)
        {
            return redirect()->back()->with('error', 'Jūs nevarat labot šo kursa aprakstu!');
        }

        $data = [
            'course' => $study_course,
            'lecturers' => User::where('is_lecturer','1')->get()->pluck('select_option', 'id'),
            'types_of_tests' => TypeOfTest::pluck('type_of_test', 'id'),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
            'study_program_parts' => StudyProgramPart::pluck('part', 'id'),
            'study_program_results' => StudyProgramResult::all()->pluck('select_option', 'id'),
        ];
        
        return view('courses.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->input());

        $c_course = 0;

        // if course IS c course
        if($request->has('c_courses_chbox'))
        {
            $c_course = 1;
            $this->validate($request, [
                'course_name' => 'required',
                'course_name_eng' => Rule::requiredIf(!$request->has('eng_chbox')), // field is not required if eng_chbox is checked
                'lecturers' => 'required|array|min:1',
                'LAIS_code' => 'required',
                'type_of_test' => 'required',
                'kp' => 'required|integer|min:1|max:20',
                'number_of_lectures' => 'required|integer|min:0|max:100',
                'number_of_seminars' => 'required|integer|min:0|max:100',
                'prerequisites' => 'required',
                'study_program_part' => 'required',
                'objective' => 'required',
                'additional_course_results' => 'required|array|min:1',
                'additional_course_results.*' => 'required|string|min:3',
                'independent_tasks' => 'required|array|min:1',
                'independent_tasks.*' => 'required|string|min:3',
                'percent' => 'required|array|min:1',
                'percent.*' => 'required|integer|min:1|max:100',
                'evaluation' => 'required|array|min:1',
                'evaluation.*' => 'required|string|min:3',
                'course_subjects' => 'required|array|min:1',
                'course_subjects.*' => 'required|string|min:3',
                'calendar_plan_lecture_num' => 'required|array|min:1',
                'calendar_plan_lecture_num.*' => 'required|string|min:1',
                'calendar_plan_subject' => 'required|array|min:1',
                'calendar_plan_subject.*' => 'required|string|min:3',
                'calendar_plan_type' => 'required|array|min:1',
                'calendar_plan_type.*' => 'required|string|min:3',
                'basic_literature' => 'required|array|min:1',
                'basic_literature.*' => 'required|string|min:3'      
            ], [
                'course_name.required' => "Nav aizpildīts lauks 'Kursa nosaukums' !",
                'course_name_eng.required' => "Nav aizpildīts lauks 'Kursa nosaukums angļu valodā' !",
                'lecturers.required' => "Nav norādīts neviens pasniedzējs!",
                'LAIS_code.required' => "Nav aizpildīts lauks 'LAIS kods' !",
                'type_of_test.required' => "Nav norādīta pārbaudes forma!",
                'kp.required' => "Nav aizpildīts lauks 'Kredītpunkti' !",
                'kp.integer' => "Ievades laukā 'Kredītpunkti' jāievada skaitlis!",
                'kp.min' => "Nepareizi aizpildīts lauks 'Kredītpunkti' !",
                'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
                'number_of_lectures.required' => "Nav aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.integer' => "Ievades laukā 'Lekciju skaits' jāievada skaitlis!",
                'number_of_lectures.min' => "Nepareizi aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.max' => "Ievadītais lekciju skaits ir pārāk liels!",
                'number_of_seminars.required' => "Nav aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.integer' => "Ievades laukā 'Praktisko nodarbību skaits' jāievada skaitlis!",
                'number_of_seminars.min' => "Nepareizi aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.max' => "Ievadītais praktisko nodarbību skaits ir pārāk liels!",
                'prerequisites.required' => "Nav aizpildīts lauks 'Nepieciešamās zināšanas kursa uzsākšanai' !",
                'study_program_part.required' => "Nav norādīta studiju programmas daļa!",
                'objective.required' => "Nav aizpildīts lauks 'Studiju kursa mērķis' !",
                'additional_course_results.*.required' => "Nav pievienots studiju kursa rezultāts!",
                'additional_course_results.*.min' => "Pievienotais studiju kursa rezultāts ir pārāk īss!",
                'independent_tasks.*.required' => "Nav pievienots studējošo patstāvīgā darba organizācijas veids' !",
                'independent_tasks.*.min' => "Ieraksts laukā 'Patstāvīgā darba organizācijas veids' ir pārāk īss!",
                'percent.*.required' => "Nav norādīti procenti sadaļā 'Studiju rezultātu vērtēšana' !",
                'percent.*.integer' => "Procenti sadaļā 'Studiju rezultātu vērtēšana' jāievada kā skaitlis!",
                'percent.*.min' => "Ievadītajai procentu vērtībai sadaļā 'Studiju rezultātu vērtēšana' jābūtu vismaz 1!",
                'percent.*.max' => "Ievadītā procentu vērtība sadaļā 'Studiju rezultātu vērtēšana' nevar būt lielāka par 100!",
                'evaluation.*.required' => "Nav norādīts novērtējuma veids sadaļā 'Studiju rezultātu vērtēšana' !",
                'evaluation.*.min' => "Ieraksts laukā 'Novērtējuma veids' ir pārāk īss!",
                'course_subjects.*.required' => "Nav pievienota neviena tēma sadaļā 'Studiju kursa saturs' !",
                'course_subjects.*.min' => "Ieraksts laukā 'Tēmas nosaukums' ir pārāk īss!",
                'calendar_plan_lecture_num.*.required' => "Nav norādīts nodarbības numurs sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.required' => "Nav norādīta nodarbīas tēma sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.min' => "Ieraksts laukā 'Tēmas nosaukums (kalendārais plāns)' ir pārāk īss!",
                'calendar_plan_type.*.required' => "Nav norādīts nodarbības veids sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_type.*.min' => "Ieraksts laukā 'Nodarbības veids (kalendārais plāns)' ir pārāk īss!",
                'basic_literature.*.required' => "Nav pievienots pamatliteratūras ieraksts!",
                'basic_literature.*.min' => "Ieraksts laukā 'Pamatliteratūra' ir pārāk īss!",
            ]);
        }
        else // if course IS NOT c course
        {
            $this->validate($request, [
                'faculty' => 'required',
                'study_programs' => 'required|array|min:1',
                'course_name' => 'required',
                'course_name_eng' => Rule::requiredIf(!$request->has('eng_chbox')), // field is not required if eng_chbox is checked
                'lecturers' => 'required|array|min:1',
                'LAIS_code' => 'required',
                'type_of_test' => 'required',
                'kp' => 'required|integer|min:1|max:20',
                'number_of_lectures' => 'required|integer|min:0|max:100',
                'number_of_seminars' => 'required|integer|min:0|max:100',
                'prerequisites' => 'required',
                'study_program_part' => 'required',
                'objective' => 'required',
                'course_results' => 'nullable|array',
                'independent_tasks' => 'required|array|min:1',
                'independent_tasks.*' => 'required|string|min:3',
                'percent' => 'required|array|min:1',
                'percent.*' => 'required|integer|min:1|max:100',
                'evaluation' => 'required|array|min:1',
                'evaluation.*' => 'required|string|min:3',
                'course_subjects' => 'required|array|min:1',
                'course_subjects.*' => 'required|string|min:3',
                'calendar_plan_lecture_num' => 'required|array|min:1',
                'calendar_plan_lecture_num.*' => 'required|string|min:1',
                'calendar_plan_subject' => 'required|array|min:1',
                'calendar_plan_subject.*' => 'required|string|min:3',
                'calendar_plan_type' => 'required|array|min:1',
                'calendar_plan_type.*' => 'required|string|min:3',
                'basic_literature' => 'required|array|min:1',
                'basic_literature.*' => 'required|string|min:3',       
            ],[
                'faculty.required' => 'Nav norādīta fakultāte!',
                'study_programs.required' => "Nav norādīta neviena atbilstošā studiju programma!",
                'course_name.required' => "Nav aizpildīts lauks 'Kursa nosaukums' !",
                'course_name_eng.required' => "Nav aizpildīts lauks 'Kursa nosaukums angļu valodā' !",
                'lecturers.required' => "Nav norādīts neviens pasniedzējs!",
                'LAIS_code.required' => "Nav aizpildīts lauks 'LAIS kods' !",
                'type_of_test.required' => "Nav norādīta pārbaudes forma!",
                'kp.required' => "Nav aizpildīts lauks 'Kredītpunkti' !",
                'kp.integer' => "Ievades laukā 'Kredītpunkti' jāievada skaitlis!",
                'kp.min' => "Nepareizi aizpildīts lauks 'Kredītpunkti' !",
                'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
                'number_of_lectures.required' => "Nav aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.integer' => "Ievades laukā 'Lekciju skaits' jāievada skaitlis!",
                'number_of_lectures.min' => "Nepareizi aizpildīts lauks 'Lekciju skaits' !",
                'number_of_lectures.max' => "Ievadītais lekciju skaits ir pārāk liels!",
                'number_of_seminars.required' => "Nav aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.integer' => "Ievades laukā 'Praktisko nodarbību skaits' jāievada skaitlis!",
                'number_of_seminars.min' => "Nepareizi aizpildīts lauks 'Praktisko nodarbību skaits' !",
                'number_of_seminars.max' => "Ievadītais praktisko nodarbību skaits ir pārāk liels!",
                'prerequisites.required' => "Nav aizpildīts lauks 'Nepieciešamās zināšanas kursa uzsākšanai' !",
                'study_program_part.required' => "Nav norādīta studiju programmas daļa!",
                'objective.required' => "Nav aizpildīts lauks 'Studiju kursa mērķis' !",
                'independent_tasks.*.required' => "Nav pievienots studējošo patstāvīgā darba organizācijas veids' !",
                'independent_tasks.*.min' => "Ieraksts laukā 'Patstāvīgā darba organizācijas veids' ir pārāk īss!",
                'percent.*.required' => "Nav norādīti procenti sadaļā 'Studiju rezultātu vērtēšana' !",
                'percent.*.integer' => "Procenti sadaļā 'Studiju rezultātu vērtēšana' jāievada kā skaitlis!",
                'percent.*.min' => "Ievadītajai procentu vērtībai sadaļā 'Studiju rezultātu vērtēšana' jābūtu vismaz 1!",
                'percent.*.max' => "Ievadītā procentu vērtība sadaļā 'Studiju rezultātu vērtēšana' nevar būt lielāka par 100!",
                'evaluation.*.required' => "Nav norādīts novērtējuma veids sadaļā 'Studiju rezultātu vērtēšana' !",
                'evaluation.*.min' => "Ieraksts laukā 'Novērtējuma veids' ir pārāk īss!",
                'course_subjects.*.required' => "Nav pievienota neviena tēma sadaļā 'Studiju kursa saturs' !",
                'course_subjects.*.min' => "Ieraksts laukā 'Tēmas nosaukums' ir pārāk īss!",
                'calendar_plan_lecture_num.*.required' => "Nav norādīts nodarbības numurs sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.required' => "Nav norādīta nodarbīas tēma sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_subject.*.min' => "Ieraksts laukā 'Tēmas nosaukums (kalendārais plāns)' ir pārāk īss!",
                'calendar_plan_type.*.required' => "Nav norādīts nodarbības veids sadaļā 'Studiju kursa kalendārais plāns' !",
                'calendar_plan_type.*.min' => "Ieraksts laukā 'Nodarbības veids (kalendārais plāns)' ir pārāk īss!",
                'basic_literature.*.required' => "Nav pievienots pamatliteratūras ieraksts!",
                'basic_literature.*.min' => "Ieraksts laukā 'Pamatliteratūra' ir pārāk īss!",
            ]);
        }
        if(($request->input('results_rb') == 'direct_results') && !$c_course)
        {
            $program_results = $request->input('program_results');
            if(empty($program_results))
            {
                return back()->withErrors('Nav pievienots neviens studiju programmas studiju rezultāts!')->withInput();
            }
        }
        if(($request->input('results_rb') == 'linked_results') && !$c_course)
        {
            $course_results = $request->input('course_results');
            foreach($course_results as $course_result)
            {
                if($course_result == null)
                {
                    return back()->withErrors('Pārbaudiet studiju rezultātu ievades laukus! Vismaz 1 tukšs ievades lauks!')->withInput();
                }
            }
        }

        $course = StudyCourse::findOrFail($id);
        $course->name = $request->input('course_name');
        $course->name_eng = $request->input('course_name_eng');
        $course->LAIS_code = $request->input('LAIS_code');
        $course->type_of_test_id = $request->input('type_of_test');
        $course->kp = $request->input('kp');
        $course->number_of_lectures = $request->input('number_of_lectures');
        $course->number_of_seminars = $request->input('number_of_seminars');
        $course->prerequisites = $request->input('prerequisites');
        $course->study_program_part_id = $request->input('study_program_part');
        $course->objective = $request->input('objective');
        $course->author_id = auth()->user()->id;
        $course->faculty_id = $request->input('faculty');
        if($request->has('c_courses_chbox'))
        {
            $course->c_course = 1;
            $course->faculty_id = 0;
        }
        else
        {
            $course->c_course = 0;
        }
        if($request->has('eng_chbox'))
        {
            $course->eng = 1;
        }
        else
        {
            $course->eng = 0;
        }
        if($request->input('results_rb') == 'direct_results')
        {
            $course->direct_results = 1;
        }
        else
        {
            $course->direct_results = 0;
        }
        $course->save();

        // Lecturers
        $current_lecturers = $course->lecturers;
        foreach($current_lecturers as $current_lecturer)
        {
            $current_lecturer->study_courses()->detach($course->id); // removes many-to-many relationship
        }
        $lecturers_to_add = $request->input('lecturers');
        foreach($lecturers_to_add as $lecturer_to_add)
        {
            if(!empty($lecturer_to_add))
            {   
                $lecturer = User::find($lecturer_to_add);
                $course->lecturers()->save($lecturer);
            }
        }

        // Study Course Results

        if($request->has('c_courses_chbox')) // add study course results for c course
        {
            $current_course_results = $course->additional_study_course_results;
            foreach($current_course_results as $result)
            {
                $result->delete();
            }
            $new_course_results = $request->input('additional_course_results');
            foreach($new_course_results as $course_result)
            {
                if(!empty($course_result))
                {     
                    $new_course_result = new AdditionalStudyCourseResult();
                    $new_course_result->result=$course_result;
                    $new_course_result->study_course_id = $course->id;
                    $new_course_result->save();       
                }
            }
        }
        else // course is not c course
        {
            // direct results
            if($course->direct_results) 
            {
                // Study Program Results
                $current_study_program_results = $course->study_program_results;
                foreach($current_study_program_results as $current_study_program_result)
                {
                    $current_study_program_result->study_courses()->detach($course->id); // removes many-to-many relationship
                }
                $new_study_program_results = $request->input('program_results');
                if(!empty($new_study_program_results))
                {
                    foreach($new_study_program_results as $study_program_result)
                    {
                        if(!empty($study_program_result))
                        {   
                            $program_result = StudyProgramResult::find($study_program_result);
                            $course->study_program_results()->save($program_result);
                        }
                    }
                }
                // add optional course results
                $current_course_results = $course->additional_study_course_results;
                foreach($current_course_results as $result)
                {
                    $result->delete();
                }
                $course_results = $request->input('additional_course_results');
                if(!empty($course_results))
                {
                    foreach($course_results as $course_result)
                    {
                        if(!empty($course_result))
                        {     
                            $new_course_result = new AdditionalStudyCourseResult();
                            $new_course_result->result=$course_result;
                            $new_course_result->study_course_id = $course->id;
                            $new_course_result->save();       
                        }
                    }
                }
            }
            else // linked results - link each course result to one or many study program result/results
            {
                $current_course_results = $course->study_course_results;
                foreach($current_course_results as $result)
                {
                    $result->delete();
                }
                $course_results = $request->input('course_results');
                $numberOfLinkedProgramResults = $request->input('number_of_program_results');
            
                $i=1;
                for($i; $i <= $numberOfLinkedProgramResults; $i++)
                {
                    $new_course_result = new StudyCourseResult();
                    $new_course_result->result=$course_results[$i-1];
                    $new_course_result->study_course_id = $course->id;
                    $new_course_result->save();

                    $study_program_results = $request->input('program_results'.$i);
                    if(!empty($study_program_results))
                    {
                        foreach($study_program_results as $study_program_result)
                        {
                            if(!empty($study_program_result))
                            {   
                                $program_result = StudyProgramResult::find($study_program_result);
                                $new_course_result->study_program_results()->save($program_result); // link course result with study program result
                                //$course->study_program_results()->save($program_result); // no reason to save result as study program result because
                                                                                            // it is already linked to specific course result
                            }
                        }
                    }
                }
                // input has optional course results which are not linked to study program results
                $current_course_results = $course->additional_study_course_results;
                foreach($current_course_results as $result)
                {
                    $result->delete();
                }
                $additional_course_results = $request->input('additional_course_results');
                if(!empty($additional_course_results))
                {
                    foreach($additional_course_results as $additional_course_result)
                    {
                        if(!empty($additional_course_result))
                        {     
                            $new_course_result = new AdditionalStudyCourseResult();
                            $new_course_result->result=$additional_course_result;
                            $new_course_result->study_course_id = $course->id;
                            $new_course_result->save();       
                        }
                    }
                }
            }
        }

        // Independent Tasks
        $current_independent_tasks = $course->independent_tasks;
        foreach($current_independent_tasks as $task)
        {
            $task->delete();
        }
        $new_independent_tasks = $request->input('independent_tasks');
        foreach($new_independent_tasks as $new_independent_task)
        {
            if(!empty($new_independent_task))
            {     
                $independent_task = new IndependentTask;
                $independent_task->task = $new_independent_task;
                $independent_task->study_course_id = $course->id;
                $independent_task->save();    
            }
        }

        // Update Evaluation
        $current_evaluation = $course->evaluations;
        foreach($current_evaluation as $evaluation)
        {
            $evaluation->delete();
        }
        $percent_edit_form = $request->input('percent');
        $evaluation_edit_form = $request->input('evaluation');

        for($i=0; $i<count($evaluation_edit_form); $i++)
        {
            if(!empty($evaluation_edit_form[$i]) && !empty($percent_edit_form[$i]))
            {     
                $new_evaluation = new Evaluation();
                $new_evaluation->percent=$percent_edit_form[$i];
                $new_evaluation->type_of_evaluation=$evaluation_edit_form[$i];
                $new_evaluation->study_course_id = $course->id;
                $new_evaluation->save(); 
            }
        }

        // Course subjects
        $current_course_subjects = $course->subjects;
        foreach($current_course_subjects as $course_subject)
        {
            $course_subject->delete();
        }
        
        $course_subjects_edit_form = $request->input('course_subjects');
        foreach($course_subjects_edit_form as $course_subject)
        {
            $new_course_subject = new StudyCourseSubject;
            $new_course_subject->subject = $course_subject;
            $new_course_subject->study_course_id = $course->id;
            $new_course_subject->save();
        }

        // Calendar plan
        $current_calendar_plans = $course->calendar_plans;
        foreach($current_calendar_plans as $calendar_plan)
        {
            $calendar_plan->delete();
        }
        
        $lecture_numbers = $request->input('calendar_plan_lecture_num');
        $subjects = $request->input('calendar_plan_subject');
        $types = $request->input('calendar_plan_type');

        for($i=0; $i < count($subjects); $i++)
        {
            $new_calendar_plan = new CalendarPlan;
            $new_calendar_plan->lecture_num = $lecture_numbers[$i];
            $new_calendar_plan->subject = $subjects[$i];
            $new_calendar_plan->type_of_lecture = $types[$i];
            $new_calendar_plan->study_course_id = $course->id;
            $new_calendar_plan->save();
        }

        // Basic literature
        $basic_literatures = $course->basic_literature;
        foreach($basic_literatures as $basic_literature)
        {
            $basic_literature->delete();
        }
        $basic_literature_edit_form = $request->input('basic_literature');
        foreach($basic_literature_edit_form as $basic_literature)
        {
            $new_basic_literature = new BasicLiterature;
            $new_basic_literature->name = $basic_literature;
            $new_basic_literature->study_course_id = $course->id;
            $new_basic_literature->save();
        }

        // Additional literature
        $additional_literatures = $course->additional_literature;
        foreach($additional_literatures as $additional_literature)
        {
            $additional_literature->delete();
        }
        $additional_literature_edit_form = $request->input('additional_literature');
        if(is_array($additional_literature_edit_form)){
            foreach($additional_literature_edit_form as $additional_literature)
            {
                $new_additional_literature = new AdditionalLiterature;
                $new_additional_literature->name = $additional_literature;
                $new_additional_literature->study_course_id = $course->id;
                $new_additional_literature->save();
            }
        }

        // Other Information Sources
        $other_information_sources = $course->other_information_sources;
        foreach($other_information_sources as $other_information_source)
        {
            $other_information_source->delete();
        }
        $other_information_sources_edit_form = $request->input('other_information_sources');
        if(is_array($other_information_sources_edit_form)){
            foreach($other_information_sources_edit_form as $other_information_source)
            {
                $new_other_information_source = new OtherInformationSource;
                $new_other_information_source->name = $other_information_source;
                $new_other_information_source->study_course_id = $course->id;
                $new_other_information_source->save();
            }
        }
        if(!$request->has('c_courses_chbox')) // add / update study programs only if course is not C course
        {
            // Study Program
            $current_study_programs = $course->study_programs;

            foreach($current_study_programs as $current_study_program)
            {
                $current_study_program->study_courses()->detach($course->id); // removes many-to-many relationship
            }
            $study_programs_edit_form = $request->input('study_programs');
            foreach($study_programs_edit_form as $study_program)
            {
                if(!empty($study_program))
                {   
                    $program_to_add = StudyProgram::find($study_program);
                    $course->study_programs()->save($program_to_add);
                }
            }
        }

        return redirect('/courses/'.$id)->with('success', 'Studiju kurss labots veiksmīgi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = StudyCourse::findOrFail($id);

        // only course description authors and users with higher priviledges than lecturers can delete course descriptions
        if(Auth::user()->is_lecturer && Auth::user()->id != $course->author->id)
        {
            return redirect()->back()->with('error', 'Jūs nevarat dzēst šo kursa aprakstu!');
        }
        
        // remove many-to-many relationship with lecturers
        foreach($course->lecturers as $lecturer)
        {
            $lecturer->study_courses()->detach($course->id);
        }
        // delete independent tasks
        foreach($course->independent_tasks as $independent_task)
        {
            $independent_task->delete();
        }
        // remove many-to-many relationship between course results and study program results
        foreach($course->study_course_results as $course_result)
        {
            foreach($course_result->study_program_results as $study_program_result)
            {
                $study_program_result->study_course_results()->detach($course_result->id);
            }
        }
        // delete study course results
        foreach($course->study_course_results as $study_course_result)
        {
            $study_course_result->delete();
        }
        // delete additional study course results
        foreach($course->additional_study_course_results as $study_course_result)
        {
            $study_course_result->delete();
        }
        // remove many-to-many relationship with study programs
        foreach($course->study_programs as $study_program)
        {
            $study_program->study_courses()->detach($course->id);
        }
        // remove many-to-many relationship with study program results
        foreach($course->study_program_results as $study_program_result)
        {
            $study_program_result->study_courses()->detach($course->id);
        }
        // delete study course subjects
        foreach($course->subjects as $subject)
        {
            $subject->delete();
        }
        // delete calendar plans
        foreach($course->calendar_plans as $calendar_plan)
        {
            $calendar_plan->delete();
        }
        // delete evaluations
        foreach($course->evaluations as $evaluation)
        {
            $evaluation->delete();
        }
        // delete basic literature
        foreach($course->basic_literature as $literature)
        {
            $literature->delete();
        }
        // delete additional literature
        foreach($course->additional_literature as $literature)
        {
            $literature->delete();
        }
        // delete other information sources
        foreach($course->other_information_sources as $other_information_source)
        {
            $other_information_source->delete();
        }
        // delete study course
        $course->delete();

        return redirect('/courses')->with('success', 'Studiju kurss izdzēsts');
    }

    // https://stackoverflow.com/questions/7358637/reading-doc-file-in-php
    function read_file_docx($filename)
    {
        $striped_content = '';
        $content = '';

        if(!$filename || !file_exists($filename)) return false;

        $zip = zip_open($filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip))
        {
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }
        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

    function getStringBetween($string, $start, $end)
    {
        $r = explode($start, $string);
        if (isset($r[1]))
        {
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }

    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'uploaded_file' => 'required|mimes:pdf,docx|max:1999', // upload has to be a PDF or DOCX document and max allowed size is 1999 (2 MB)
        ],[
            'uploaded_file.required' => 'Nav pievienots augšupielādējamais fails!',
            'uploaded_file.mimes' => 'Neatbilstošs faila formāts! Atļautie failu formāti: .pdf un .docx',
            'uploaded_file.max' => 'Faila izmērs pārsniedz maksimāli pieļaujamo!'
        ]);

        // Handle File Upload
        if($request->hasFile('uploaded_file')) // checks if user has uploaded a file
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('uploaded_file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); // php code (not Laravel)
            // Get just file extension
            $extension = $request->file('uploaded_file')->getClientOriginalExtension();
            // Filename to store
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            // Upload and save file
            $path = $request->file('uploaded_file')->storeAs('public/uploads', $filenameToStore); // will create new folder if not exists
        }
        $uploaded_file_path = 'storage/uploads/'.$filenameToStore;
        $extracted_text = '';

        if($extension == 'pdf')
        {
            // Parse pdf file and build necessary objects.
            // https://github.com/smalot/pdfparser

            $parser = new \Smalot\PdfParser\Parser();
            $pdf = $parser->parseFile($uploaded_file_path);
            $extracted_text = $pdf->getText();
        }
        else if($extension == 'docx')
        {
            $extracted_text = $this->read_file_docx($uploaded_file_path);
        }

        // delete uploaded file (optional)
        //File::delete('/uploads/'.$filenameToStore);
        unlink(public_path()."/storage/uploads/".$filenameToStore); // comment this line and uploaded files will not be deleted

/*
        // Extracted string parsing using Regular Expressions (regex)
        preg_match('/(?P<name>.*) \((?P<eng>.*)\) Autors (?P<author>.*) LAIS kods (?P<lais>.*) Pārbaudes forma (?P<type_of_test>.*) Kredītpunkti \(ECTS kredītpunkti\) (?P<kp>[0-9]*) ?KP .* Kopējais kontaktnodarbību skaits .* Lekciju skaits (?P<number_of_lectures>.*) Praktisko nodarbību skaits (?P<number_of_seminars>.*) Nepieciešamās zināšanas kursa uzsākšanai (?P<prerequisites>.*) Studiju programmas daļa (?P<study_program_part>.*) Studiju kursa mērķis (?P<objective>.*) Studiju rezultāti (?P<course_results>.*) Studējošo patstāvīgā darba organizācijas veids (?P<independent_tasks>.*) Studiju rezultātu vērtēšana (?P<evaluation>.*) Studiju kursa saturs (?P<course_subjects>.*) Studiju kursa kalendārais plāns (?P<calendar_plan>.*) Pamatliteratūra (?P<basic_literature>.*) Papildliteratūra (?P<additional_literature>.*) Citi informācijas avoti (?P<other_information_sources>.*)/', $text, $matches);

        $course_name = $matches['name'];
        $course_name_eng = $matches['eng'];
        $lecturer = $matches['author'];
        $LAIS_code = $matches['lais'];
        $type_of_test = $matches['type_of_test'];
        $kp = $matches['kp'];
        $number_of_lectures = $matches['number_of_lectures'];
        $number_of_seminars = $matches['number_of_seminars'];
        $prerequisites = $matches['prerequisites'];
        $study_program_part = $matches['study_program_part'];
        $objective = $matches['objective'];
        $course_results = $matches['course_results'];
        $independent_tasks = $matches['independent_tasks'];
        $evaluation = $matches['evaluation'];
        $course_subjects = $matches['course_subjects'];
        $calendar_plan = $matches['calendar_plan'];
        $basic_literature = $matches['basic_literature'];
        $additional_literature = $matches['additional_literature'];
        $other_information_sources = $matches['other_information_sources'];
*/

        // Check if uploaded course description file is written in latvian or in english

        // get first 200 characters of $extracted_text string (it is assumed word 'Autors' or 'Author' is in first 200 characters of $extracted_text string)
        $string_to_check_language = '';
        for($i = 0; $i < 200; $i++)
        {
            $string_to_check_language .= $extracted_text[$i];
        }

        // determine language
        $english = 0;
        if (strpos($string_to_check_language, 'Autors') !== false)
        {
            $english = 0; // course description is written in latvian because it contains word 'Autors'
        }
        else if(strpos($string_to_check_language, 'Author') !== false)
        {
            $english = 1; // course description is written in english because it contains word 'Author'
        }
        else
        {
            // error - uploaded file does not contain valid course description
            return back()->withErrors('Kļūda! Augšupielādēto failu nav iespējams apstrādāt! Pārbaudiet, vai augšupielādējamais fails satur kursu aprakstu standartam atbilstošu kursa aprakstu!');
        }

        // search for neccessary information in $extracted_text string and populate values in corresponding variables
        if(!$english)
        {
            $division = explode('Studiju rezultāti', $extracted_text); // divides $extracted_text string in 2 parts (for better efficiency)
            $firstPart = $division[0]; // first part of string (from beginning to Study Results)
            $secondPart = $division[1]; // remaining part of string

            $course_name = '';
            $course_name_eng_starting_index = 0;
            for($i = 0; $i < strlen($firstPart); $i++)
            {
                if($firstPart[$i] == '(') // study course name contains all characters up to '('
                {
                    for($j = 0; $j < $i; $j++)
                    {
                        $course_name .= $firstPart[$j];
                    }
                    $course_name_eng_starting_index = $i+1;
                    break;
                }
            }

            $course_name_eng = '';
            for($i = $course_name_eng_starting_index; $i < strlen($firstPart); $i++)
            {
                if($firstPart[$i] != ')') // study course name in english contains all characters from '(' up to ')'
                {
                    $course_name_eng .= $firstPart[$i];
                }
                else
                {
                    break;
                }
            }

            $lecturer = trim($this->getStringBetween($firstPart, 'Autors', 'LAIS'));
            $LAIS_code = trim($this->getStringBetween($firstPart, 'LAIS kods', 'Pārbaudes'));
            $type_of_test = trim($this->getStringBetween($firstPart, 'Pārbaudes forma', 'Kredītpunkti'));
            $kp = trim($this->getStringBetween($firstPart, 'Kredītpunkti (ECTS kredītpunkti)', 'KP'));
            $number_of_lectures = trim($this->getStringBetween($firstPart, 'Lekciju skaits', 'Praktisko'));
            $number_of_seminars = trim($this->getStringBetween($firstPart, 'Praktisko nodarbību skaits', 'Nepieciešamās'));
            $prerequisites = trim($this->getStringBetween($firstPart, 'Nepieciešamās zināšanas kursa uzsākšanai', 'Studiju programmas daļa'));
            $study_program_part = trim($this->getStringBetween($firstPart, 'Studiju programmas daļa', 'Studiju kursa mērķis'));
            $objective = trim($this->getStringBetween($firstPart, 'Studiju kursa mērķis', 'Studiju rezultāti'));
            $string_from_course_results_till_independent_taksks = explode('Studējošo patstāvīgā darba organizācijas veids', $secondPart);
            $course_results = $string_from_course_results_till_independent_taksks[0];
            $course_results_splitted = explode("\n", $course_results);
            $independent_tasks = $this->getStringBetween($secondPart, 'Studējošo patstāvīgā darba organizācijas veids', 'Studiju rezultātu vērtēšana');
            $independent_tasks_splitted = explode("\n", $independent_tasks);
            $evaluation = $this->getStringBetween($secondPart, 'Studiju rezultātu vērtēšana', 'Studiju kursa saturs');
            $evaluation_splitted = explode("\n", $evaluation);
            $course_subjects = $this->getStringBetween($secondPart, 'Studiju kursa saturs', 'Studiju kursa kalendārais plāns');
            $course_subjects_splitted = explode("\n", $course_subjects);
            $calendar_plan = $this->getStringBetween($secondPart, 'Studiju kursa kalendārais plāns', 'Pamatliteratūra');
            $calendar_plan_splitted = explode("\n", $calendar_plan);
            $basic_literature = $this->getStringBetween($secondPart, 'Pamatliteratūra', 'Papildliteratūra');
            $basic_literature_splitted = explode("\n", $basic_literature);
            $additional_literature = $this->getStringBetween($secondPart, 'Papildliteratūra', 'Citi informācijas avoti');
            $additional_literature_splitted = explode("\n", $additional_literature);
            $other_information_sources = $this->getStringBetween($secondPart, 'Citi informācijas avoti', '.');
            $other_information_sources_splitted = explode("\n", $other_information_sources);
        }
        else // course description is written in english
        {
            $division = explode('Study results', $extracted_text); // divides $extracted_text string in 2 parts (for better efficiency)
            $firstPart = $division[0]; // first part of string (from beginning to Study Results)
            $secondPart = $division[1]; // remaining part of string

            $course_name = '';
            $course_name_eng = '';

            for($i=0; $i<strpos($string_to_check_language, 'Author'); $i++)
            {
                $course_name .= $string_to_check_language[$i];
            }

            $lecturer = trim($this->getStringBetween($firstPart, 'Author', 'LAIS'));
            $LAIS_code = trim($this->getStringBetween($firstPart, 'LAIS course code', 'Form of evaluation'));
            $type_of_test = trim($this->getStringBetween($firstPart, 'Form of evaluation', 'Academic credit points'));
            $kp = trim($this->getStringBetween($firstPart, 'Academic credit points (ECTS credit points)', 'ECTS'));
            $number_of_lectures = trim($this->getStringBetween($firstPart, 'The number of lectures', 'The number of practical classes'));
            $number_of_seminars = trim($this->getStringBetween($firstPart, 'The number of practical classes', 'Prerequisites'));
            $prerequisites = trim($this->getStringBetween($firstPart, 'Prerequisites', 'Part of the study programme'));
            $study_program_part = trim($this->getStringBetween($firstPart, 'Part of the study programme', 'Study course objective'));
            $objective = trim($this->getStringBetween($firstPart, 'Study course objective', 'Study results'));
            $string_from_course_results_till_independent_taksks = explode('Organization mode of students’ individual work', $secondPart);
            $course_results = $string_from_course_results_till_independent_taksks[0];
            $course_results_splitted = explode("\n", $course_results);
            $independent_tasks = $this->getStringBetween($secondPart, 'Organization mode of students’ individual work', 'Evaluation of study results');
            $independent_tasks_splitted = explode("\n", $independent_tasks);
            $evaluation = $this->getStringBetween($secondPart, 'Evaluation of study results', 'Study course outline');
            $evaluation_splitted = explode("\n", $evaluation);
            $course_subjects = $this->getStringBetween($secondPart, 'Study course outline', 'Study course schedule');
            $course_subjects_splitted = explode("\n", $course_subjects);
            $calendar_plan = $this->getStringBetween($secondPart, 'Study course schedule', 'Basic literature');
            $calendar_plan_splitted = explode("\n", $calendar_plan);
            $basic_literature = $this->getStringBetween($secondPart, 'Basic literature', 'Supplementary literature');
            $basic_literature_splitted = explode("\n", $basic_literature);
            $additional_literature = $this->getStringBetween($secondPart, 'Supplementary literature', 'Other source of information');
            $additional_literature_splitted = explode("\n", $additional_literature);
            $other_information_sources = $this->getStringBetween($secondPart, 'Other source of information', '.');
            $other_information_sources_splitted = explode("\n", $other_information_sources);
        }

        $data = [
            'lecturers' => User::where('is_lecturer','1')->get()->pluck('select_option', 'id'),
            'types_of_tests' => TypeOfTest::pluck('type_of_test', 'id'),
            'study_program_parts' => StudyProgramPart::pluck('part', 'id'),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
            'study_program_results' => StudyProgramResult::all()->pluck('select_option', 'id'),
            'course_in_english' => $english,
            'course_name' => $course_name,
            'course_name_eng' => $course_name_eng,
            'lecturer' => $lecturer,
            'LAIS_code' => $LAIS_code,
            'type_of_test' => $type_of_test,
            'kp' => $kp,
            'number_of_lectures' => $number_of_lectures,
            'number_of_seminars' => $number_of_seminars,
            'prerequisites' => $prerequisites,
            'study_program_part' => $study_program_part,
            'objective' => $objective,
            'course_results' => $course_results_splitted,
            'independent_tasks' => $independent_tasks_splitted,
            'evaluation' => $evaluation_splitted,
            'course_subjects' => $course_subjects_splitted,
            'calendar_plan' => $calendar_plan_splitted,
            'basic_literature' => $basic_literature_splitted,
            'additional_literature' => $additional_literature_splitted,
            'other_information_sources' => $other_information_sources_splitted,
        ];
        
        return view('courses.create_upload')->with($data);
    }

    public function filterCourses(Request $request)
    {
        $selected_courses = $request->input('courses_rb');
        if($selected_courses == 'all_courses') // all courses are chosen  
        {
            $selected_study_courses = StudyCourse::all(); 
        }
        if($selected_courses == 'courses_faculty') // courses are being filtered by chosen faculty
        {
            $selected_study_courses = StudyCourse::where('faculty_id', $request->input('faculty'))->get();
        }
        if($selected_courses == 'courses_program') // courses are being filtered by chosen study program
        {
            $selected_study_courses = StudyProgram::find($request->input('study_program'))->study_courses()->get();
        }
        if($selected_courses == 'c_courses') // only c courses are chosen
        {
            $selected_study_courses = StudyCourse::where('c_course', 1)->get();
        }

        // filtering course descriptions by language 
        // course descriptions written in english
        if($request->has('only_eng_checkbox'))
        {
            $selected_study_courses = $selected_study_courses->filter(function ($course) {
                return $course->eng;
            });
        }
        /*
        else
        {
            // course descriptions which are not written in english
            $selected_study_courses = $selected_study_courses->filter(function ($course) {
                return !$course->eng;
            });
        }
        */
        // filter course descriptions by course name (name can be partial, case insensitive)
        $name_to_search = $request->input('course_name');
        if(!empty($name_to_search))
        {
            $selected_study_courses = $selected_study_courses->filter(function ($course) use ($name_to_search)
            {
                return preg_match("/.*".$name_to_search.".*/i", $course->name);
            });
        }
        $data = [
            'courses' => $selected_study_courses,
            'number_of_added_courses' => StudyCourse::count(),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
            'paginate' => 0, // courses should not be paginated (variable is set to 0 - false)
            'search' => 1 // search is made (variable is set to 1 - true)
        ];

        return view('courses.index')->with($data);
    }
}
