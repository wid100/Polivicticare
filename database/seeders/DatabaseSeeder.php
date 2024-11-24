<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Sandofvega\Bdgeocode\Seeds\BdgeocodeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(BdgeocodeSeeder::class); //php artisan db:seed --class=Sandofvega\Bdgeocode\Seeds\BdgeocodeSeeder

    }
}
