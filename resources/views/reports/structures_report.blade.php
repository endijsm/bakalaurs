@extends('layouts.app')

@section('content')

    <h1>Augstskolas fakultātes, studiju virzieni un studiju programmas</h1>
    <br>
    <p>Tiek attēlotas tās fakultātes un studiju programmas, kuras saglabātas sistēmā. Ja kāda fakultāte vai studiju programma
        nav saglabāta sistēmā, tā netiek attēlota zemāk. Detalizētāku informāciju par fakultātēm un studiju programmām var 
        apskatīt sadaļā Fakultātes un Studiju programmas.
    </p>
    <br>
    <a href="/reports" class ="btn btn-primary">Atpakaļ</a>
    <br><br>
    <hr>
    <h5>Fakultāšu skaits: {{$faculties->count()}}</h5>
    <h5>Studiju virzienu skaits: {{$number_of_study_directions}}</h5>
    <h5>Studiju programmu skaits: {{$number_of_study_programs}}</h5>
    <hr><br>

    @foreach($faculties as $faculty)
        <h2><strong>{{$faculty->name}}</strong></h2>
        <ul>
            <h3>Studiju virzieni:</h3>
            <ul>
                @foreach($faculty->study_directions as $direction)
                    <h5>{{$direction->name}}</h5>
                    <ul>
                        <h3>Studiju programmas:</h3>
                        <ul>
                            @foreach($direction->study_programs as $program)
                                <h5>{{$program->name.' ('.$program->level.')'}}</h5>
                            @endforeach
                        </ul>
                    </ul>
                    <br>
                @endforeach
            </ul>
        </ul>
        <br>
    @endforeach
    
    <br><br>
    <a href="/reports" class ="btn btn-primary">Atpakaļ</a>
    <br><br>
@endsection