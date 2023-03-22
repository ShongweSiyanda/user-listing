<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserListing>
 */
class UserListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
        $email = strtolower($first_name). ".".strtolower($last_name)."@testmail.com";
        $position = $this->faker->jobTitle;
        return [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "position" => $position,
        ];
    }
}
