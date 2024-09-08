<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyIncomeController;
use App\Http\Controllers\DailyRankcheckController;


Route::get('/checktrasnction', [DailyIncomeController::class, 'checktrasnction']);
Route::get('/dailyincome', [DailyIncomeController::class, 'dailyincome']);
Route::get('/rankcheck', [DailyRankcheckController::class, 'rankcheck']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
