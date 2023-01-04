<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

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



Route::middleware('signed')->group(function(){
    Route::get('user-page', [UserController::class, 'uniqueLink'])->name('user-page');
    Route::get('generate-link', [UserController::class, 'generateLink'])->name('generate-link');
    Route::get('deactivate-link', [UserController::class, 'deactivateLink'])->name('deactivate-link');
    Route::get('feeling-lucky', [UserController::class, 'feelingLucky'])->name('feeling-lucky');
    Route::get('history', [UserController::class, 'history'])->name('history');
});

Route::middleware([])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('admin', [UserController::class, 'getTopDistributorsView'])->name('admin');
    Route::put("admin/edit", [UserController::class, 'autocomplete'])->name('admin.edit');
    Route::post('admin/create', [UserController::class, 'search'])->name('admin.create');
    Route::delete('admin/delete', [UserController::class, 'search'])->name('admin.delete');
}
);
