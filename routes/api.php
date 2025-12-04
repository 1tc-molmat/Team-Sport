<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TeamController;

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

// Health check endpoint
Route::get('/ping', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is running!',
        'timestamp' => now()->toDateTimeString(),
        'timezone' => config('app.timezone'),
    ]);
});

// Public routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (authentication required with Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Team CRUD routes
    Route::apiResource('teams', TeamController::class);
    
    // Additional route for PATCH (partial update)
    Route::patch('/teams/{team}/partial', [TeamController::class, 'partialUpdate']);
});
