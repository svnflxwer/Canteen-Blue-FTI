<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sub_category_id' => mt_rand(1,3),
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(mt_rand(10,20)),
            'slug' => $this->faker->unique()->slug(),
            'price' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'stock' => mt_rand(20,50),
            'photo' => "product/default.jpg",
            'is_active' => 1,
        ];
    }
}