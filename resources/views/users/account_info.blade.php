@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Mana profila informācija</h4></div>

                    <div class="card-body">
                        
                        <table class="table">  
                            <tbody>
                                <tr>
                                    <th scope="row">Jūsu vārds, uzvārds:</th>
                                    <td>{{$user->firstname.' '.Auth::user()->lastname}}</td>                              
                                </tr>
                                <tr>
                                    <th scope="row">Grāds:</th>
                                    <td>{{$user->degree}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Amats:</th>
                                    <td>{{$user->position}}</td>                               
                                </tr>
                                <tr>
                                    <th scope="row">Lietotājvārds:</th>
                                    <td>{{$user->username}}</td>                              
                                </tr>
                                <tr>
                                    <th scope="row">E-pasts:</th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lietotāja tips:</th>
                                    <td>
                                        {{$user->user_type->description}}
                                        @if($user->is_lecturer && $user->user_type->type != 'lecturer')
                                            , pasniedzējs
                                        @endif
                                    </td>                               
                                </tr>
                                <tr>
                                    <th scope="row">Pievienots sistēmā:</th>
                                    <td>{{$user->created_at}}</td>                              
                                </tr>
                                <tr>
                                    <th scope="row">Pēdējās izmaiņas izdarītas:</th>
                                    <td>{{$user->updated_at}}</td>
                                </tr>                                    
                            </tbody>
                        </table>
                        <hr><br>
                        <a href="/myaccount_edit" class ="btn btn-primary">Labot datus</a><br><br>
                        <a href="/myaccount_change_passwd" class ="btn btn-primary">Mainīt paroli</a><br><br>

                        <br><hr>
                        <p><strong>Jums piešķirtās sistēmas lietošanas tiesības:</strong></p>
                        <hr>
                        <p>Kursu aprakstu skatīšana: <strong>
                        @if($user->canViewCourseDescriptions())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Kursu aprakstu pievienošana/labošana/dzēšana: <strong>
                        @if($user->canAddCourseDescriptions())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Kursu katalogu skatīšana: <strong>
                        @if($user->canViewCatalog())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Jaunu kursu katalogu definēšana: <strong>
                        @if($user->canDefineCatalog())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Pārskatu skatīšana: <strong>
                        @if($user->canViewReports())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Studiju programmas kursu kartējuma skatīšana: <strong>
                        @if($user->canViewStudyProgramMapping())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Struktūru definēšana (fakultāšu, studiju virzienu, studiju programmu, studiju programmu rezultātu u.c. pievienošana/labošana/dzēšana):  <strong>
                        @if($user->canDefineStructures())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                        <p>Struktūru skatīšana (fakultātes, studiju virzieni, studiju programmas, studiju programmu rezultāti u.c.): <strong>
                        @if($user->canViewStructures())
                            jā
                        @else
                            nē
                        @endif
                        </strong></p>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
@endsection
