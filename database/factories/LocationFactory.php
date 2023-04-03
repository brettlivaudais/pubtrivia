<?php

namespace Database\Factories;
use App\Models\Location;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'zip' => $this->faker->postcode(),
            'slug' => $this->faker->slug(),
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
            'dayoftheweek' => $this->faker->dayOfWeek(),
            'time' => $this->faker->time(),
            'logo_url' => $this->faker->imageUrl(),
            'published' => $this->faker->boolean(),
        ];
    }
}