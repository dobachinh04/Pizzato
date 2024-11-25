<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,  // Lấy ngẫu nhiên user_id
            'delivery_area_id' => DeliveryArea::inRandomOrder()->first()->id,  // Lấy ngẫu nhiên delivery_area_id
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];
    }
}
