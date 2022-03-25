<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => '12345678',
            'role' => 'karyawan'
        ]);
        DB::table('users')->insert([
            'name' => 'Member',
            'email' => 'member@gmail.com',
            'password' => '12345678',
            'role' => 'member'
        ]);
    }
}
