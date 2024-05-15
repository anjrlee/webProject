<?php

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
    return view('index');
});

Route::get('/addPost', function () {
    return view('addPost');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/404', function () {
    return view('404');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/article', function () {
    return view('article');
});

Route::get('/post/{id}', function ($id) {
    // Here you can use the $id parameter to fetch the corresponding post
    return view('post', ['postId' => $id]);
});

Route::get('/articleRead/{id}', function ($id) {
    // Here you can use the $id parameter to fetch the corresponding post
    return view('articleRead', ['articleReadId' => $id]);
});

Route::get('/{any}', function () {
    return view('404');
})->where('any', '.*');
