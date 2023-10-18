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
            CREATE OR REPLACE VIEW view_vnormalisasi AS
            SELECT
                view_vmatrixkeputusan.result_id,
                view_vmatrixkeputusan.alternatif_id,
                view_vmatrixkeputusan.alternatif_name,
                view_vmatrixkeputusan.kriteria_id,
                view_vmatrixkeputusan.kriteria_name,
                view_vmatrixkeputusan.bobot_id,
                view_vmatrixkeputusan.bobot_value,
                view_vmatrixkeputusan.value,
                (view_vmatrixkeputusan.value / view_vmax.maksimum) AS normalisasi
            FROM view_vmatrixkeputusan
            JOIN view_vmax ON view_vmax.kriteria_id = view_vmatrixkeputusan.kriteria_id
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_vnormalisasi');
    }
};
