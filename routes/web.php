<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
    require __DIR__.'/projects.php';
    require __DIR__.'/issues.php';
    require __DIR__.'/tags.php';
