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
            CREATE OR REPLACE VIEW wp_jumbobot AS
            select sum(`bobots`.`value`) AS `jumlah` from `bobots`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW wp_normalisasiterbobot AS
            select `bobots`.`id` AS `id`,`bobots`.`kriteria_id` AS `kriteria_id`,`bobots`.`value` AS `value`,`wp_jumbobot`.`jumlah` AS `jumlah`,(`bobots`.`value` / `wp_jumbobot`.`jumlah`) AS `normalisasi_w` from (`bobots` join `wp_jumbobot`)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW wp_pangkat AS
            select `view_vmatrixkeputusan`.`result_id` AS `result_id`,`view_vmatrixkeputusan`.`alternatif_id` AS `alternatif_id`,`view_vmatrixkeputusan`.`alternatif_name` AS `alternatif_name`,`view_vmatrixkeputusan`.`kriteria_id` AS `kriteria_id`,`view_vmatrixkeputusan`.`kriteria_name` AS `kriteria_name`,`view_vmatrixkeputusan`.`bobot_id` AS `bobot_id`,`view_vmatrixkeputusan`.`bobot_value` AS `bobot_value`,`view_vmatrixkeputusan`.`value` AS `value`,`wp_normalisasiterbobot`.`normalisasi_w` AS `normalisasi_w`,pow(`view_vmatrixkeputusan`.`value`,`wp_normalisasiterbobot`.`normalisasi_w`) AS `pangkat` from (`view_vmatrixkeputusan` join `wp_normalisasiterbobot`) where (`wp_normalisasiterbobot`.`kriteria_id` = `view_vmatrixkeputusan`.`kriteria_id`)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW wp_nilais AS
            select `wp_pangkat`.`alternatif_id` AS `alternatif_id`,`wp_pangkat`.`alternatif_name` AS `alternatif_name`,exp(sum(log(`wp_pangkat`.`pangkat`))) AS `nilaiS` from `wp_pangkat` group by `wp_pangkat`.`alternatif_id`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW wp_sums AS
            select sum(`wp_nilais`.`nilaiS`) AS `jum` from `wp_nilais`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW wp_nilaiv AS
            select `wp_nilais`.`alternatif_id` AS `alternatif_id`,`wp_nilais`.`alternatif_name` AS `alternatif_name`,(`wp_nilais`.`nilaiS` / `wp_sums`.`jum`) AS `nilaiv` from (`wp_nilais` join `wp_sums`)
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS wp_jumbobot');
        DB::statement('DROP VIEW IF EXISTS wp_normalisasiterbobot');
        DB::statement('DROP VIEW IF EXISTS wp_pangkat');
        DB::statement('DROP VIEW IF EXISTS wp_nilais');
        DB::statement('DROP VIEW IF EXISTS wp_sums');
        DB::statement('DROP VIEW IF EXISTS wp_nilaiv');
    }
};
