<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if($this->command->confirm("Do you want to run Database Seeder")){
            $this->command->call('migrate:refresh');
            $this->command->info('Database Refreshed');
        }

        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(BidsTableSeeder::class);
    }
}
