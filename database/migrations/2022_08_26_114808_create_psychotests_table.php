<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychotests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psychologist_id');
            $table->string('location');
            $table->string('date');
            $table->string('time');
            $table->integer('quota');
            $table->enum('status',['cancel','finished','unfinished'])->default('unfinished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychotests');
    }
};
