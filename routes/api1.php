<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetitionController;

Route::get('/competitions/leaderboard', [CompetitionController::class, 'leaderboard']);
Route::post('/competitions/athlete/{id}/start', [CompetitionController::class, 'start']);
Route::put('/competitions/athlete/{id}/finish', [CompetitionController::class, 'finish']);