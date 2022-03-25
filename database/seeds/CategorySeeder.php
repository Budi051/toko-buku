<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Biografi'
        ]);
        DB::table('categories')->insert([
            'name' => 'Komik'
        ]);
        DB::table('categories')->insert([
            'name' => 'Novel'
        ]);
        DB::table('categories')->insert([
            'name' => 'Ensiklopedia'
        ]);
        DB::table('categories')->insert([
            'name' => 'Ilmiah'
        ]);
    }
}
