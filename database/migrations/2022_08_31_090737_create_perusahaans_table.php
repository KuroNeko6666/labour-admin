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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('alamat')->nullable();
            $table->string('hp')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('web')->nullable();
            $table->string('logo')->nullable();
            $table->enum('member', ['free', 'silver', 'gold'])->default('free');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('perusahaans');
    }
};
