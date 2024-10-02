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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code', 50)->unique();
            $table->string('description', 255 );
            $table->string('discount_type', 20);

            $table->decimal('discount_value');
            $table->decimal('min_order_value');
            $table->decimal('max_discount_value');

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('usage_limit')->nullable();

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
