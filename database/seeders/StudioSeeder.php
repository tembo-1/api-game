<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Studio::factory(10)->create();
    }
}
