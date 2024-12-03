<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
   Schema::create('mingguan', function (Blueprint $table) {
            $table->id();
            $table->string('projectArea');
            $table->date('periode');
            $table->string('totalJumlahKanva');
            $table->integer('jumlahKanvasTimSeminggu');
            $table->string('iklanOnline');
            $table->string('postingSosmed');
            $table->string('janjiTemuDanKunjungan');
            $table->string('calonKonsCekLokasi');
            $table->integer('totalDataLeads');
            $table->string('dataProspek');
            $table->string('hotProspek');
            $table->string('booking');
            $table->string('pemberkasan');
            $table->decimal('closingAkadCash', 15, 2);
            $table->string('rencanaTargetClosingDalam1Bulan');
            $table->timestamps();
        });
    
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mingguan');
    }
};
