<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $Locations=Location::all();
        $Users=User::all();
        return [
           'comment'=>fake()->text(100),
           'user_id'=>$Users->random()->id,
           'location_id'=>$Locations->random()->id,
        ];
    }
}
