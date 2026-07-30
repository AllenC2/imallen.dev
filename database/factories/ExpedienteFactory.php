<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expediente>
 */
class ExpedienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(4),
            'descripcion' => fake()->paragraph(),
            'cover_image' => null,
            'contenido' => fake()->paragraphs(3, true),
        ];
    }

    public function withClientes(?int $count = 1): static
    {
        return $this->afterCreating(function (\App\Models\Expediente $expediente) use ($count) {
            $clientes = User::factory()->count($count)->cliente()->create();
            $expediente->clientes()->attach($clientes->pluck('id'));
        });
    }
}
