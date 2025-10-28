<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);

});


Route::middleware(['auth', 'verified', 'role:manager'])->group(function () {

    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('clients', ClientController::class);    


});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::resource('clients', ClientController::class);

    Route::resource('users', UserController::class);

    Route::resource('projects', ProjectController::class);
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
