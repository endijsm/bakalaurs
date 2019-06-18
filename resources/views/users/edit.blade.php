@extends('layouts.app')

@section('content')
        
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4>Labot lietotāja datus</h4></div>

                    <div class="card-body">
                        {!! Form::open(['action' => ['UsersController@updateFromAdminAccount', $user->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

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
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Lietotāja tips') }}</label>
                                <div class="col-md-6">
                                    {{Form::select('user_type', $user_types, $user->user_type_id, ['class' => 'form-control', 'onchange' => 'userTypeOnChange(this)'])}}<br>
                                    @if($user->is_lecturer && $user->user_type->type == 'lecturer')
                                        <div id="is_lecturer_chbox" style="display:none;">
                                            {{Form::checkbox('is_lecturer_checkbox')}} Pasniedzējs<br>
                                            <label>* Atzīmējiet, ja lietotājs ir arī pasniedzējs</label>
                                        </div>
                                    @elseif(!$user->is_lecturer)
                                        <div id="is_lecturer_chbox">
                                            {{Form::checkbox('is_lecturer_checkbox')}} Pasniedzējs<br>
                                            <label>* Atzīmējiet, ja lietotājs ir arī pasniedzējs</label>
                                        </div>
                                    @else
                                        <div id="is_lecturer_chbox">
                                            {{Form::checkbox('is_lecturer_checkbox', 0, true)}} Pasniedzējs<br>
                                            <label>* Atzīmējiet, ja lietotājs ir arī pasniedzējs</label>
                                        </div> 
                                    @endif
                                </div> 
                            </div>
                            <div class="form-group row">
                                {{Form::label('email_label', 'E-pasts:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                <div class="col-md-6">
                                    {{Form::text('email', $user->email, ['class' => 'form-control'])}}<br>                               
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('username_label', 'Lietotājvārds:', ['class' => 'col-md-4 col-form-label text-md-right'])}}                              
                                <div class="col-md-6">
                                    {{Form::text('username', $user->username, ['class' => 'form-control'])}}<br>                               
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Jaunā parole') }}</label>
    
                                <div class="col-md-6">
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Jaunā parole atkārtoti') }}</label>
    
                                <div class="col-md-6">
                                    <input type="password" name="new_password_confirmation" class="form-control"><br>
                                    <label>* Ja nav nepieciešams mainīt paroli, atstājiet paroles ievades laukus tukšus</label>
                                </div>
                            </div>

                            {{Form::hidden('_method', 'PUT')}} 
                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-4">
                                    {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
                                </div>
                                <div class="col-md-4">
                                    <a href="/all_users" class="btn btn-outline-secondary">Atpakaļ</a>
                                </div>
                            </div>                                                                                            
                        {!! Form::close() !!}                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection