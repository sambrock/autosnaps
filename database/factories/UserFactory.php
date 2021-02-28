<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;

        $name = $firstname . " " . $lastname;
        $email = strtolower($firstname) . strtolower($lastname) . "@" . $this->faker->freeEmailDomain;

        return [
            'name' => $name,
            'email' => $email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ];
    }
}
