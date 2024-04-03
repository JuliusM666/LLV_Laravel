<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\Tag;


class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
        Location::factory()
        ->count(15)
        
        ->create();
        

        $Tags = Tag::all();
       
        Location::all()->each(function ($location)  use ($Tags) { 
            $location->Tags()->attach(
                $Tags->random(rand(5, 30))->pluck('id')->toArray()
            ); 
        });

       
}
}
