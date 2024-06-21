<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\HomeController;

Route::get('/upload', function () {
    return view('uploadTrackPage');
})->middleware('auth');

Route::post('/new_music', [MusicController::class, 'New_Music'])->name('NewMusic')->middleware('auth');

Route::post('/new/albom', [MusicController::class, 'New_Albom'])->name('NewAlbom')->middleware('auth');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'main'])->name('main');

Route::get('/home/{user_id}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/track/{id}', [App\Http\Controllers\TrackController::class, 'show_track'])->name('ShawTrack');

Route::get('/albom/{id}', [App\Http\Controllers\TrackController::class, 'show_albom'])->name('ShawAlbom');

Route::get('/like/{track_id}', [App\Http\Controllers\TrackController::class, 'like'])->name('Like')->middleware('auth');

Route::post('/new_comment/{id}', [App\Http\Controllers\TrackController::class, 'new_comment'])->name('NewCommetn')->middleware('auth');

Route::post('/albom/new_track/{albom_id}', [App\Http\Controllers\TrackController::class, 'new_track_in_albom'])->name('NewTrackinAlbom')->middleware('auth');

Route::get('/del_comment/{comment_id}', [App\Http\Controllers\TrackController::class, 'delete_comment'])->name('DeleteComm')->middleware('auth');

Route::get('/del_track/{track_id}', [App\Http\Controllers\TrackController::class, 'delete_track'])->name('deleteTrack')->middleware('auth');

Route::get('/del_albom/{albom_id}', [App\Http\Controllers\TrackController::class, 'delete_albom'])->name('deleteAlbom')->middleware('auth');

Route::put('/new_avatar', [HomeController::class, 'avatar'])->name('NewAvatar')->middleware(['auth']);

Route::post('/search', [HomeController::class, 'search'])->name('search');