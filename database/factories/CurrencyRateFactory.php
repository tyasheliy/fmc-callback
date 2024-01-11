<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurrencyRate>
 */
class CurrencyRateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nominal' => fake()->numberBetween(1, 1000),
            'value' => fake()->numberBetween(1, 1000),
            'update_id' => fake()->uuid(),
            'currency_id' => Str::random(6)
        ];
    }
}
