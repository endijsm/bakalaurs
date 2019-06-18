@extends('layouts.app')

@section('content')
        <h1>Pievienot fakultāti</h1><br><br>
        {!! Form::open(['action' => 'FacultiesController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('faculty_name_label', 'Jaunās fakultātes nosaukums:')}}
                {{Form::text('faculty_name', '', ['class' => 'form-control', 'placeholder' => 'Fakultātes nosaukums'])}}<br><br>
            </div>
            {{Form::submit('Pievienot fakultāti', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

        <br><a href="/faculties" class="btn btn-primary">Atpakaļ</a>
@endsection