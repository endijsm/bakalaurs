@extends('layouts.app')

@section('content')
    <h1>Labot studiju programmas sasniedzamo studiju rezultātu</h1><br><br>
    {!! Form::open(['action' => ['StudyProgramResultsController@update', $study_program_result->id],'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('study_program_result_label', 'Jaunais studiju programmas sasniedzamā studiju rezultāta nosaukums:')}}
            {{Form::text('study_program_result', $study_program_result->result, ['class' => 'form-control'])}}<br><br>
        </div>
        {{Form::hidden('previous_page', URL::previous())}} 
        {{Form::hidden('_method', 'PUT')}} 
        {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <br><a href="{{URL::previous()}}" class="btn btn-primary">Atpakaļ</a>
    
@endsection