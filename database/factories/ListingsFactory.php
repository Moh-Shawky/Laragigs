<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class listingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'email'=>fake()->email(),
            'description'=>fake()->paragraph(4),
            'title'=>fake()->sentence(),
            'tags'=>'web , api , backend',
            'company'=>fake()->word(),
            'location'=>fake()->city(),
            'website'=>fake()->url(),
            'logo'=>"H"
        ];
    }
}
