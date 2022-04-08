<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

// Category
Route::get('category/all', [CategoryController::class, 'index'])->name('all.category');
Route::post('category/add', [CategoryController::class, 'store'])->name('store.category');
Route::get('category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('category/update/{id}', [CategoryController::class, 'update']);
Route::get('category/softdelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('category/delete_permanently/{id}', [CategoryController::class, 'DeletePermanent']);

// BRAND
Route::get('brand/all', [BrandController::class, 'index'])->name('all.brand');
Route::post('brand/add', [BrandController::class, 'store'])->name('store.brand');
Route::get('brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('brand/update/{id}', [BrandController::class, 'update']);
Route::get('brand/delete/{id}', [BrandController::class, 'destroy']);


Route::middleware(['auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {

        // ELOQUENT ORM
        // $users = User::all();

        // QUERY BUILDER
        $users = DB::table('users')->get();

        return view('dashboard', compact('users'));
    })->name('dashboard');
});
