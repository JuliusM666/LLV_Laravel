<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use App\Models\User;
use Closure;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   
    public function definition(): array
    {
        
       
        $admins = User::inRandomOrder()->where('isAdmin', '=', true)->first();
        
        return [
        'name'=> fake()->word(),
        'description'=>fake()->text(1000),
         'user_id'=>$admins['id'],
        
        ];
    }
    
}
