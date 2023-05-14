<?php

use App\Http\Controllers\ArchiveLogsWebController;
use App\Http\Controllers\CurrentLogWebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false, 'verify' => false, 'confirm' => false]);

Route::get('/', fn() => response()->redirectToRoute('login'))->name('index');
Route::get('/home', [CurrentLogWebController::class, 'getCurrentEmails'])->name('home');
Route::get('/logout', function() {
    Auth::logout();
    return response()->redirectToRoute('login');
});

Route::get('/current-emails', [CurrentLogWebController::class, 'getCurrentEmails'])->name('getCurrentEmails');
Route::get('/current-log-rows', [CurrentLogWebController::class, 'getCurrentLogRows'])->name('getCurrentLogRows');
Route::get('/archive-emails', [ArchiveLogsWebController::class, 'getArchiveEmails'])->name('getArchiveEmails');
Route::get('/archive-log-rows', [ArchiveLogsWebController::class, 'getArchiveLogRows'])->name('getArchiveLogRows');
