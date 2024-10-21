<?php

namespace App\Console\Commands;

use App\Models\Athlete;
use Illuminate\Console\Command;

class ManageAthlete extends Command
{
    protected $signature = 'athlete:manage {athlete} {action}';
    protected $description = 'Manually mark an athlete as started or finished swimming';

    /**
     * Execute the console command
     *
     * @return int Exit code
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function handle()
    {
        try {
            $athleteId = $this->argument('athlete');
            $action = $this->argument('action');

            $athlete = Athlete::findOrFail($athleteId);

            if ($action === 'start') {
                $athlete->start_time = now();
                $athlete->save();
                $this->info("Athlete {$athleteId} started swimming");
            } elseif ($action === 'finish') {
                if (!$athlete->start_time) {
                    $this->error('Athlete must start before finishing');
                    return 1;
                }
                $athlete->finish_time = now();
                $athlete->duration = $athlete->start_time->diffInSeconds($athlete->finish_time);
                $athlete->save();
                $this->info("Athlete {$athleteId} finished swimming");
            } else {
                $this->error('Invalid action. Use "start" or "finish".');
                return 1;
            }

            return 0;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->error('Athlete not found');
            $this->info('Available athletes:');

            $athletes = Athlete::all(['id']);
            foreach ($athletes as $athlete) {
                $this->line($athlete->id);
            }
            return 1;
        }
    }
}
