<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = ['paypal', 'cash'];
        for($i = 0; $i < 10; $i++){
            [$products, $total, $quantity] = $this->get_random_products(rand(1, 10));
            $payload = [
                'user_id' => User::all()->random()->id,
                'payment' => $payments[array_rand($payments)],
                'total_products' => count($products),
                'total' => $total,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ];
            $order_id = DB::table('orders')->insert($payload);
            foreach($quantity as $id => $quant){
                $payload = [
                    'order_id' => $order_id,
                    'product_id' => $id,
                    'quantity' => $quant,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ];
                DB::table('order_products')->insert($payload);
            }
        }
    }

    private function get_random_products($num){
        $products = array();
        $total = 0;
        $quantity = array();
        for($i = 0; $i < $num; $i++){
            $product = Product::all()->random();
            $products[] = $product;
            $total += $product->price;
            $quantity[$product->id] = isset($quantity[$product->id]) ? $quantity[$product->id] + 1 : 1;
        }
        return [$products, $total, $quantity];
    }
}
