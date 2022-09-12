<?php

namespace Database\Factories;

use App\Models\EloquentCustomer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EloquentCustomer>
 */
class EloquentCustomerFactory extends Factory
{
    protected $model = EloquentCustomer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
