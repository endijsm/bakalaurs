@extends('layouts.app')

@section('content')
        <h1>Labot fakultātes nosaukumu</h1><br><br>
        {!! Form::open(['action' => ['FacultiesController@update', $faculty->id],'method' => 'POST']) !!}
        
            <div class="form-group">
                {{Form::label('new_faculty_name_label', 'Jaunais fakultātes nosaukums:')}}
                {{Form::text('new_faculty_name', $faculty->name, ['class' => 'form-control', 'placeholder' => 'Jaunais fakultātes nosaukums'])}}<br><br>
                
            </div>
            
            {{Form::hidden('_method', 'PUT')}} 
            {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

        <br><a href="/faculties/{{$faculty->id}}" class="btn btn-primary">Atpakaļ</a>
@endsection