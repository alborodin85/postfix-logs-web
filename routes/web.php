<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\BbsController::class, 'index'])->name('index');
Route::get('/{bb}', [\App\Http\Controllers\BbsController::class, 'detail'])->name('detail');
