<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => 'T' . fake()->numerify('#####'),
            'char_code' => Str::upper(Str::random(3)),
            'num_code' => fake()->numerify('###'),
            'name' => fake()->title()
        ];
    }
}
