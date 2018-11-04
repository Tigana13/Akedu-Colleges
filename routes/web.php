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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Courses
Route::get('/courses', 'Courses\CoursesController@index')->name('courses.index');
Route::post('/courses/create', 'Courses\CoursesController@addCourse')->name('courses.create.post');

//Facilities
Route::get('/facilities', 'Facilities\FacilitiesController@index')->name('facilities.index');
Route::post('/facilities/create', 'Facilities\FacilitiesController@addFacility')->name('facilities.create.post');

//Intakes
Route::get('/intakes', 'Intakes\IntakesController@index')->name('intakes.index');
Route::post('/intakes/create', 'Intakes\IntakesController@addIntake')->name('intakes.create.post');
