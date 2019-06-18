<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyProgramResult;

class StudyProgramResultsController extends Controller
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
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/');
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
            'result' => 'required'
        ],[
            'result.required' => 'Nav ievadīts studiju programmas sasniedzamais studiju rezultāts!',
        ]);
        $new_result = new StudyProgramResult;
        $new_result->result = $request->input('result');
        $new_result->type = $request->input('type');
        $new_result->study_program_id = $request->input('study_program_id');
        $new_result->save();
        return redirect()->back()->with('success', 'Studiju programmas rezultāts pievienots!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $study_program_result =  StudyProgramResult::findOrFail($id);
        return view('program_results.edit')->with('study_program_result', $study_program_result);
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
            'study_program_result' => 'required'
        ],[
            'study_program_result.required' => 'Ievadiet studiju rezultāte nosaukumu!'
        ]);

        $study_result = StudyProgramResult::findOrFail($id);
        $study_result->result = $request->input('study_program_result');
        $previous_page = $request->input('previous_page');
        $study_result->save();

        return redirect($previous_page)->with('success', 'Studiju programmas rezultāta nosaukums nomainīts!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $study_program_result = StudyProgramResult::findOrFail($id);
        
        // remove many-to-many relationship with study courses
        foreach($study_program_result->study_courses as $study_course)
        {
            $study_course->study_program_results()->detach($study_program_result->id);
        }
        // remove many-to-many relationship with study course results
        foreach($study_program_result->study_course_results as $study_course_result)
        {
            $study_course_result->study_program_results()->detach($study_program_result->id);
        }

        $study_program_result->delete();

        return redirect()->back()->with('success', 'Studiju programmas rezultāts izdzēsts!');
    }
}
