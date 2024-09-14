<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('sections', SectionController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('themes', ThemeController::class);
    Route::resource('messages', MessageController::class);

    Route::get('sections/{section}/branches', [SectionController::class, 'sectionBranches'])->name('sections.branches');

    Route::get('branches/{branch}/theme/create', [BranchController::class, 'themeCreate'])->name('branches.theme.create');

    Route::post('messages/{message}/likes', [MessageController::class, 'toggleLike'])->name('messages.like');

    Route::post('messages/{message}/complaints', [MessageController::class, 'complaint'])->name('messages.complaint');

    Route::post('images', [ImageController::class, 'store'])->name('images.store');

    Route::get('users/personal', [UserController::class, 'personal'])->name('users.personal');
    Route::put('users/personal', [UserController::class, 'update'])->name('users.personal.update');

    Route::get('admin', [MainController::class, 'index'])->name('admin.index');
    Route::get('admin/complaints', [MainController::class, 'complaints'])->name('admin.complaints');
    Route::put('admin/complaints/{complaint}', [MainController::class, 'updateComplaint'])->name('admin.complaints.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
