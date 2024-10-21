<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionController extends Controller
{
    /**
     * Get the competition leaderboard sorted by duration
     *
     * @return JsonResponse
     */
    public function leaderboard()
    {
        $athletes = Athlete::where('finish_time', '!=', null)
            ->orderBy('duration', 'asc')
            ->get();

        $results = [];
        foreach ($athletes as $index => $athlete) {
            $results[] = [
                'athlete'   => $athlete->id,
                'position'  => $index + 1,
                'duration'  => $athlete->duration,
            ];
        }

        return response()->json(['results' => $results]);
    }

    /**
     * Mark athlete as started swimming
     *
     * @param string $id Athlete UUID
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function start($id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->start_time = now();
        $athlete->save();

        return response()->json(['message' => 'Athlete started swimming']);
    }

    /**
     * Mark athlete as finished swimming and calculate duration
     *
     * @param string $id Athlete UUID
     * @return JsonResponse
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function finish($id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->finish_time = now();
        $athlete->duration = $athlete->finish_time->diffInSeconds($athlete->start_time);
        $athlete->save();

        return response()->json(['message' => 'Athlete finished swimming']);
    }
}