<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(2)->create()->each(function (Category $category) {
            $sub_cat = Category::factory()->make();
            $category->appendNode($sub_cat);
            Product::factory(3)->make()->each(function(Product $product) use ($category) {
                $category->products()->save($product);
            });
            Product::factory(3)->make()->each(function(Product $product) use ($sub_cat) {
                $sub_cat->products()->save($product);
            });
        });
    }
}
