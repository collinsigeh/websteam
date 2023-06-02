<?php

use App\Http\Controllers\BannerController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/segments/{category:slug}', [WebController::class, 'view_segment'])->name('segments.view');

Route::get('/newhome', [WebController::class, 'newhome'])->name('newhome');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/click/{id}', [WebController::class, 'redirect'])->name('banners.redirect');
Route::post('/submit_contact_form', [WebController::class, 'submitContactForm'])->name('submit_contact_form');

Route::patch('/banners/{id}', [BannerController::class, 'quickupdate'])->name('banners.quickupdate');
Route::resource('/banners', BannerController::class);

Route::resource('/categories', CategoryController::class);

Route::post('/upload', [PostController::class, 'upload'])->name('ckeditor.upload');
Route::patch('/posts/{id}', [PostController::class, 'quickupdate'])->name('posts.quickupdate');
Route::resource('/posts', PostController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/{post:slug}',[WebController::class, 'view_post'])->name('posts.view');
Route::get('/', [WebController::class, 'welcome'])->name('welcome');