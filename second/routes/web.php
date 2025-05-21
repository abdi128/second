<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');





require __DIR__.'/settings.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/patient-auth.php';
require __DIR__.'/doctor-auth.php';
require __DIR__.'/labtechnician-auth.php';
