<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoFacturasSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['id' => 1, 'tipo' => 'Factura Programador'],
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipo_facturas')->updateOrInsert(['id' => $tipo['id']], $tipo);
        }
    }
}
