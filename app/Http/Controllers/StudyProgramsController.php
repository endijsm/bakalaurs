<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserType;
use App\User;
use App\StudyProgram;
use App\StudyDirection;
use App\StudyProgramPart;
use Auth;

class StudyProgramsController extends Controller
{

    public function __construct()
    {
        $this->middleware('canDefineStructures', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        $this->middleware('canViewStructures', ['only' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $study_programs = StudyProgram::paginate(20);
        return view('programs.index')->with('study_programs', $study_programs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $director_type_id = UserType::where('type', 'director')->pluck('id');

        $data = [
            'directors' => User::where('user_type_id', $director_type_id)->get()->pluck('select_option', 'id'),
            'study_directions' => StudyDirection::pluck('name', 'id'),
        ];
        
        return view('programs.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'program_name' => 'required',
            'level' => 'required',
            'study_direction' => 'required',
            'kp' => 'required|integer|min:0|max:500',
            'duration' => 'required|numeric|min:0|max:10',
            'type' => 'required',
            'language' => 'required',
            'prerequisites' => 'required',
            'degree' => 'required',
            'director' => 'required',
            'objective' => 'required',
        ], 
        [
            'program_name.required' => 'Nav ievadīts studiju programmas nosaukums!',
            'level.required' => 'Nav norādīts studiju programmas līmenis!',
            'study_direction.required' => 'Nav norādīts studiju programmai atbilstošais studiju virziens!',
            'kp.required' => 'Nav ievadīts studiju programmas kopējais kredītpunktu skaits!',
            'kp.integer' => "Ievades laukā 'Studiju programmas īstenošanas apjoms (kredītpunkti)' jāievada skaitlis!",
            'kp.min' => "Nepareizi aizpildīts lauks 'Studiju programmas īstenošanas apjoms (kredītpunkti)'!",
            'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
            'duration.required' => 'Nav ievadīts studiju programmas īstenošanas ilgums (gadi)!',
            'duration.numeric' => "Ievades laukā 'Studiju programmas īstenošanas ilgums (gadi)' jāievada skaitlis!",
            'duration.min' => "Nepareizi aizpildīts lauks 'Studiju programmas īstenošanas ilgums (gadi)'!",
            'duration.max' => "Ievadītais studiju programmas īstenošanas ilgums (gadi) ir pārāk liels!",
            'type.required' => 'Nav ievadīts studiju programmas īstenošanas veids!',
            'language.required' => 'Nav ievadīta studiju programmas īstenošanas valoda!',
            'prerequisites.required' => 'Nav ievadītas uzņemšanas prasības!',
            'degree.required' => 'Nav ievadīta piešķiramā kvalifikācija un/vai grāds!',
            'director.required' => 'Nav norādīts studiju programmas direktors!',
            'objective.required' => 'Nav ievadīts studiju programmas mērķis!',
        ]);

        // Create Study Program
        $study_program = new StudyProgram;
        $study_program->name = $request->input('program_name');
        $study_program->level = $request->input('level');
        $study_program->study_direction_id = $request->input('study_direction');
        $study_program->kp = $request->input('kp');
        $study_program->duration = $request->input('duration');
        $study_program->type = $request->input('type');
        $study_program->language = $request->input('language');
        $study_program->prerequisites = $request->input('prerequisites');
        $study_program->degree = $request->input('degree');
        $study_program->director_id = $request->input('director');
        $study_program->objective = $request->input('objective');
        $study_program->save();

        return redirect('/programs')->with('success', 'Studiju programma pievienota veiksmīgi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'study_program' => StudyProgram::findOrFail($id),
            'study_program_parts' => StudyProgramPart::all(),
        ];
        return view('programs.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $director_type_id = UserType::where('type', 'director')->pluck('id');

        $data = [
            'study_program' => StudyProgram::findOrFail($id),
            'directors' => User::where('user_type_id', $director_type_id)->get()->pluck('select_option', 'id'),
            'study_directions' => StudyDirection::pluck('name', 'id'),
        ];
        return view('programs.edit')->with($data);
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
        $this->validate($request,
        [
            'program_name' => 'required',
            'level' => 'required',
            'study_direction' => 'required',
            'kp' => 'required|integer|min:0|max:500',
            'duration' => 'required|numeric|min:0|max:10',
            'type' => 'required',
            'language' => 'required',
            'prerequisites' => 'required',
            'degree' => 'required',
            'director' => 'required',
            'objective' => 'required',
        ], 
        [
            'program_name.required' => 'Nav ievadīts studiju programmas nosaukums!',
            'level.required' => 'Nav norādīts studiju programmas līmenis!',
            'study_direction.required' => 'Nav norādīts studiju programmai atbilstošais studiju virziens!',
            'kp.required' => 'Nav ievadīts studiju programmas kopējais kredītpunktu skaits!',
            'kp.integer' => "Ievades laukā 'Studiju programmas īstenošanas apjoms (kredītpunkti)' jāievada skaitlis!",
            'kp.min' => "Nepareizi aizpildīts lauks 'Studiju programmas īstenošanas apjoms (kredītpunkti)'!",
            'kp.max' => "Ievadītais kredītpunktu skaits ir pārāk liels!",
            'duration.required' => 'Nav ievadīts studiju programmas īstenošanas ilgums (gadi)!',
            'duration.numeric' => "Ievades laukā 'Studiju programmas īstenošanas ilgums (gadi)' jāievada skaitlis!",
            'duration.min' => "Nepareizi aizpildīts lauks 'Studiju programmas īstenošanas ilgums (gadi)'!",
            'duration.max' => "Ievadītais studiju programmas īstenošanas ilgums (gadi) ir pārāk liels!",
            'type.required' => 'Nav ievadīts studiju programmas īstenošanas veids!',
            'language.required' => 'Nav ievadīta studiju programmas īstenošanas valoda!',
            'prerequisites.required' => 'Nav ievadītas uzņemšanas prasības!',
            'degree.required' => 'Nav ievadīta piešķiramā kvalifikācija un/vai grāds!',
            'director.required' => 'Nav norādīts studiju programmas direktors!',
            'objective.required' => 'Nav ievadīts studiju programmas mērķis!',
        ]);

        $study_program = StudyProgram::findOrFail($id);
        $study_program->name = $request->input('program_name');
        $study_program->level = $request->input('level');
        $study_program->study_direction_id = $request->input('study_direction');
        $study_program->kp = $request->input('kp');
        $study_program->duration = $request->input('duration');
        $study_program->type = $request->input('type');
        $study_program->language = $request->input('language');
        $study_program->prerequisites = $request->input('prerequisites');
        $study_program->degree = $request->input('degree');
        $study_program->director_id = $request->input('director');
        $study_program->objective = $request->input('objective');
        $study_program->save();

        return redirect('/programs/'.$id)->with('success', 'Studiju programma labota veiksmīgi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $study_program = StudyProgram::findOrFail($id);

        foreach($study_program->study_program_results as $study_program_result)
        {
            // remove many-to-many relationship between study program results and study courses
            foreach($study_program_result->study_courses as $study_course)
            {
                $study_course->study_program_results()->detach($study_program_result->id);
            }
            // remove many-to-many relationship between study program results and study course results
            foreach($study_program_result->study_course_results as $study_course_result)
            {
                $study_course_result->study_program_results()->detach($study_program_result->id);
            }
        }

        // delete study program results
        foreach($study_program->study_program_results as $result)
        {
            $result->delete();
        }
        // remove many-to-many relationship with study courses
        foreach($study_program->study_courses as $study_course)
        {
            $study_course->study_programs()->detach($study_program->id);
        }
        // delete this study program
        $study_program->delete();

        return redirect('/programs')->with('success', 'Studiju programma izdzēsta!');
    }

    public function showMapping($id)
    {
        if(Auth::user()->canViewStudyProgramMapping())
        {
            $study_program = StudyProgram::findOrFail($id);
            return view('study_program_results_mapping')->with('study_program', $study_program);
        }
        return redirect('/');
    }
}
