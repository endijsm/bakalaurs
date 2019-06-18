@extends('layouts.app')

@section('content')
    <h1>Labot studiju virziena nosaukumu</h1><br><br>
    {!! Form::open(['action' => ['StudyDirectionsController@update', $study_direction->id],'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('new_study_direction_name_label', 'Jaunais studiju virziena nosaukums:')}}
            {{Form::text('new_study_direction_name', $study_direction->name, ['class' => 'form-control'])}}<br><br>
        </div>
        {{Form::hidden('previous_page', URL::previous())}} 
        {{Form::hidden('_method', 'PUT')}} 
        {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <br><a href="{{URL::previous()}}" class="btn btn-primary">Atpakaļ</a>
    
@endsection