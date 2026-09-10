<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonedasSeeder extends Seeder
{
    public function run(): void
    {
        $monedas = [
            ['id' => 1, 'moneda' => 'Euro', 'ticker' => 'EUR'],
            ['id' => 2, 'moneda' => 'Dolar', 'ticker' => 'USD'],
            ['id' => 3, 'moneda' => 'Bitcoin', 'ticker' => 'BTC'],
            ['id' => 4, 'moneda' => 'Bitcoin Cash', 'ticker' => 'BCH'],
        ];

        foreach ($monedas as $moneda) {
            DB::table('monedas')->updateOrInsert(['id' => $moneda['id']], $moneda);
        }
    }
}
