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
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('coupon_id')->unsigned()->index()->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');

            $table->integer('usage_count')->default(0);
            $table->timestamp('last_used');

            $table->softDeletes();
            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('user_coupons');
    }
};
