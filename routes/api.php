<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user/profile', function (Request $request) {
    Log::info('User profile accessed');
    return response()->json($request->user());
});





Route::post('add-post', [postController::class, 'addPost']);
Route::get('/similar-titles', [PostController::class, 'getSimilarTitles']);
Route::get('/posts', [PostController::class, 'showall']);
Route::get('/verification', [PostController::class, 'verifyPosts']);
Route::post('/posts/{id}/approve', [PostController::class, 'approve']);
Route::post('/posts/{id}/reject', [PostController::class, 'reject']);
Route::put('/profile', [ProfileController::class, 'update']);
Route::get('/post', [postController::class, 'index']);
Route::get('/post/{id}', [postController::class, 'show']);
Route::get('/userprofile/{id}', [ProfileController::class, 'getUserProfile']);
Route::get('/articles', [ArticleController::class, 'showArticle']);
Route::get('/articles/{id}', [ArticleController::class, 'getArticle']);
