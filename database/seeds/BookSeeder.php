<?php

use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'title' => 'A Promised Land',
            'publisher' => 'Barrack Obama',
            'gambar' => 'A Promised Land.jpg',
            'price' => 100000,
            'stok' => 10,
            'idKategori' => 1
        ]);
        DB::table('books')->insert([
            'title' => 'Becoming',
            'publisher' => 'Michelle Obama',
            'gambar' => 'Becoming.jpg',
            'price' => 120000,
            'stok' => 15,
            'idKategori' => 1
        ]);
        DB::table('books')->insert([
            'title' => 'Naruto',
            'publisher' => 'Masashi Kishimoto',
            'gambar' => 'Naruto.jpg',
            'price' => 180000,
            'stok' => 78,
            'idKategori' => 2
        ]);
        DB::table('books')->insert([
            'title' => 'Boruto',
            'publisher' => 'Masashi Kishimoto',
            'gambar' => 'Boruto.jpg',
            'price' => 230000,
            'stok' => 99,
            'idKategori' => 2
        ]);
        DB::table('books')->insert([
            'title' => 'The Wizard of Oz',
            'publisher' => 'L. Frank Baum',
            'gambar' => 'The Wizard of Oz.jpg',
            'price' => 570000,
            'stok' => 5,
            'idKategori' => 3
        ]);
    }
}
