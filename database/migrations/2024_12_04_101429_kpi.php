<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->date('tanggal')->default(Carbon::now()->format('Y-m-d'))->change();  // Set default date after the column exists
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->text('desc');
            $table->decimal('bobot', 8, 2);
            $table->decimal('target', 8, 2);
            $table->decimal('realisasi', 8, 2);
            $table->decimal('skor', 8, 2);
            $table->decimal('final_skor', 8, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
    }
};
