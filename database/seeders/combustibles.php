<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class combustibles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('combustibles')->insert([
            'tipo'=>'MAGNA',
            'clave'=>'32025 Gasolina con contenido minimo 87 octanos'
        ]);
        DB::table('combustibles')->insert([
            'tipo'=>'PREMIUM',
            'clave'=>'32026 Gasolina con contenido minimo 91 octanos'
        ]);
        DB::table('combustibles')->insert([
            'tipo'=>'DIESEL',
            'clave'=>'34015 Diesel Automotriz'
        ]);
    }
}
