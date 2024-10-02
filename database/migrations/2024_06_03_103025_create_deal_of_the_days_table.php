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
        Schema::create('deal_of_the_days', function (Blueprint $table) {
            $table->id();

            $table->string('title', 50)->unique();
            $table->string('description', 255 );

            $table->text('image');

            $table->date('start_date');
            $table->date('end_date');

            $table->string('availability', 20);

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_of_the_days');
    }
};
