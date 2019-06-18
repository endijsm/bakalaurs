@extends('layouts.app')

@section('content')
    
    <h3>Visi sistēmas lietotāji</h3><br>
    <br><a href="/" class="btn btn-primary">Atpakaļ</a><br><br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Vārds, uzvārds</th>
                <th>Lietotājvārds</th>
                <th>E-pasts</th>
                <th>Grāds</th>
                <th>Amats</th>
                <th>Lietotāja tips</th>
                <th>Labot</th>
                <th>Dzēst</th>
                <th>Pievienots</th>
                <th>Pēdējo reizi labots</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->firstname.' '.$user->lastname}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->degree}}</td>
                    <td>{{$user->position}}</td>
                    <td>{{$user->user_type->description}}</td>
                    <td><a href="/users/{{$user->id}}/edit" class="btn btn-outline-dark">Labot</a></td>
                    <td>
                        {!!Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Dzēst', ['class' => 'btn btn-outline-dark delete-user'])}}
                        {!!Form::close()!!}
                    </td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br>
    <!-- next line is for pagination-->
    {{ $users->links() }}

    <br><a href="/" class="btn btn-primary">Atpakaļ</a><br><br>
    
@endsection
 