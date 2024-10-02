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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('payment_id');
            $table->string('payment_order_id');
            $table->double('payment_amount', 10,2);
            $table->string('payment_method');
            $table->string('status');
            $table->date('payment_date');
            $table->longText('payment_info')->nullable();

            $table->string('payment_name')->nullable();
            $table->string('payment_email')->nullable();
            $table->string('payment_mobile')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
