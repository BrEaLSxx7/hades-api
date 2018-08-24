<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('categories')->insert([
            'nombre' => 'Presidencial',
            'precio' => 150000
        ]);
        DB::table('categories')->insert([
            'nombre' => 'Master',
            'precio' => 80000
        ]);
        DB::table('categories')->insert([
            'nombre' => 'Junior',
            'precio' => 50000
        ]);
    }

}
