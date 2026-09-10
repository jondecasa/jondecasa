<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaPagosSeeder extends Seeder
{
    public function run(): void
    {
        $formas = [
            ['id' => 1, 'pago' => 'Transferencia Bancaria'],
            ['id' => 2, 'pago' => 'Bizum'],
            ['id' => 3, 'pago' => 'Efectivo'],
        ];

        foreach ($formas as $forma) {
            DB::table('forma_pagos')->updateOrInsert(['id' => $forma['id']], $forma);
        }
    }
}
