@extends('layouts.app')

@section('content')
    <h1>Fakultātes</h1><br>

    @if(count($faculties) > 0)
        @foreach ($faculties as $faculty)
            <ul class="list-group">
                <li class="list-group-item"><a href="/faculties/{{$faculty->id}}">{{$faculty->name.' '}}</a></li>                               
            </ul>
        @endforeach
        <!-- next line is for pagination-->
        
    @else
        <p>Sistēmā nav reģistrētu fakultāšu</p>
    @endif

    <br>
    @if(Auth::user()->canDefineStructures())
        <a href="/faculties/create" class ="btn btn-primary">Pievienot jaunu fakultāti</a><br><br>
    @endif
    <a href="/" class ="btn btn-primary">Atpakaļ</a>

 @endsection