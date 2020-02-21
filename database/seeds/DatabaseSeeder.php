<?php

use App\Models\TestTag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,10) as $i){
            $this->call(TestSeeder::class);
        }

    }
}
