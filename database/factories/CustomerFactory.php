<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cus_name' => $this->faker->name(),
            'cus_email' => $this->faker->unique()->safeEmail(),
            'citizen_id'=>$this->faker->unique()->numerify(),
            'phone'=>$this->faker->unique()->phoneNumber(),

        ];
    }
}
