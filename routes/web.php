<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('index');
});*/
Route::get('/', 'PagesController@showIndexPage');
Route::get('/admin', 'PagesController@showAdminPage')->middleware('admin');
Route::get('/all_users', 'PagesController@showAllUsersPage')->middleware('admin');;
Route::get('/myaccount', 'PagesController@showMyAccountPage');
Route::get('/myaccount_edit', 'PagesController@showMyAccountEditPage');
Route::post('/myaccount_edit', 'UsersController@update');
Route::get('/myaccount_change_passwd', 'PagesController@showChangePasswdPage');
Route::post('/myaccount_change_passwd', 'UsersController@changePasswd')->middleware('auth');
Route::get('/users/{user}/edit', 'UsersController@edit')->middleware('admin');
Route::put('/users/{user}', 'UsersController@updateFromAdminAccount')->middleware('admin');
Route::delete('/users/{user}', 'UsersController@destroy')->middleware('admin');

Route::get('/mapping/{program}', 'StudyProgramsController@showMapping');

Route::resource('courses', 'StudyCoursesController');
Route::post('/courses/create/', 'StudyCoursesController@uploadFile');
Route::post('/courses/filter', 'StudyCoursesController@filterCourses');
Route::resource('faculties', 'FacultiesController');
Route::resource('programs', 'StudyProgramsController');
Route::resource('directions', 'StudyDirectionsController');
Route::resource('program_results', 'StudyProgramResultsController');
Route::resource('catalogs', 'CatalogsController');
Route::get('/catalog/{catalog_id}/course/{course_id}', 'CatalogsController@show_course_in_catalog');
Route::get('/reports', 'PagesController@showAllReportsPage');
Route::get('/report/structures_report', 'PagesController@showStructuresReport');
Route::get('/report/employees_report', 'PagesController@showEmployeesReport');
Auth::routes();
