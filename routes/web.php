<?php

use App\Http\Controllers\HomeController;
use App\Models\Contributor;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);

Route::get('/contributor/{contributor:login}', function (Contributor $contributor) {
    return view('pages.contributor', [
        'contributor' => $contributor,
    ]);
})->name('contributor');
