<?php

namespace Database\Factories;

use App\Models\HelpdeskRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HelpdeskRecord>
 */
class HelpdeskRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ticket_number' => 'HST-'.fake()->unique()->numerify('######').'-'.fake()->unique()->bothify('?????'),
            'title' => fake()->sentence(5),
            'customer_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'category' => fake()->randomElement(['Akun & akses', 'Perangkat', 'Jaringan', 'Aplikasi', 'Umum']),
            'status' => fake()->randomElement(['baru', 'diproses', 'selesai']),
            'description' => fake()->paragraph(),
        ];
    }
}
