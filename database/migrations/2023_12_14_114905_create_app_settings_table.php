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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email_1');
            $table->string('email_2');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('address');
            $table->string('maps');
            $table->string('t_link');
            $table->string('f_link');
            $table->string('i_link');
            $table->string('y_link');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
