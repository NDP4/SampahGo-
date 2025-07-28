<?php

namespace Database\Factories;

use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rt>
 */
class RtFactory extends Factory
{
    protected $model = Rt::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => 'RT ' . fake()->numberBetween(1, 20),
            'rw_id' => Rw::factory(),
        ];
    }
}
