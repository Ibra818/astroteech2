<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProjectController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projets', [HomeController::class, 'projets'])->name('projets');
Route::get('/projets/{id}', [HomeController::class, 'show'])->name('projets.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Routes Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
});
