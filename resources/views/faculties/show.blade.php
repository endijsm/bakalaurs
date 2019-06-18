@extends('layouts.app')

@section('content')
        <h1>{{$faculty->name}}</h1>
        <br>
        @if(Auth::user()->canDefineStructures())
            <a href="/faculties/{{$faculty->id}}/edit" class="btn btn-outline-dark">Labot fakultātes nosaukumu</a><br><br><br>
        @endif

        <h3>Studiju virzieni:</h3><br>
        
            @if(count($faculty->study_directions) > 0)
                @if(Auth::user()->canDefineStructures())
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($faculty->study_directions as $study_direction)
                                <tr>
                                    <td>{{$study_direction->name}}</td>
                                    <td><a href="/directions/{{$study_direction->id}}/edit" class="btn btn-outline-dark">Labot</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['StudyDirectionsController@destroy', $study_direction->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Dzēst', ['class' => 'btn btn-outline-dark delete-direction'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                @else
                    <ul class="list-group">
                        @foreach($faculty->study_directions as $study_direction)
                            <li class="list-group-item">{{$study_direction->name}}</li>
                        @endforeach
                    </ul>
                @endif
            @else
                <h3 class="text-danger">Netika atrasts neviens studiju virziens</h3>
            @endif

        @if(Auth::user()->canDefineStructures())

            <br><button class="btn btn-outline-dark" onclick="showDiv('addStudyDirectionDiv')">Pievienot studiju virzienu</button>
            <div id="addStudyDirectionDiv" style="display: none;">
                <br><h4>Pievienot studiju virzienu</h4>
                {!! Form::model($direction, ['action' => 'StudyDirectionsController@store']) !!}
                    <div class="form-row">
                        <div class="col-8">
                            {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Studiju virziens']) !!}
                            {!! Form::hidden('faculty_id', $faculty->id) !!}
                        </div>
                        <div class="col">
                            <button class="btn btn-success" type="submit">Pievienot studiju virzienu</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        @endif

        <br><br><br>
        <h3>Studiju programmas:</h3><br>
        <ul class="list-group">
            @foreach ($faculty->study_directions as $study_direction)
                @foreach ($study_direction->study_programs as $study_program)
                    <li class="list-group-item"><a href="/programs/{{$study_program->id}}">{{$study_program->name.' ('.$study_program->level.')'}}</a></li>
                @endforeach
            @endforeach
        </ul>
        <br>
        @if(Auth::user()->canDefineStructures())
            <a href="/programs/create" class ="btn btn-primary">Pievienot jaunu studiju programmu</a><br><br>
            
            {!!Form::open(['action' => ['FacultiesController@destroy', $faculty->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Dzēst fakultāti', ['class' => 'btn btn-danger delete-faculty'])}}
                <br><br><p class="text-danger">Nav ieteicams dzēst fakultāti, ja tai ir pievienoti studiju virzieni un studiju programmas! Nepieciešamības gadījumā
                    ieteicams nomainīt fakultātes nosaukumu (neveicot fakultātes dzēšanu)!
                </p>
            {!!Form::close()!!}
        @endif
        <br><a href="/faculties" class ="btn btn-primary">Atpakaļ</a><br><br>
@endsection