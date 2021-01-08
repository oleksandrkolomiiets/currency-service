<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->currencyCode,
            'name' => $this->faker->name,
            'rate' => $this->faker->randomFloat(4, 1, 150),
            'nominal' => $this->faker->randomElement([1, 10, 100, 1000]),
            'date' => $this->faker->date(),
        ];
    }
}
