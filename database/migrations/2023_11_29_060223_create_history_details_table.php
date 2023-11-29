<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('history_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('history_id');
            $table->foreignId('alternatif_id');
            $table->foreignId('kriteria_id');
            $table->foreignId('bobot_id');
            $table->foreign('history_id')->references('id')->on('histories')->onDelete('cascade');
            $table->foreign('alternatif_id')->references('id')->on('alternatifs')->onDelete('cascade');
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('bobot_id')->references('id')->on('bobots')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_details');
    }
};
