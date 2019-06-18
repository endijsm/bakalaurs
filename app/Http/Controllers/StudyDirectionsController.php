<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyDirection;

class StudyDirectionsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
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
        $this->validate($request, ['name' => 'required'], ['name.required' => 'Ievadiet studiju virziena nosaukumu!']);

        $input = $request->all();
        $study_direction = new StudyDirection;
        $study_direction->fill($input)->save();
        
        //return redirect('/faculties')->with('success', 'Studiju virziens pievienots!');
        return redirect()->back()->with('success', 'Studiju virziens pievienots!');
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
        $study_direction =  StudyDirection::findOrFail($id);
        return view('directions.edit')->with('study_direction', $study_direction);
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
            'new_study_direction_name' => 'required'
        ],[
            'new_study_direction_name.required' => 'Ievadiet studiju virziena nosaukumu!'
        ]);

        $study_direction = StudyDirection::findOrFail($id);
        $study_direction->name = $request->input('new_study_direction_name');
        $previous_page = $request->input('previous_page');
        $study_direction->save();

        return redirect($previous_page)->with('success', 'Studiju virziena nosaukums nomainīts!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $study_direction = StudyDirection::findOrFail($id);
        
        foreach($study_direction->study_programs as $program)
        {
            $program->study_direction_id = 0;
            $program->save();
        }
        $study_direction->delete();

        return redirect()->back()->with('success', 'Studiju virziens izdzēsts!');
    }
}
