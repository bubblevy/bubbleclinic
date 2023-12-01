<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now();

        $createdAt = fake()->dateTimeBetween($start, $end);
        return [
            'name' => fake()->name,
            'address' => fake()->address,
            'old' => fake()->numberBetween(15, 50),
            'gender' => fake()->randomElement(['Laki-Laki', 'Perempuan']),
            'status_pemeriksaan' => "Sudah Diperiksa",
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
