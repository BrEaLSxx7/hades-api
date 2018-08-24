<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('authorizations')->insert([
            'usuario' => 'Gerente',
            'contrasena' => Hash::make('gerente'),
            'id_rol' => 1
        ]);
        DB::table('authorizations')->insert([
            'usuario' => 'Recepcionista',
            'contrasena' => Hash::make('recepcionista'),
            'id_rol' => 2
        ]);
    }

}
