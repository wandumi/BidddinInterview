<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usercount = max((int) $this->command->ask('How many users do you like? ', 10), 1);
        // factory(App\User::class)->state('John Doe')->create();
        factory(App\User::class, $usercount)->create();
    }
}
