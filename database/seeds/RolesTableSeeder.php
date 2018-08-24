<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('roles')->insert([
            'nombre' => 'Gerente'
        ]);
        DB::table('roles')->insert([
            'nombre' => 'Recepcionista'
        ]);
        DB::table('roles')->insert([
            'nombre' => 'Cliente'
        ]);
    }

}
