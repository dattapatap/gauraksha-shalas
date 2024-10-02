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
        Schema::create('category_types', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->text('image')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_types');
    }
};
