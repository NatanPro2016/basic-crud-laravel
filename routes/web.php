<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;

Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
 
        $posts = auth()->user()->userPinedPosts()->latest()->get();
    }
    return view('home', ['posts' => $posts]);
});
Route::post("register", [AuthController::class, 'register']);
Route::post("login", [AuthController::class, 'login']);
Route::post("logout", [AuthController::class, 'logout']);

//post related

Route::post("create-post", [PostController::class, 'createPost']);
Route::get("edit-post/{post}", [PostController::class, 'showEditSchema']);
Route::put("edit-post/{post}", [PostController::class, 'updatePost']);
Route::delete("delete-post/{post}", [PostController::class, 'deletePost']);



