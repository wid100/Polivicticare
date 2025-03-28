<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
        ]);

        DB::table('roles')->insert([
            'name' => 'Victim',
            'slug' => 'victim',
        ]);
        DB::table('roles')->insert([
            'name' => 'Donor',
            'slug' => 'donor',
        ]);

        DB::table('roles')->insert([
            'name' => 'Block',
            'slug' => 'block',
        ]);
    }
}
