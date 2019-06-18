@extends('layouts.app')

@section('content')
        <h1>Labot profila datus</h1>
        <br>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><h4>Mana profila informācija</h4></div>
    
                        <div class="card-body">
                                {!! Form::open(['action' => ['UsersController@update'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        
                                    <div class="form-group row">
                                        {{Form::label('firstname_label', 'Vārds:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                        <div class="col-md-6">
                                            {{Form::text('firstname', $user->firstname, ['class' => 'form-control'])}}<br>                               
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{Form::label('lastname_label', 'Uzvārds:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                        <div class="col-md-6">
                                            {{Form::text('lastname', $user->lastname, ['class' => 'form-control'])}}<br>                               
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{Form::label('degree_label', 'Grāds:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                        <div class="col-md-6">
                                            {{Form::text('degree', $user->degree, ['class' => 'form-control'])}}<br>                               
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{Form::label('position_label', 'Amats:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                        <div class="col-md-6">
                                            {{Form::text('position', $user->position, ['class' => 'form-control'])}}<br>                               
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        {{Form::label('email_label', 'E-pasts:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                        <div class="col-md-6">
                                            {{Form::text('email', $user->email, ['class' => 'form-control'])}}<br>                               
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-0">
                                        <div class="col-md-2 offset-md-4">
                                            {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
                                        </div>
                                        <div class="col-md-4">
                                            <a href="/myaccount" class="btn btn-outline-secondary">Atpakaļ</a>
                                        </div>
                                    </div>                                                                                            
                                {!! Form::close() !!}                       
                            </div>
                    </div>
                </div>
            </div>
        </div>
@endsection