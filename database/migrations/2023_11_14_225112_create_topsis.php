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
            CREATE OR REPLACE VIEW topsis_pembagi AS
            select `view_vmatrixkeputusan`.`kriteria_id` AS `kriteria_id`,`view_vmatrixkeputusan`.`kriteria_name` AS `kriteria_name`,sqrt(sum(pow(`view_vmatrixkeputusan`.`value`,2))) AS `bagi` from `view_vmatrixkeputusan` group by `view_vmatrixkeputusan`.`kriteria_id`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW topsis_normalisasi AS
            select `view_vmatrixkeputusan`.`result_id` AS `result_id`,`view_vmatrixkeputusan`.`alternatif_id` AS `alternatif_id`,`view_vmatrixkeputusan`.`alternatif_name` AS `alternatif_name`,`view_vmatrixkeputusan`.`kriteria_id` AS `kriteria_id`,`view_vmatrixkeputusan`.`kriteria_name` AS `kriteria_name`,`view_vmatrixkeputusan`.`bobot_id` AS `bobot_id`,`view_vmatrixkeputusan`.`bobot_value` AS `bobot_value`,`view_vmatrixkeputusan`.`value` AS `value`,(`view_vmatrixkeputusan`.`value` / `topsis_pembagi`.`bagi`) AS `normalisasi` from (`view_vmatrixkeputusan` join `topsis_pembagi`) where (`topsis_pembagi`.`kriteria_id` = `view_vmatrixkeputusan`.`kriteria_id`) group by `view_vmatrixkeputusan`.`result_id`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW topsis_terbobot AS
            select `topsis_normalisasi`.`result_id` AS `result_id`,`topsis_normalisasi`.`alternatif_id` AS `alternatif_id`,`topsis_normalisasi`.`alternatif_name` AS `alternatif_name`,`topsis_normalisasi`.`kriteria_id` AS `kriteria_id`,`topsis_normalisasi`.`kriteria_name` AS `kriteria_name`,`topsis_normalisasi`.`bobot_id` AS `bobot_id`,`topsis_normalisasi`.`bobot_value` AS `bobot_value`,`topsis_normalisasi`.`value` AS `value`,`topsis_normalisasi`.`normalisasi` AS `normalisasi`,(`bobots`.`value` * `topsis_normalisasi`.`normalisasi`) AS `terbobot` from (`topsis_normalisasi` join `bobots`) where (`bobots`.`kriteria_id` = `topsis_normalisasi`.`kriteria_id`)
        ");
        DB::statement("
            CREATE OR REPLACE VIEW topsis_maxmin AS
            select `topsis_terbobot`.`kriteria_id` AS `kriteria_id`,`topsis_terbobot`.`kriteria_name` AS `kriteria_name`,max(`topsis_terbobot`.`terbobot`) AS `maximum`,min(`topsis_terbobot`.`terbobot`) AS `minimum` from `topsis_terbobot` group by `topsis_terbobot`.`kriteria_id`,`topsis_terbobot`.`kriteria_name`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW topsis_sipsin AS
            select `topsis_terbobot`.`alternatif_id` AS `alternatif_id`,sqrt(sum(pow((`topsis_maxmin`.`maximum` - `topsis_terbobot`.`terbobot`),2))) AS `dplus`,sqrt(sum(pow((`topsis_maxmin`.`minimum` - `topsis_terbobot`.`terbobot`),2))) AS `dmin` from (`topsis_terbobot` join `topsis_maxmin`) where (`topsis_terbobot`.`kriteria_id` = `topsis_maxmin`.`kriteria_id`) group by `topsis_terbobot`.`alternatif_id`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW topsis_nilaiv AS
            select `topsis_sipsin`.`alternatif_id` AS `alternatif_id`,`topsis_sipsin`.`dplus` AS `dplus`,`topsis_sipsin`.`dmin` AS `dmin`,(`topsis_sipsin`.`dmin` / (`topsis_sipsin`.`dplus` * `topsis_sipsin`.`dmin`)) AS `nilaiv` from `topsis_sipsin` group by `topsis_sipsin`.`alternatif_id`
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS topsis_pembagi');
        DB::statement('DROP VIEW IF EXISTS topsis_normalisasi');
        DB::statement('DROP VIEW IF EXISTS topsis_terbobot');
        DB::statement('DROP VIEW IF EXISTS topsis_maxmin');
        DB::statement('DROP VIEW IF EXISTS topsis_sipsin');
        DB::statement('DROP VIEW IF EXISTS topsis_nilaiv');
    }
};
