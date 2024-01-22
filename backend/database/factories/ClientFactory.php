<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string=>$this->faker, mixed>
     */


    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastname(),
            'dni' => $this->faker->randomNumber(8),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'status' => $this->faker->randomElement([1, 0])
        ];
    }
}
