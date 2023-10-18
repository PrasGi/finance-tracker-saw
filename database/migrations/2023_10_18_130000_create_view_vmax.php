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
    CREATE OR REPLACE VIEW view_vmax AS
    SELECT kriteria_id, kriteria_name, MAX(value) AS maksimum
    FROM view_vmatrixkeputusan
    GROUP BY kriteria_id, kriteria_name
    ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_vmax');
    }
};
