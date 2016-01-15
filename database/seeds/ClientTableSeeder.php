<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    	\CodeProject\Client::truncate();
        factory(\CodeProject\Client::class, 50)->create();
    }
}
