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
        Schema::create('pernyataan_kuesioner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variable_id');
            $table->foreign('variable_id')->references('id')->on('variable_kuesioner')->onDelete('cascade');

            $table->string('indikator');
            $table->string('kode_indikator');
            $table->longText('isi_kuesioner');
            $table->boolean('is_positive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernyataan_kuesioner');
    }
};
