<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
use App\User;
use App\Faculty;
use App\StudyDirection;
use App\StudyProgram;
use Auth;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // access control
        $this->middleware('auth', ['except' => 'showIndexPage']);
        $this->middleware('canViewReports', ['only' => ['showAllReportsPage', 'showStructuresReport', 'showEmployeesReport']]);
    }

    public function showIndexPage()
    {
        if(Auth::guest())
        {
            $catalogs = Catalog::where('available_for_guests', '=', 1)->get();
            return view('index')->with('catalogs', $catalogs);
        }
        else if(Auth::user()->user_type->type == 'student')
        {
            $catalogs = Catalog::where('available_for_students', '=', 1)->get();
            return view('index')->with('catalogs', $catalogs);
        }
        return view('index');
    }

    public function showAdminPage()
    {
        return view('admin.index');
    }

    public function showAllUsersPage()
    {
        $users = User::paginate(10);
        return view('admin.all_users')->with('users', $users);
    }

    public function showMyAccountPage()
    {
        $user = Auth::user();
        return view('users.account_info')->with('user', $user);
    }

    public function showMyAccountEditPage()
    {
        $user = Auth::user();
        return view('users.account_edit')->with('user', $user);
    }

    public function showChangePasswdPage()
    {
        return view('users.change_passwd');
    }

    public function showAllReportsPage()
    {
        return view('reports.allReports');
    }

    public function showStructuresReport()
    {
        $data = [
            'faculties' => Faculty::all(),
            'number_of_study_directions' => StudyDirection::count(),
            'number_of_study_programs' => StudyProgram::count(),
        ];
        
        return view('reports.structures_report')->with($data);
    }

    public function showEmployeesReport()
    {
        $users = User::all();
        return view('reports.employees_report')->with('users', $users);
    }

}

    
