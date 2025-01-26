<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Super Admin',
            'uid' => '897234',
            'phone' => '01792892198',
            'email' => 'dev@admin.com',
            'password' => bcrypt('11111111'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'victim',
            'uid' => '635788',
            'phone' => '01792892198',
            'email' => 'dev@victim.com',
            'password' => bcrypt('11111111'),
        ]);
        DB::table('users')->insert([
            'role_id' => '3',
            'name' => 'Doner',
            'uid' => '067575',
            'phone' => '01792892198',
            'email' => 'dev@doner.com',
            'password' => bcrypt('11111111'),
        ]);
        DB::table('users')->insert([
            'role_id' => '4',
            'name' => 'Block User',
            'uid' => '423789',
            'phone' => '01792892198',
            'email' => 'dev@block.com',
            'password' => bcrypt('11111111'),
        ]);
    }
}
