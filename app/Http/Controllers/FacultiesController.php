<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faculty;
use App\StudyDirection;

class FacultiesController extends Controller
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
        $faculties = Faculty::all(); // selects all faculties
        return view('faculties.index')->with('faculties', $faculties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['faculty_name' => 'required'], ['faculty_name.required' => 'Ievadiet jaunās fakultātes nosaukumu!']);

        // Create Faculty
        $faculty = new Faculty;
        $faculty->name = $request->input('faculty_name');
        $faculty->save(); // save faculty in DB

        return redirect('/faculties')->with('success', 'Fakultāte pievienota veiksmīgi!');
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
            'faculty' => Faculty::findOrFail($id),
            'direction' => new StudyDirection
        ];
        return view('faculties.show')->with($data);


        //$faculty =  Faculty::find($id);
        //return view('faculties.show')->with('faculty', $faculty);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty =  Faculty::findOrFail($id);
        return view('faculties.edit')->with('faculty', $faculty);
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
        $this->validate($request, ['new_faculty_name' => 'required'], ['new_faculty_name.required' => 'Ievadiet fakultātes nosaukumu!']);

        $faculty = Faculty::findOrFail($id);
        $faculty->name = $request->input('new_faculty_name');
        $faculty->save(); // save faculty in DB

        return redirect('/faculties/'.$id)->with('success', 'Fakultātes nosaukums nomainīts!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $study_directions = $faculty->study_directions;
        foreach($study_directions as $study_direction)
        {
            $study_direction->faculty_id = 0;
            $study_direction->save();
        }
        $faculty->delete();

        return redirect('/faculties')->with('success', 'Fakultāte izdzēsta!');
    }
}
