<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/artisan/migrate', function () {
    Artisan::call('migrate');
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});

Route::get('/artisan/migrate-fresh-seed', function () {
    Artisan::call('migrate:fresh', [
        '--seed' => true,
    ]);
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});

Route::get('/artisan/migrate-status', function () {
    Artisan::call('migrate:status');
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});

Route::get('/artisan/optimize', function () {
    Artisan::call('optimize');
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});

Route::get('/artisan/optimize-clear', function () {
    Artisan::call('optimize:clear');
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});

Route::get('/artisan/storage-link', function () {
    Artisan::call('storage:link');
    $output = Artisan::output();
    return '<pre>' . $output . '</pre>';
});
