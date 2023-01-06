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
        Schema::create('email_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->longText('body');
            $table->json('attach_files')->nullable();
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
        Schema::dropIfExists('email_replies');
    }
};
