<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route to register a new user
Route::post('/register', [RegisterController::class, 'store']);
Route::put('/update-account/{id}', [RegisterController::class, 'update']);

// Route to login a user
Route::post('/login', [LoginController::class, 'check']);

// Route to reset a user
Route::put('/reset-password', [RegisterController::class, 'resetPassword']);

// Route to reset a user
Route::get('/get-account/{id}', [UserController::class, 'getUser']);

Route::put('/update-password/{id}', [RegisterController::class, 'updatePassword']);


// Routes for the posts
Route::get('/posts', [PostController::class, 'index']); // Route to get all posts
Route::post('/posts', [PostController::class, 'store']); // Route to create a new post
Route::get('/posts/{id}', [PostController::class, 'show']); // Route to get a specific post by its id
Route::put('/posts/{id}', [PostController::class, 'update']); // Route to update a post
Route::delete('/posts/{id}', [PostController::class, 'destroy']); // Route to delete a post

