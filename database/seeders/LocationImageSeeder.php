<?php

namespace Database\Seeders;

use App\Models\LocationImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LocationImage::factory()
        ->count(50)
        
        ->create();
    }
}
