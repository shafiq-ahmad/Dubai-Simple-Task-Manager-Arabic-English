<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\RoleController;

Route::middleware('auth:sanctum')->group(function () {
	/*
	Headers
		Accept: application/json
		Authorization: Bearer token
		
	*/
	Route::apiResource('companies',CompanyController::class);
	Route::apiResource('roles',RoleController::class);

});

Route::post('/login', [AuthController::class,'login']);

