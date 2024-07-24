<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\CameraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserPhotoController;

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


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->middleware('verified')->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/photo/edit{id}', [UserPhotoController::class, 'photoEdit'])->name('users.photo.edit');
    Route::put('/users/photo/edit{photo}', [UserPhotoController::class, 'update'])->name('users.photo.update');
    Route::delete('/users/photo/destroy{id}', [UserPhotoController::class, 'destroy'])->name('users.photo.destroy');
    Route::get('/retrieve',[UserController::class, 'retrieve'])->name('users.retrieve');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/camera/index', [CameraController::class, 'index'])->name('camera.index');
    Route::get('/camera/retrieve',[CameraController::class, 'retrieve'])->name('camera.retrieve');
    Route::get('/camera/create', [CameraController::class, 'create'])->name('camera.create');
    Route::post('/camera/store', [CameraController::class, 'store'])->name('camera.store');
    Route::get('/camera/{kind}', [CameraController::class, 'destroy'])->name('camera.destroy');
    Route::delete('/camera/{kind}', [CameraController::class, 'destroy'])->name('camera.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

