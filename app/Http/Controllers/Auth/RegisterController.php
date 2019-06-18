<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/all_users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function showRegistrationForm()
    {
        $user_types = UserType::pluck('description', 'id');
        return view("auth.register")->with('user_types', $user_types);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // do not log in newly added user
        // $this->guard()->login($user); 

        session()->flash('success', 'Lietotājs pievienots'); 
        return redirect('/all_users');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:30', 'min:2'],
            'lastname' => ['required', 'string', 'max:30', 'min:2'],
            'username' => ['required', 'string', 'max:25', 'min:4', 'unique:users'],
            'degree' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'user_type' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ],[
            'firstname.required' => 'Nav ievadīts jaunā lietotāja vārds!',
            'firstname.min' => 'Ievadītais vārds ir pārāk īss!',
            'firstname.max' => 'Ievadītais vārds ir pārāk garš!',
            'lastname.required' => 'Nav ievadīts jaunā lietotāja uzvārds!',
            'lastname.min' => 'Ievadītais uzvārds ir pārāk īss!',
            'lastname.max' => 'Ievadītais uzvārds ir pārāk garš!',
            'username.required' => 'Nav ievadīts lietotājvārds!',
            'username.min' => 'Ievadītais lietotājvārds ir pārāk īss!',
            'username.max' => 'Ievadītais lietotājvārds ir pārāk garš!',
            'username.unique' => 'Lietotājvārds ir aizņemts!',
            'degree.max' => 'Ievadītais grāds ir pārāk garš!',
            'position.max' => 'Ievadītais amats ir pārāk garš!',
            'email.required' => 'Nav ievadīts jaunā lietotāja e-pasts!',
            'email.max' => 'Ievadītais e-pasts ir pārāk garš!',
            'email.email' => 'Ievadīts nepareizs e-pasts!',
            'user_type.required' => 'Nav norādīts lietotāja tips!',
            'password.required' => 'Nav ievadīta jaunā lietotāja parole!',
            'password.confirmed' => 'Ievadītās paroles nesakrīt!',
            'password.min' => 'Parole ir pārāk īsa! Parolei jāsatur vismaz 6 simbolus!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['degree'] == '' && $data['position'] == '')
        {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'email' => $data['email'],
                'user_type_id' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]);
        }
        else if($data['degree'] == '')
        {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'position' => $data['position'],
                'email' => $data['email'],
                'user_type_id' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]);
        }
        else if($data['position'] == '')
        {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'degree' => $data['degree'],
                'email' => $data['email'],
                'user_type_id' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]);
        }
        else
        {
            $user = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'username' => $data['username'],
                'degree' => $data['degree'],
                'position' => $data['position'],
                'email' => $data['email'],
                'user_type_id' => $data['user_type'],
                'password' => Hash::make($data['password']),
            ]);
        }

        if($data['user_type'] == 1 || isset($data['is_lecturer_checkbox']))
        {
            $user->is_lecturer = 1;
            $user->save();
        }

        return $user;
    }
}
