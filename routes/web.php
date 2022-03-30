<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Task_commentController;


Route::post('/login/company', [CompanyController::class,'login']);
Route::get('logout', [CompanyController::class,'logout']);
Route::middleware(['auth:company'])->group(function () {
	Route::get('/companies', [CompanyController::class, 'index']);
	Route::get('/projects', [ProjectController::class, 'index']);
	Route::get('/tasks', [TaskController::class, 'index']);
	Route::get('/task', [TaskController::class, 'show']);
	Route::get('/task/create', [TaskController::class, 'create']);
	Route::post('/task/store', [TaskController::class, 'store']);
	Route::post('/task-comment', [Task_commentController::class, 'store']);
});

//hello I'm company Louie Mraz
Route::prefix('gd')->middleware(['auth'])->group(function (){
	Route::resource('archives',ArchiveController::class);
	Route::resource('companies',CompanyController::class);
	Route::resource('projects',ProjectController::class);
	Route::prefix('tasks')->group(function (){
		Route::get('/pending',[TaskController::class,'pending'])->name('tasks.pending');
		//Route::get('/pending',function (){return 'hi';})->name('task.pending');
		Route::resource('comments',Task_commentController::class);
	});
	Route::resource('/tasks',TaskController::class);

});

require __DIR__.'/auth.php';
