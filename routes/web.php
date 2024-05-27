<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

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
    return view('index');
});

Route::get('/verifyredirect', function () {
    return view('verifyredirect');
});
Route::get('/verify', function () {
    return view('verifyredirect');
})->middleware('check.referer');

Route::get('/addpost', function () {
    return view('addpost');
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::get('/404', function () {
    return view('404');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/article', function () {
    return view('article');
});

Route::get('/loginnn', function () {
    return view('addpost');
})->name('loginnn');

Route::get('/register', function () {
    return view('register');
});
Route::get('/post/{id}', function ($id) {
    // Here you can use the $id parameter to fetch the corresponding post
    return view('post', ['postId' => $id]);
});

Route::get('/userprofile/{id}', function ($id) {
    return view('userprofile', ['userId' => $id]);
});

Route::get('/articleRead/{id}', function ($id) {
    // Here you can use the $id parameter to fetch the corresponding post
    return view('articleRead', ['articleReadId' => $id]);
});

Route::get('/verifyEmail/{token}', [RegisterController::class, 'storeData']);


/*

Route::get('/{any}', function () {
    return view('404');
})->where('any', '.*');
*/

Route::post('/set-session', function (Request $request) {
    session(['verified' => true]);
    return response()->json(['message' => 'Session set']);
});
//remove session
Route::post('/remove-session', function (Request $request) {
    session()->forget('verified');
    return response()->json(['message' => 'Session removed']);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/ifLogin', [UserController::class, 'getUserProfile']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('send-email', [PHPMailerController::class, 'index'])->name('send.email');
Route::post('send-email', [PHPMailerController::class, 'store'])->name('send.email.post');
