<?php

use Illuminate\Database\Seeder;
use App\Bid;
use App\Product;

class BidsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();

        if($products->count() === 0)
        {
            $this->command->info('No Bids created, No Products');
            return;
        }

        $bidCount = (int) $this->command->ask('How many Bids do you like? ', 20);

        $Bids = factory(Bid::class, $bidCount)->make()->each(function($bid) use($products) {

            $bid->product_id = $products->random()->id;
            $bid->save();

        });
    }
}
