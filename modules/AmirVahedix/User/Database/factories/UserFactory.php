<?php

namespace AmirVahedix\User\Database\factories;

use AmirVahedix\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => "09". mt_rand(100000000, 999999999),
            'password' => '$2y$10$XN7IbSJ1O6yOQ0hIwuIc4uqxwWXb7s0Jf52nwPmXK6JSvUr/TjLza', // !@#ABCabc123
            'remember_token' => Str::random(10),
            'email_verified_at' => now()
        ];
    }

    public function verified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => now(),
            ];
        });
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
