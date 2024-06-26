<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');

Route::post('/accounts/create', [AccountController::class, 'store'])->name('accounts.store');


Route::delete('/accounts/{id}', [AccountController::class, 'destroy'])->name('accounts.destroy');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
Route::delete('/accounts/soft-delete/{id}', [AccountController::class, 'softDelete'])->name('accounts.softDelete');
Route::get('/accounts/soft-deleted', [AccountController::class, 'softDeleted'])->name('accounts.softDeleted');
Route::put('/accounts/{id}/restore', [AccountController::class, 'restore'])->name('accounts.restore');
