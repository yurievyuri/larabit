<?php

namespace Database\Factories;

use Dev\Larabit\Models\Connection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Connection>
 */
class ConnectionFactory extends Factory
{
    protected $model = Connection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Connection::user_id => rand(1,9000),
            Connection::domain => fake()->domainName(),
            Connection::path => fake()->url(),
            Connection::external_user_id => rand(1,9000),
            Connection::token => fake()->password(32),
            Connection::type => fake()->randomElement(Connection::typeList)
        ];
    }
}
