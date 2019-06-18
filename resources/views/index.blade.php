@extends('layouts.app')

@section('content')
	<img src="{{ asset('vea_logo_large.png') }}" alt="VeA logo" style="display: block; width: 70%; margin: auto;">
	<br><h1 class="pt-5 text-center font-weight-bold">Studiju kursu aprakstu un katalogu pārvaldības sistēma</h1>
	<br><br>
	@if(Auth::check())
		@if(Auth::user()->canViewCourseDescriptions())
			<a href="/courses" class="btn btn-secondary btn-lg btn-block">Kursu apraksti</a>
		@endif
		@if(Auth::user()->canViewCatalog())
			<a href="/catalogs" class="btn btn-secondary btn-lg btn-block">Studiju kursu katalogi</a>
		@endif
		@if(Auth::user()->canViewStructures())        
			<a href="/faculties" class="btn btn-secondary btn-lg btn-block">Fakultātes</a>
			<a href="/programs" class="btn btn-secondary btn-lg btn-block">Studiju programmas</a>
		@endif
		@if(Auth::user()->canViewReports()) 
			<a href="/reports" class="btn btn-secondary btn-lg btn-block">Pārskati</a><br><br>
		@endif
		@if(Auth::user()->isAdmin())
			<a href="/register" class="btn btn-secondary btn-lg btn-block">Pievienot jaunu lietotāju</a>
    		<a href="/all_users" class="btn btn-secondary btn-lg btn-block">Visi sistēmas lietotāji (skatīt, labot, dzēst)</a>
		@endif
	@endif

	@if(Auth::guest())
		<h3>Kursu katalogi (viesu piekļuve):</h3><br>
		@foreach($catalogs as $catalog)
			<ul class="list-group">                  
				<li class="list-group-item"><a href="/catalogs/{{$catalog->id}}">{{$catalog->name}}</a></li>                           
			</ul>
		@endforeach
	@endif
	@if(Auth::check() && Auth::user()->user_type->type == 'student')
		<br><br>
		<h3>Kursu katalogi, kuri pieejami studentiem:</h3><br>
		@foreach($catalogs as $catalog)
			<ul class="list-group">                  
				<li class="list-group-item"><a href="/catalogs/{{$catalog->id}}">{{$catalog->name}}</a></li>                           
			</ul>
		@endforeach
	@endif

	<br><br><br>

@endsection