<?php

use App\Services\BaseSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(PagesTableSeeder::class);
        // $this->call(BitcointProductsTableSeeder::class);
        dd(1);
        $this->call(BlocksTableSeeder::class);
        $this->call(DefaultDatabaseSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BaseSeeder::class);
    }
}
