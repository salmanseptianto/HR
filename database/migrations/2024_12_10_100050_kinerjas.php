<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerjas', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Unsigned Big Integer
            $table->string('perilaku'); // Kompetensi / Perilaku
            $table->integer('nilai')->comment('Rating between 1 and 5'); // Rating
            $table->string('month'); // Month of performance evaluation
            $table->integer('year'); // Year of performance evaluation
            $table->timestamps(); // Created_at and Updated_at columns

            // Add foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kinerjas');
    }
}
