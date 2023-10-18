<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alternatif;
use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Result;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Alternatif::create([
            'name' => 'tidak tepat',
        ]);

        Alternatif::create([
            'name' => 'cukup tepat',
        ]);

        Alternatif::create([
            'name' => 'tepat',
        ]);

        Kriteria::create([
            'name' => 'Rasio Mendekati 5:3:2'
        ]);

        Kriteria::create([
            'name' => 'Prioritas Kebutuhan vs Keinginan'
        ]);

        Bobot::create([
            'kriteria_id' => 1,
            'value' => '0.75',
        ]);

        Bobot::create([
            'kriteria_id' => 2,
            'value' => '0.25',
        ]);

        Result::create([
            'alternatif_id' => 1,
            'bobot_id' => 1,
            'value' => '1',
        ]);
        Result::create([
            'alternatif_id' => 1,
            'bobot_id' => 2,
            'value' => '1',
        ]);
        Result::create([
            'alternatif_id' => 2,
            'bobot_id' => 1,
            'value' => '2',
        ]);
        Result::create([
            'alternatif_id' => 2,
            'bobot_id' => 2,
            'value' => '2',
        ]);
        Result::create([
            'alternatif_id' => 3,
            'bobot_id' => 1,
            'value' => '3',
        ]);
        Result::create([
            'alternatif_id' => 3,
            'bobot_id' => 2,
            'value' => '3',
        ]);
    }
}