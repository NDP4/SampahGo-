<?php

namespace Database\Factories;

use App\Models\Rw;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rw>
 */
class RwFactory extends Factory
{
    protected $model = Rw::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => 'RW ' . fake()->numberBetween(1, 20),
        ];
    }
}
