<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('error');
});

require __DIR__ . '/app.php';
require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
