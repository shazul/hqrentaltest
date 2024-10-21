<?php

namespace Database\Seeders;

use App\Models\Athlete;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class AthleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 sample athletes
        for ($i = 0; $i < 5; $i++) {
            Athlete::create([
                'id' => Str::uuid(),
            ]);
        }
    }
}
