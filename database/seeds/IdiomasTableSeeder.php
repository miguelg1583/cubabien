<?php

use Illuminate\Database\Seeder;

class IdiomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idiomas')->insert([
            'sigla' => 'es',
            'nombre' => 'Español'
        ]);
        DB::table('idiomas')->insert([
            'sigla' => 'en',
            'nombre' => 'Inglés'
        ]);
    }
}
