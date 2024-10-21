<?php

use App\Http\Controllers\CompetitionController;
use Illuminate\Support\Facades\Route;

Route::get('/competitions/leaderboard', [CompetitionController::class, 'leaderboard']);
Route::post('/competitions/athlete/{id}/start', [CompetitionController::class, 'start']);
Route::put('/competitions/athlete/{id}/finish', [CompetitionController::class, 'finish']);
