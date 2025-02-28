<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('api')->group(function () {
    Route::get('/configurations', [\App\Http\Controllers\RBAC\SupportController::class, 'configurations']);
    Route::post('/login',[ \App\Http\Controllers\Auth\AuthController::class,'login']);
    Route::post('/logout',[ \App\Http\Controllers\Auth\AuthController::class,'logout']);
});

Route::prefix('rbac')->group(function () {
    Route::resource('modules',\App\Http\Controllers\RBAC\ModulesController::class);
    Route::resource('roles',\App\Http\Controllers\RBAC\RolesController::class);
    Route::resource('users',\App\Http\Controllers\RBAC\UserController::class);
    Route::resource('role_permissions',\App\Http\Controllers\RBAC\RolePermissionsController::class);
});

Route::prefix('academics')->group(function () {
    Route::resource('subjects',\App\Http\Controllers\Academic\SubjectsController::class);
    Route::resource('classes',\App\Http\Controllers\Academic\ClassesController::class);
    Route::resource('sections',\App\Http\Controllers\Academic\SectionsController::class);
    Route::resource('syllabus',\App\Http\Controllers\Academic\SyllabusController::class);
    Route::resource('classrooms',\App\Http\Controllers\Academic\ClassRoomController::class);
    Route::resource('class_routines',\App\Http\Controllers\Academic\ClassRoutinesController::class);
    Route::resource('day',\App\Http\Controllers\Academic\DayController::class);
});

Route::prefix('users')->group(function () {
    Route::resource('teachers',\App\Http\Controllers\Users\TeacherController::class);
    Route::resource('teacherregfrom',\App\Http\Controllers\Users\TeacherController::class);
    Route::resource('students',\App\Http\Controllers\Users\StudentsController::class);
    Route::resource('studentregfrom',\App\Http\Controllers\Users\StudentsController::class);
    Route::resource('parents',\App\Http\Controllers\Users\ParentsController::class);
    Route::resource('parentregfrom',\App\Http\Controllers\Users\ParentsController::class);
});

Route::prefix('notice')->group(function () {
    Route::resource('notice_categories',\App\Http\Controllers\Notice\NoticeCategoriesController::class);
});

Route::resource('upload',\App\Http\Controllers\UplodController::class);
Route::resource('genareldata',\App\Http\Controllers\Users\UserSupportController::class);
Route::resource('filtter_routines',\App\Http\Controllers\Academic\ClassRoutinesSupportController::class);

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('backend.login'));
});



Route::get('/bac', function () {
    return view('backend');
});


Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin/{any}', function () {
//    return view('backend.index');
//})->where('any', '.*');

Route::middleware('AuthCheck')->group(function () {
    Route::view('/admin/{any}', 'backend.index')->where('any', '.*');
});

