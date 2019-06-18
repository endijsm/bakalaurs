@extends('layouts.app')

@section('content')
    <h1>Kursu katalogi</h1><br>

    @if(count($catalogs) > 0)
        @foreach ($catalogs as $catalog)
            <ul class="list-group">
                <li class="list-group-item"><a href="/catalogs/{{$catalog->id}}">{{$catalog->name.' '}}</a></li>                                                           
            </ul>
        @endforeach
        <br><br>
        <!-- next line is for pagination-->
        {{ $catalogs->links() }}
        
    @else
        <p>Sistēmā nav reģistrētu kursu katalogu</p>
    @endif

    <br>
    @if(Auth::user()->canDefineCatalog())
        <a href="/catalogs/create" class ="btn btn-primary">Pievienot jaunu kursu katalogu</a><br><br>
    @endif
    <a href="/" class ="btn btn-primary">Atpakaļ</a>

 @endsection