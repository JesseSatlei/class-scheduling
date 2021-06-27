<?php
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\UserController;

//example test postman http://localhost:8000/api/lessons
Route::get('lessons', [App\Http\Controllers\Api\LessonController::class, 'index']);
Route::post('lessons', [App\Http\Controllers\Api\LessonController::class, 'store']);
Route::get('lessons/{id}', [App\Http\Controllers\Api\LessonController::class, 'show']);
Route::put('lessons/{id}', [App\Http\Controllers\Api\LessonController::class, 'update']);
Route::delete('lessons/{id}', [App\Http\Controllers\Api\LessonController::class, 'destroy']);

Route::get('users', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('users', [App\Http\Controllers\Api\UserController::class, 'store']);
Route::get('users/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::put('users/{id}', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::delete('users/{id}', [App\Http\Controllers\Api\UserController::class, 'destroy']);

Route::get('permissions', [App\Http\Controllers\Api\PermissionController::class, 'index']);
Route::post('permissions', [App\Http\Controllers\Api\PermissionController::class, 'store']);
Route::get('permissions/{id}', [App\Http\Controllers\Api\PermissionController::class, 'show']);
Route::put('permissions/{id}', [App\Http\Controllers\Api\PermissionController::class, 'update']);
Route::delete('permissions/{id}', [App\Http\Controllers\Api\PermissionController::class, 'destroy']);