<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\Faculty;
use App\StudyProgram;
use App\StudyCourse;
use Auth;

class CatalogsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('canDefineCatalogs')->except(['show', 'index', 'show_course_in_catalog']); // guests are allowed to see some catalogs
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->canViewCatalog())
        {
            //$catalogs = Catalog::all();
            $catalogs = Catalog::paginate(20); // pagination value could be increased if necessary
            
            return view('catalogs.index')->with('catalogs', $catalogs);
        }
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
        ];
        return view('catalogs.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'catalog_name' => 'required'
        ],[
            'catalog_name.required' => 'Nav ievadīts kataloga nosaukums!'
        ]);

        $catalog = new Catalog;
        $catalog->name = $request->input('catalog_name');

        $selected_courses = $request->input('courses_rb');
        if($selected_courses == 'all_courses'){
           // do nothing
        }
        if($selected_courses == 'courses_faculty'){
            $catalog->faculty_id = $request->input('faculty');
        }
        if($selected_courses == 'courses_program'){
            $catalog->study_program_id = $request->input('study_program');
        }
        if($selected_courses == 'c_courses'){
            $catalog->c_courses = 1;
        }
        if($request->has('name_eng_checkbox'))
        {
            $catalog->name_eng = 1;
        }
        if($request->has('lecturers_checkbox'))
        {
            $catalog->lecturers = 1;
        }
        if($request->has('LAIS_code_checkbox'))
        {
            $catalog->LAIS_code = 1;
        }
        if($request->has('type_of_test_checkbox'))
        {
            $catalog->type_of_test = 1;
        }
        if($request->has('kp_checkbox'))
        {
            $catalog->kp = 1;
        }
        if($request->has('total_number_of_lectures_checkbox'))
        {
            $catalog->total_number_of_lectures = 1;
        }
        if($request->has('number_of_lectures_checkbox'))
        {
            $catalog->number_of_lectures = 1;
        }
        if($request->has('prerequisites_checkbox'))
        {
            $catalog->prerequisites = 1;
        }
        if($request->has('study_program_part_checkbox'))
        {
            $catalog->study_program_part = 1;
        }
        if($request->has('objective_checkbox'))
        {
            $catalog->objective = 1;
        }
        if($request->has('study_results_checkbox'))
        {
            $catalog->study_results = 1;
        }
        if($request->has('independent_tasks_checkbox'))
        {
            $catalog->independent_tasks = 1;
        }
        if($request->has('evaluation_checkbox'))
        {
            $catalog->evaluation = 1;
        }
        if($request->has('subjects_checkbox'))
        {
            $catalog->subjects = 1;
        }
        if($request->has('calendar_plan_checkbox'))
        {
            $catalog->calendar_plan = 1;
        }
        if($request->has('basic_literature_checkbox'))
        {
            $catalog->basic_literature = 1;
        }
        if($request->has('additional_literature_checkbox'))
        {
            $catalog->additional_literature = 1;
        }
        if($request->has('other_information_sources_checkbox'))
        {
            $catalog->other_information_sources = 1;
        }
        if($request->has('show_in_one_page_checkbox'))
        {
            $catalog->show_in_one_page = 1;
        }
        if($request->has('available_for_guests_checkbox'))
        {
            $catalog->available_for_guests = 1;
        }
        if($request->has('available_for_students_checkbox'))
        {
            $catalog->available_for_students = 1;
        }
        if($request->has('only_eng_checkbox'))
        {
            $catalog->contents_only_eng = 1;
        }
        $catalog->save();

        return redirect('/catalogs')->with('success', 'Katalogs saglabāts!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catalog_to_show = Catalog::findOrFail($id);

        if(!$catalog_to_show->available_for_students && Auth::check() && Auth::user()->user_type->type == 'student')
        {
            return redirect('/');
        }
        else if(!$catalog_to_show->available_for_guests && Auth::guest())
        {
            return redirect('/');
        }

        if($catalog_to_show->faculty_id != 0) // courses are being filtered by chosen faculty
        {
            $selected_study_courses = StudyCourse::where('faculty_id', $catalog_to_show->faculty_id)->get();
        }
        else if($catalog_to_show->study_program_id != 0) // courses are being filtered by chosen study program
        {
            $selected_study_courses = StudyProgram::find($catalog_to_show->study_program_id)->study_courses()->get();
        }
        else if($catalog_to_show->c_courses != 0) // only c courses are chosen
        {
            $selected_study_courses = StudyCourse::where('c_course', 1)->get();
        }
        else
        {
            $selected_study_courses = StudyCourse::all(); // all courses are chosen
        }

        // filtering course descriptions by language 
        // course descriptions written in english
        if($catalog_to_show->contents_only_eng)
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
        $data = [
            'catalog' => $catalog_to_show,
            'study_courses' => $selected_study_courses
        ];
        if($catalog_to_show->contents_only_eng)
        {
            return view('catalogs.show_eng')->with($data);
        }
        return view('catalogs.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'catalog' =>  Catalog::findOrFail($id),
            'faculties' => Faculty::pluck('name', 'id'),
            'study_programs' => StudyProgram::all()->pluck('select_option', 'id'),
        ];
        return view('catalogs.edit')->with($data);
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
        $this->validate($request, [
            'new_catalog_name' => 'required'
        ],[
            'new_catalog_name.required' => 'Nav ievadīts kataloga nosaukums!'
        ]);

        $catalog = Catalog::findOrFail($id);
        $catalog->name = $request->input('new_catalog_name');
        $catalog->faculty_id = 11; // just for now
        $catalog->study_program_id = 11; // just for now
        $catalog->name_eng = 0;
        $catalog->lecturers = 0;
        $catalog->LAIS_code = 0;
        $catalog->type_of_test = 0;
        $catalog->kp = 0;
        $catalog->total_number_of_lectures = 0;
        $catalog->number_of_lectures = 0;
        $catalog->prerequisites = 0;
        $catalog->objective = 0;
        $catalog->study_results = 0;
        $catalog->independent_tasks = 0;
        $catalog->evaluation = 0;
        $catalog->subjects = 0;
        $catalog->calendar_plan = 0;
        $catalog->basic_literature = 0;
        $catalog->additional_literature = 0;
        $catalog->other_information_sources = 0;
        $catalog->show_in_one_page = 0;
        $catalog->available_for_guests = 0;
        $catalog->available_for_students = 0;
        $catalog->contents_only_eng = 0;
        $catalog->faculty_id = 0;
        $catalog->study_program_id = 0;
        $catalog->c_courses = 0;

        $selected_courses = $request->input('courses_rb');
        if($selected_courses == 'all_courses'){
            // do nothing
        }
        if($selected_courses == 'courses_faculty'){
            $catalog->faculty_id = $request->input('faculty');
        }
        if($selected_courses == 'courses_program'){
            $catalog->study_program_id = $request->input('study_program');
        }
        if($selected_courses == 'c_courses'){
            $catalog->c_courses = 1;
        }
        if($request->has('name_eng_checkbox'))
        {
            $catalog->name_eng = 1;
        }
        if($request->has('lecturers_checkbox'))
        {
            $catalog->lecturers = 1;
        }
        if($request->has('LAIS_code_checkbox'))
        {
            $catalog->LAIS_code = 1;
        }
        if($request->has('type_of_test_checkbox'))
        {
            $catalog->type_of_test = 1;
        }
        if($request->has('kp_checkbox'))
        {
            $catalog->kp = 1;
        }
        if($request->has('total_number_of_lectures_checkbox'))
        {
            $catalog->total_number_of_lectures = 1;
        }
        if($request->has('number_of_lectures_checkbox'))
        {
            $catalog->number_of_lectures = 1;
        }
        if($request->has('prerequisites_checkbox'))
        {
            $catalog->prerequisites = 1;
        }
        if($request->has('study_program_part_checkbox'))
        {
            $catalog->study_program_part = 1;
        }
        if($request->has('objective_checkbox'))
        {
            $catalog->objective = 1;
        }
        if($request->has('study_results_checkbox'))
        {
            $catalog->study_results = 1;
        }
        if($request->has('independent_tasks_checkbox'))
        {
            $catalog->independent_tasks = 1;
        }
        if($request->has('evaluation_checkbox'))
        {
            $catalog->evaluation = 1;
        }
        if($request->has('subjects_checkbox'))
        {
            $catalog->subjects = 1;
        }
        if($request->has('calendar_plan_checkbox'))
        {
            $catalog->calendar_plan = 1;
        }
        if($request->has('basic_literature_checkbox'))
        {
            $catalog->basic_literature = 1;
        }
        if($request->has('additional_literature_checkbox'))
        {
            $catalog->additional_literature = 1;
        }
        if($request->has('other_information_sources_checkbox'))
        {
            $catalog->other_information_sources = 1;
        }
        if($request->has('show_in_one_page_checkbox'))
        {
            $catalog->show_in_one_page = 1;
        }
        if($request->has('available_for_guests_checkbox'))
        {
            $catalog->available_for_guests = 1;
        }
        if($request->has('available_for_students_checkbox'))
        {
            $catalog->available_for_students = 1;
        }
        if($request->has('only_eng_checkbox'))
        {
            $catalog->contents_only_eng = 1;
        }
        $catalog->save();

        return redirect('/catalogs/'.$id)->with('success', 'Kataloga saturs labots!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catalog = Catalog::findOrFail($id);
        $catalog->delete();

        return redirect('/catalogs')->with('success', 'Katalogs izdzēsts');
    }

    public function show_course_in_catalog($catalog_id, $course_id)
    {
        $catalog = Catalog::findOrFail($catalog_id);
        $study_course = StudyCourse::findOrFail($course_id);

        if(!$catalog->available_for_guests && Auth::guest())
        {
            return redirect('/login');
        }
        if(!$catalog->available_for_students && Auth::check() && Auth::user()->user_type->type == 'student')
        {
            return redirect('/');
        }
        $data = [
            'catalog' => $catalog,
            'study_course' => $study_course,
        ];
        if($catalog->contents_only_eng || $study_course->eng)
        {
            return view('catalogs.catalog_course_eng')->with($data);
        }
        return view('catalogs.catalog_course')->with($data);
    }
}
