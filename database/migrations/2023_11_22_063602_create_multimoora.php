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
            CREATE OR REPLACE VIEW multimoora_1 AS
            select `view_vmatrixkeputusan`.`result_id` AS `result_id`,`view_vmatrixkeputusan`.`alternatif_id` AS `alternatif_id`,`view_vmatrixkeputusan`.`alternatif_name` AS `alternatif_name`,`view_vmatrixkeputusan`.`kriteria_id` AS `kriteria_id`,`view_vmatrixkeputusan`.`kriteria_name` AS `kriteria_name`,`view_vmatrixkeputusan`.`bobot_id` AS `bobot_id`,`view_vmatrixkeputusan`.`bobot_value` AS `bobot_value`,`view_vmatrixkeputusan`.`value` AS `value`,sqrt(sum(pow(`view_vmatrixkeputusan`.`value`,2))) AS `pra` from `view_vmatrixkeputusan` group by `view_vmatrixkeputusan`.`kriteria_id`,`view_vmatrixkeputusan`.`result_id`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW multimoora_2 AS
            select `view_vmatrixkeputusan`.`result_id` AS `result_id`,`view_vmatrixkeputusan`.`alternatif_id` AS `alternatif_id`,`view_vmatrixkeputusan`.`alternatif_name` AS `alternatif_name`,`view_vmatrixkeputusan`.`kriteria_id` AS `kriteria_id`,`view_vmatrixkeputusan`.`kriteria_name` AS `kriteria_name`,`view_vmatrixkeputusan`.`bobot_id` AS `bobot_id`,`view_vmatrixkeputusan`.`bobot_value` AS `bobot_value`,`view_vmatrixkeputusan`.`value` AS `value`,`multimoora_1`.`pra` AS `pra`,(`view_vmatrixkeputusan`.`value` / `multimoora_1`.`pra`) AS `normalisasi` from (`view_vmatrixkeputusan` join `multimoora_1`) where (`multimoora_1`.`kriteria_id` = `view_vmatrixkeputusan`.`kriteria_id`) group by `view_vmatrixkeputusan`.`result_id`,`multimoora_1`.`pra`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW multimoora_3 AS
            select `multimoora_2`.`result_id` AS `result_id`,`multimoora_2`.`alternatif_id` AS `alternatif_id`,`multimoora_2`.`alternatif_name` AS `alternatif_name`,`multimoora_2`.`kriteria_id` AS `kriteria_id`,`multimoora_2`.`kriteria_name` AS `kriteria_name`,`multimoora_2`.`bobot_id` AS `bobot_id`,`multimoora_2`.`bobot_value` AS `bobot_value`,`multimoora_2`.`value` AS `value`,`multimoora_2`.`pra` AS `pra`,`multimoora_2`.`normalisasi` AS `normalisasi`,(`multimoora_2`.`normalisasi` * `multimoora_2`.`value`) AS `normalisasiterbobot` from `multimoora_2` group by `multimoora_2`.`result_id`,`multimoora_2`.`pra`
        ");
        DB::statement("
            CREATE OR REPLACE VIEW multimoora_4 AS
            select `multimoora_3`.`alternatif_id` AS `alternatif_id`,sum(`multimoora_3`.`normalisasiterbobot`) AS `hasil` from `multimoora_3` group by `multimoora_3`.`alternatif_id`
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS multimoora_1');
        DB::statement('DROP VIEW IF EXISTS multimoora_2');
        DB::statement('DROP VIEW IF EXISTS multimoora_3');
        DB::statement('DROP VIEW IF EXISTS multimoora_4');
    }
};
