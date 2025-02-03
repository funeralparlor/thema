<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// List Page
Route::get('/list', function () {
    return view('list');
})->name('list');

// Search Page
Route::get('/search', function () {
    return view('search');
})->name('search');

// reports Page
Route::get('/reports', function () {
    return view('reports');
})->name('reports');

// About Page
Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact Page
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Dashboard Routes

// Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');


// Inside the auth middleware group
Route::controller(StudentController::class)->group(function () {
    Route::get('/students/create', 'create')->name('students.create');
    Route::post('/students', 'store')->name('students.store');
    //Inside StudentController group
Route::get('/students', 'index')->name('students.index');
Route::get('/students/export-csv', 'exportCSV')->name('students.export.csv');
Route::get('/students/export-pdf', 'exportPDF')->name('students.export.pdf');

});



});


