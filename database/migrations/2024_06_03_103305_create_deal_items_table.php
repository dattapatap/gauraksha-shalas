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
        Schema::create('deal_items', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('deal_id')->unsigned()->index()->nullable();
            $table->foreign('deal_id')->references('id')->on('deal_of_the_days')->onDelete('cascade');

            $table->bigInteger('product_id')->unsigned()->index()->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('client_discount');
            $table->integer('distributor_discount');

            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deal_items');
    }
};
