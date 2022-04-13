<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactformController;
use App\Http\Controllers\MultipictureController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SliderController;
use App\Models\ContactForm;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

// EMAIL VERIFICATION
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/', function () {

    $brands = DB::table('brands')->get();

    $abouts = DB::table('abouts')->first();

    $galleries = DB::table('multipictures')->get();

    return view('home', compact('brands', 'abouts', 'galleries'));
})->name('home');

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


// Multi Images
Route::get('multi-image/all', [MultipictureController::class, 'index'])->name('multi.image');
Route::post('multi-image/add', [MultipictureController::class, 'store'])->name('store.multi-image');


Route::middleware(['auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {

        // ELOQUENT ORM
        // $users = User::all();

        // QUERY BUILDER
        //  $users = DB::table('users')->get();

        return view('Admin.index');
    })->name('dashboard');
});


// Logout route
Route::get('user/logout', function () {
    Auth::logout();

    return redirect()->route('login')->with('success', 'User logged out successfully');
})->name('user.logout');







// ADMIN --ALL ROUTES home.slider
Route::get('slider/all', [SliderController::class, 'index'])->name('home.slider');
Route::get('slider-add', [SliderController::class, 'create']);
Route::post('slider-add', [SliderController::class, 'store'])->name('store.slider');
Route::get('slider/edit/{id}', [SliderController::class, 'edit']);
Route::post('slider/update/{id}', [SliderController::class, 'update']);
Route::get('slider/delete/{id}', [SliderController::class, 'destroy']);

//ABOUT
Route::get('home/about', [AboutController::class, 'index'])->name('home.about');
Route::get('about/add', [AboutController::class, 'create']);
Route::post('about/add', [AboutController::class, 'store'])->name('store.about');
Route::get('about/edit/{id}', [AboutController::class, 'edit']);
Route::post('about/update/{id}', [AboutController::class, 'update']);
Route::get('about/delete/{id}', [AboutController::class, 'destroy']);

//CONTACT - ADMIN BACKEND
Route::get('admin/contact', [ContactController::class, 'index'])->name('admin.contact');
Route::get('contact-add', [ContactController::class, 'create']);
Route::post('contact-add', [ContactController::class, 'store'])->name('store.contact');
Route::get('contact/edit/{id}', [ContactController::class, 'edit']);
Route::post('contact/update/{id}', [ContactController::class, 'update']);
Route::get('contact/delete/{id}', [ContactController::class, 'destroy']);

// FRONTEND --HOME Page Route
Route::get('portfolio', [PortfolioController::class, 'index'])->name('portfolio');


Route::get('contact', [ContactController::class, 'Contact'])->name('contact');

//CONTACT US FORM

Route::post('contact-us', [ContactformController::class, 'store'])->name('contact-form');

//MESSAGE - ADMIN BACKEND
Route::get('admin/message', [ContactformController::class, 'index'])->name('admin.message');
Route::get('message/delete/{id}', [ContactformController::class, 'destroy']);


// CHANGE PASSWORD
Route::get('change/password', [ChangePassword::class, 'create'])->name('change.password');
Route::post('password/update', [ChangePassword::class, 'update'])->name('password.update');
