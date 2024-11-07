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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('email');
            $table->string('favicon');
            $table->string('logo');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('insagram');
            $table->string('youtupe');
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('street');
            $table->text('small_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
