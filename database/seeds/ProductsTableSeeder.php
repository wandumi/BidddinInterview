<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        if($users->count() === 0)
        {
            $this->command->info('No Products created, No Users to create them');
            return;
        }

        $productCount = (int) $this->command->ask('How many Products do you like? ', 150);
        $Products = factory(Product::class, $productCount)->make()->each(function($product) use($users) {

            $product->user_id = $users->random()->id;
            $product->save();

        });
    }
}
