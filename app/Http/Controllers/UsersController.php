<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserType;
use Auth;
use Hash;

class UsersController extends Controller
{
    public function edit($id)
    {
        $data =[
            'user' => User::findOrFail($id),
            'user_types' => UserType::pluck('description', 'id')
        ];
        return view('users.edit')->with($data);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:30', 'min:2'],
            'lastname' => ['required', 'string', 'max:30', 'min:2'],
            'degree' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:50'],
            'email' => 'required|email|max:25|unique:users,email,'.$user->id.',id',
        ],[
            'firstname.required' => 'Nav ievadīts lietotāja vārds!',
            'firstname.min' => 'Ievadītais lietotāja vārds ir pārāk īss!',
            'firstname.max' => 'Ievadītais lietotāja vārds ir pārāk garš!',
            'lastname.required' => 'Nav ievadīts lietotāja uzvārds!',
            'lastname.min' => 'Ievadītais lietotāja uzvārds ir pārāk īss!',
            'lastname.max' => 'Ievadītais lietotāja uzvārds ir pārāk garš!',
            'degree.max' => 'Ievadītais grāds ir pārāk garš!',
            'position.max' => 'Ievadītais amats ir pārāk garš!',
            'email.required' => 'Nav ievadīts lietotāja e-pasts!',
            'email.max' => 'Ievadītais e-pasts ir pārāk garš!',
            'email.email' => 'Ievadīts nepareizs e-pasts!',
        ]);
  
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        if(empty($request->input('degree')))
        {
            $user->degree = 'nav norādīts';
        }
        else
        {
            $user->degree = $request->input('degree');
        }
        if(empty($request->input('position')))
        {
            $user->position = 'nav norādīts';
        }
        else
        {
            $user->position = $request->input('position');
        }
        $user->email = $request->input('email');
        $user->save();
        
        return redirect('/myaccount')->with('success', 'Profila dati laboti!');
    }

    public function updateFromAdminAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'firstname' => ['required', 'string', 'max:30', 'min:2'],
            'lastname' => ['required', 'string', 'max:30', 'min:2'],
            'degree' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:50'],
            'email' => 'required|email|max:25|unique:users,email,'.$user->id.',id',
            'username' => 'required|string|max:25|min:4|unique:users,username,'.$user->id.',id',
            'new_password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ],[
            'firstname.required' => 'Nav ievadīts lietotāja vārds!',
            'firstname.min' => 'Ievadītais lietotāja vārds ir pārāk īss!',
            'firstname.max' => 'Ievadītais lietotāja vārds ir pārāk garš!',
            'lastname.required' => 'Nav ievadīts lietotāja uzvārds!',
            'lastname.min' => 'Ievadītais lietotāja uzvārds ir pārāk īss!',
            'lastname.max' => 'Ievadītais lietotāja uzvārds ir pārāk garš!',
            'degree.max' => 'Ievadītais grāds ir pārāk garš!',
            'position.max' => 'Ievadītais amats ir pārāk garš!',
            'email.required' => 'Nav ievadīts lietotāja e-pasts!',
            'email.max' => 'Ievadītais e-pasts ir pārāk garš!',
            'email.email' => 'Ievadīts nepareizs e-pasts!',
            'username.required' => 'Nav ievadīts lietotājvārds!',
            'username.min' => 'Ievadītais lietotājvārds ir pārāk īss!',
            'username.max' => 'Ievadītais lietotājvārds ir pārāk garš!',
            'username.unique' => 'Lietotājvārds ir aizņemts!',
            'new_password.confirmed' => 'Ievadītās paroles nesakrīt!',
            'new_password.min' => 'Parole ir pārāk īsa! Parolei jāsatur vismaz 6 simbolus!',
        ]);
  
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        if(empty($request->input('degree')))
        {
            $user->degree = 'nav norādīts';
        }
        else
        {
            $user->degree = $request->input('degree');
        }
        if(empty($request->input('position')))
        {
            $user->position = 'nav norādīts';
        }
        else
        {
            $user->position = $request->input('position');
        }
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->user_type_id = $request->input('user_type');
        if($request->input('user_type') != 1)
        {
            $user->is_lecturer = 0;
        }
        if($request->has('is_lecturer_checkbox'))
        {
            $user->is_lecturer = 1;
        }
        if($request->input('new_password') != '' && $request->input('new_password_confirmation') != '')
        {
            if($request->input('new_password') != $request->input('new_password_confirmation'))
            {            
                return redirect()->back()->with("error", "Ievadītās paroles nesakrīt!");
            }
            $user->password = bcrypt($request->input('new_password'));
        }
        else if($request->input('new_password') == '' && $request->input('new_password_confirmation') != '' || $request->input('new_password') != '' && $request->input('new_password_confirmation') == '')
        {
            return redirect()->back()->with("error", "Ja vēlaties nomainīt paroli, tā jāievada divas reizes (jaunā parole un jaunā parole atkārtoti)!");
        }
        $user->save();
        
        return redirect('/all_users')->with('success', 'Lietotāja dati laboti!');
    }

    public function changePasswd(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ],[
            'current_password.required' => 'Nav ievadīta pašreizējā parole!',
            'new_password.required' => 'Nav ievadīta jaunā parole!',
            'new_password.confirmed' => 'Ievadītās paroles nesakrīt!',
            'new_password.min' => 'Parole ir pārāk īsa! Parolei jāsatur vismaz 6 simbolus!',
        ]);

        if (!(Hash::check($request->input('current_password'), Auth::user()->password)))
        {            
            return redirect()->back()->with("error", "Nepareiza pašreizējā parole!");
        }
        if($request->input('current_password') == $request->input('new_password'))
        {            
            return redirect()->back()->with("error", "Jaunā parole nedrīkst sakrist ar pašreizējo paroli!");
        }
        /*
        if($request->input('new_password') != $request->input('new_password_confirmation'))
        {            
            return redirect()->back()->with("error", "Nepareiza jaunās paroles atkārtota ievade!");
        }
        */
        $user = Auth::user();
        $user->password = bcrypt($request->input('new_password'));
        $user->save();
        return redirect('/myaccount')->with("success","Parole nomainīta!");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        foreach($user->study_courses as $study_course)
        {
            $study_course->lecturers()->detach($user->id);
        }
        $user->delete();

        return redirect('/all_users')->with('success', 'Lietotājs izdzēsts!');
    }

}
