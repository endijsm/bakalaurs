@extends('layouts.app')

@section('content')
    <h1>Saglabātie pārskati</h1><br>

    <br><br>
    <ul class="list-group">
        <li class="list-group-item"><a href="/report/structures_report">Augstskolas fakultātes, studiju virzieni un studiju programmas</a></li>
        <li class="list-group-item"><a href="/report/employees_report">Augstskolas darbinieki</a></li>
    </ul>

    <br><br>
    <a href="/" class ="btn btn-primary">Atpakaļ</a>

 @endsection