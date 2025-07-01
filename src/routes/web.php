<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [ContactController::class, 'index']);
});
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/edit', [ContactController::class, 'edit'])->name('form.edit');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');
Route::post('/thanks', [ContactController::class, 'store']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
    })->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
Route::delete('/contacts/delete', [AdminController::class, 'destroy'])->name('destroy');

Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');