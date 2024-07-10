<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;

Route::post('/posts', [PostController::class, 'store']);
Route::post('/subscribe', [SubscriptionController::class, 'store']);
