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


Route::middleware([])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user-page', [UserController::class, 'uniqueLink'])->name('user-page')->middleware('signed');
    Route::post('generate-link', [UserController::class, 'generateLink'])->name('generate-link');
    Route::post('deactivate-link', [UserController::class, 'deactivateLink'])->name('deactivate-link');
    Route::post('feeling-lucky', [UserController::class, 'feelingLucky'])->name('feeling-lucky');
    Route::post('history', [UserController::class, 'history'])->name('history');

    Route::get('admin', [UserController::class, 'getTopDistributorsView'])->name('admin');
    Route::put("admin/edit", [UserController::class, 'autocomplete'])->name('admin.edit');
    Route::post('admin/create', [UserController::class, 'search'])->name('admin.create');
    Route::delete('admin/delete', [UserController::class, 'search'])->name('admin.delete');
}
);
