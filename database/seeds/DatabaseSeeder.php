<?php

use CodeProject\Entities\ProjectNote;
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
        // \CodeProject\Entities\ProjectNote::truncate();
        // \CodeProject\Entities\Project::truncate();
        // \CodeProject\Entities\Client::truncate();
        // \CodeProject\Entities\User::truncate();

        $this->call(UserTableSeeder::class);
    	$this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);
    }
}
