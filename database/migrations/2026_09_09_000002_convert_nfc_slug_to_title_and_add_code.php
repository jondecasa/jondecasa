<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ConvertNfcSlugToTitleAndAddCode extends Migration
{
    public function up()
    {
        // Compatibilidad con instalaciones que ejecutaron la primera versión
        // de esta migración antes de que el slug se convirtiera en título.
        if (Schema::hasColumn('nfc_rutas', 'slug') && !Schema::hasColumn('nfc_rutas', 'titulo')) {
            $indiceSlug = DB::selectOne(
                'SHOW INDEX FROM `nfc_rutas` WHERE Key_name = ?',
                ['nfc_rutas_slug_unique']
            );

            if ($indiceSlug) {
                DB::statement('ALTER TABLE `nfc_rutas` DROP INDEX `nfc_rutas_slug_unique`');
            }

            // Evita renameColumn(), que en Laravel 8 requiere doctrine/dbal.
            DB::statement('ALTER TABLE `nfc_rutas` CHANGE `slug` `titulo` VARCHAR(150) NOT NULL');
        }

        if (!Schema::hasColumn('nfc_rutas', 'codigo')) {
            Schema::table('nfc_rutas', function (Blueprint $table) {
                $table->string('codigo', 20)->nullable()->unique();
            });

            DB::table('nfc_rutas')->orderBy('id')->each(function ($ruta) {
                do {
                    $codigo = Str::upper(Str::random(20));
                } while (DB::table('nfc_rutas')->where('codigo', $codigo)->exists());

                DB::table('nfc_rutas')->where('id', $ruta->id)->update(['codigo' => $codigo]);
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('nfc_rutas', 'codigo')) {
            Schema::table('nfc_rutas', function (Blueprint $table) {
                $table->dropUnique(['codigo']);
                $table->dropColumn('codigo');
            });
        }
    }
}
