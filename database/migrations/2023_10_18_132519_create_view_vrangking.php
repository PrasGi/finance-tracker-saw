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
            CREATE OR REPLACE VIEW view_vrangking AS
            SELECT
                alternatif_id,
                alternatif_name,
                SUM(prarangking) AS rangking
            FROM view_vprarangking
            GROUP BY alternatif_id, alternatif_name
        ");
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_vrangking');
    }
};
