@extends('layouts.app')

@section('content')
    <h1>Studiju programmas</h1><br>
    <br><a href="/" class ="btn btn-primary">Atpakaļ</a><br><br>

    @if(count($study_programs) > 0)
        @foreach ($study_programs as $study_program)
            <ul class="list-group">
                <li class="list-group-item"><a href="/programs/{{$study_program->id}}">{{$study_program->name.' ('.$study_program->level.')'}}</a></li>                             
            </ul>
        @endforeach
        <br><br>
        <!-- next line is for pagination-->
        {{ $study_programs->links() }}
        
    @else
        <p>Sistēmā nav reģistrētu studiju programmu</p>
    @endif

    <br>
    @if(Auth::user()->canDefineStructures())
        <a href="/programs/create" class ="btn btn-primary">Pievienot jaunu studiju programmu</a><br><br>
    @endif
    <a href="/" class ="btn btn-primary">Atpakaļ</a><br><br>

 @endsection