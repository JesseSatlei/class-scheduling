<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/class', [App\Http\Controllers\ClassController::class, 'index'])->name('class');
Route::get('/classForm', [App\Http\Controllers\ClassController::class, 'form'])->name('classForm');
Route::get('/classInfo/{id}', [App\Http\Controllers\ClassController::class, 'info'])->name('classInfo');
Route::get('/classEnter/{id}', [App\Http\Controllers\ClassController::class, 'enter'])->name('classEnter');
Route::get('/classCancelation/{id}', [App\Http\Controllers\ClassController::class, 'cancelation'])->name('classCancelation');
Route::get('/classStudent', [App\Http\Controllers\ClassController::class, 'studentRequest'])->name('classStudent');
Route::post('/classStore', [App\Http\Controllers\ClassController::class, 'store'])->name('classStore');
Route::post('/classStudentConfirm', [App\Http\Controllers\ClassController::class, 'confirmStudent'])->name('classStudentConfirm');

Route::get('/adminPermission', [App\Http\Controllers\AdminController::class, 'adminPermission'])->name('adminPermission');
Route::get('/registerPermission', [App\Http\Controllers\AdminController::class, 'registerPermission'])->name('registerPermission');
Route::get('/updatePermission/{id}', [App\Http\Controllers\AdminController::class, 'updatePermission'])->name('updatePermission');
Route::post('/createPermission', [App\Http\Controllers\AdminController::class, 'createPermission'])->name('createPermission');
Route::put('/permissionUpdate', [App\Http\Controllers\AdminController::class, 'permissionUpdate'])->name('permissionUpdate');
Route::delete('/destroyPermission/{id}', [App\Http\Controllers\AdminController::class, 'destroyPermission'])->name('destroyPermission');

Route::get('/adminClass', [App\Http\Controllers\AdminController::class, 'adminClass'])->name('adminClass');
Route::get('/registerLesson', [App\Http\Controllers\AdminController::class, 'registerLesson'])->name('registerLesson');
Route::get('/lessorFormUpdate/{id}', [App\Http\Controllers\AdminController::class, 'lessorFormUpdate'])->name('lessorFormUpdate');
Route::get('/lessonInfo/{id}', [App\Http\Controllers\AdminController::class, 'lessonInfo'])->name('lessonInfo');
Route::post('/createLesson', [App\Http\Controllers\AdminController::class, 'createLesson'])->name('createLesson');
Route::put('/lessonUpdate', [App\Http\Controllers\AdminController::class, 'lessonUpdate'])->name('lessonUpdate');
Route::delete('/destroyLesson/{id}', [App\Http\Controllers\AdminController::class, 'destroyLesson'])->name('destroyLesson');

Route::get('/adminStudent', [App\Http\Controllers\AdminController::class, 'adminStudent'])->name('adminStudent');
Route::get('/adminProf', [App\Http\Controllers\AdminController::class, 'adminProf'])->name('adminProf');
Route::get('/adminUserUpdate/{id}', [App\Http\Controllers\AdminController::class, 'userForm'])->name('adminUserUpdate');
Route::get('/adminUserInfo/{id}', [App\Http\Controllers\AdminController::class, 'userInfo'])->name('adminUserInfo');
Route::post('/adminProfRegister', [App\Http\Controllers\AdminController::class, 'createdUser'])->name('adminProfRegister');
Route::put('/userUpdate', [App\Http\Controllers\AdminController::class, 'userUpdate'])->name('userUpdate');
Route::delete('/adminProfDelete/{id}', [App\Http\Controllers\AdminController::class, 'userDelete'])->name('adminProfDelete');

Route::get('/adminRegister', [App\Http\Controllers\AdminController::class, 'createUser'])->name('adminRegister');
