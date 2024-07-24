<?php

use App\Http\Controllers\User\LikeListController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\PhotoController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\SearchController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[UserController::class,'guest']);
Route::middleware(['auth:users', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/photo',[PhotoController::class,'show'])->name('profile.photo.show');
    Route::get('/profile/photo/{id}',[PhotoController::class,'edit'])->name('profile.photo.edit');
    Route::delete('/profile/photo/{id}',[PhotoController::class,'destroy'])->name('profile.photo.destroy');
    Route::put('/profile/photo/{id}',[PhotoController::class,'update'])->name('profile.photo.update');
    Route::get('/profile/like/',[LikeListController::class,'show'])->name('profile.like');
});

Route::get('/getContent',[UserController::class,'getContent']);
Route::get('/searchContent',[UserController::class,'searchContent']);

Route::middleware(['auth:users','verified'])->group(function () {
    Route::get('/dashboard',[UserController::class,'index'])->name('dashboard');
    Route::get('/photo/detail/{id}',[UserController::class,'photoDetail'])->name('photo.detail');
    Route::get('/upload',[UserController::class,'create'])->name('upload');
    Route::post('/upload/store', [UserController::class,'store'])->name('upload.store');
    Route::post('/like',[LikeController::class,'like'])->name('photo.like');
    Route::get('/photo_searches',[SearchController::class,'search'])->name('search');
    Route::get('/photo_searches/result',[SearchController::class,'searchResult'])->name('search.result');
});
require __DIR__.'/auth.php';
