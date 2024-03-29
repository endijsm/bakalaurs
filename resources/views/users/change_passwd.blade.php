@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mainīt paroli</div>

                    <div class="card-body">
                       
                        <form class="form-horizontal" method="POST" action="{{action('UsersController@changePasswd')}}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Parole') }}</label>
    
                                <div class="col-md-6">
                                    <input type="password" name="current_password" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Jaunā parole') }}</label>
    
                                <div class="col-md-6">
                                    <input type="password" name="new_password" class="form-control"  required>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Jaunā parole atkārtoti') }}</label>
    
                                <div class="col-md-6">
                                    <input type="password" name="new_password_confirmation" class="form-control"  required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __('Mainīt paroli') }}</button>
                                </div>
                                <div class="col-md-4">
                                    <a href="/myaccount" class="btn btn-outline-secondary">Atpakaļ</a>
                                </div>
                            </div>                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection