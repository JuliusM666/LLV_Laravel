<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocationImage>
 */
class LocationImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageArray=scandir('public\uploads');
        array_shift($imageArray);
        array_shift($imageArray);
        $Locations=Location::all();
        return [
            'image'=>Arr::random($imageArray,1)[0],
            'location_id'=>$Locations->random()->id,
        ];
    }
    
}
