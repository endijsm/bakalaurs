@extends('layouts.app')

@section('content')

    <h1>Augstskolas darbinieki</h1>
    <br>
    <p>Tiek attēloti tie darbinieki, kuri ir saglabāti sistēmā (ir sistemas lietotāji). Ja darbinieks nav saglabāts šajā sistēmā, tad tas netiek attēlots zemāk</p>
    <br>
    <a href="/reports" class ="btn btn-primary">Atpakaļ</a>
    <br><br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Vārds, uzvārds</th>
                <th>Grāds</th>
                <th>Amats</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->firstname.' '.$user->lastname}}</td>
                    <td>{{$user->degree}}</td>
                    <td>{{$user->position}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <a href="/reports" class ="btn btn-primary">Atpakaļ</a>
    <br><br>

@endsection