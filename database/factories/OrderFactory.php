<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;
        $payments = ['paypal', 'cash'];
        return [
            'user_id' => User::all()->random()->user_id,
            'payment' => $payments[array_rand($payments)],
            'total_products' => $faker->randomNumber(2),
            'total' => $faker->randomFloat(2, 10, 9999),
        ];
    }
}
