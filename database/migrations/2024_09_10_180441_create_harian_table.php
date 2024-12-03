<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_marketing');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('project'); 
            $table->text('leads')->nullable();
            $table->string('aktivitas')->nullable();
            $table->timestamps();

            $table->foreign('id_marketing')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('harian');
    }
}
