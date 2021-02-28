<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\auth\GitlabController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/auth/github/redirect', [GithubController::class, 'redirect'])->name('github/redirect');
Route::get('/auth/github/callback', [GithubController::class, 'callback'])->name('github/callback');

Route::get('/auth/gitlab/redirect', [GitlabController::class, 'redirect'])->name('gitlab/redirect');
Route::get('/auth/gitlab/callback', [GitlabController::class, 'callback'])->name('gitlab/callback');

Route::get('/', [MapController::class, 'index']);
Route::get('/cars', [CarsController::class, 'index'])->name('car/latest');

Route::get('/cars/new', [CarsController::class, 'create'])->name('car/new')->middleware('auth');
Route::post('/cars', [CarsController::class, 'store'])->name('car/store')->middleware('auth');

Route::get('/cars/{car}', [CarsController::class, 'show'])->name('car/show');
Route::get('/cars/{car}/edit', [CarsController::class, 'edit'])->name('car/edit')->middleware('can:update,car');
Route::put('/cars/{car}', [CarsController::class, 'update'])->name('car/update')->middleware('can:update,car');

Route::delete('/cars/{car}', [CarsController::class, 'destroy'])->name('car/delete')->middleware('can:delete,car');

Route::get('/cars/location/{place_id}', [CarsController::class, 'showByPlace'])->name('car/place');

Route::get('/search', [CarsController::class, 'search'])->name('car/search');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user/show');
