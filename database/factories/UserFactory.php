<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'kata_sandi' => static::$password ??= Hash::make('password'),
            'peran' => fake()->randomElement(['SuperAdmin', 'RW', 'RT', 'FO', 'Warga']),
            'rt_id' => null,
            'rw_id' => null,
            'aktif' => true,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create user with specific role.
     */
    public function withRole(string $role): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => $role,
        ]);
    }

    /**
     * Create user with RT and RW.
     */
    public function withRtRw(?int $rtId = null, ?int $rwId = null): static
    {
        return $this->state(fn (array $attributes) => [
            'rt_id' => $rtId,
            'rw_id' => $rwId,
        ]);
    }

    /**
     * Create inactive user.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'aktif' => false,
        ]);
    }
}
