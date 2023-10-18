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
            CREATE OR REPLACE VIEW view_vprarangking AS
            SELECT
                view_vnormalisasi.result_id,
                view_vnormalisasi.alternatif_id,
                view_vnormalisasi.alternatif_name,
                view_vnormalisasi.kriteria_id,
                view_vnormalisasi.kriteria_name,
                view_vnormalisasi.bobot_id,
                view_vnormalisasi.bobot_value,
                view_vnormalisasi.value,
                view_vnormalisasi.normalisasi,
                (view_vnormalisasi.bobot_value * view_vnormalisasi.normalisasi) AS prarangking
            FROM view_vnormalisasi
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_vprarangking');
    }
};
