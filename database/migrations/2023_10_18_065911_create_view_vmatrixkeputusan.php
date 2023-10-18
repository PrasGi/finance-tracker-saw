<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW view_vmatrixkeputusan AS
        SELECT
            results.id AS result_id,
            alternatifs.id AS alternatif_id,
            alternatifs.name AS alternatif_name,
            kriterias.id AS kriteria_id,
            kriterias.name AS kriteria_name,
            bobots.id AS bobot_id,
            bobots.value AS bobot_value,
            results.value
        FROM results
        JOIN alternatifs ON results.alternatif_id = alternatifs.id
        JOIN bobots ON results.bobot_id = bobots.id
        JOIN kriterias ON kriterias.id = bobots.kriteria_id
    ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_vmatrixkeputusan');
    }
};
