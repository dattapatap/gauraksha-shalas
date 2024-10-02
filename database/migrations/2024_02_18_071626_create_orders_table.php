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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('transaction_id')->unsigned()->index()->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions');

            $table->string('order_id', 20);
            $table->string('invoice_no', 20)->nullable();
            $table->string('tax_id', 20)->nullable();

            $table->string('payment_type', 20);
            $table->string('payment_status', 20);

            $table->integer('total_qty');

            $table->string('delivery_name', 100);
            $table->string('mobile', 15);
            $table->string('email', 50)->nullable();
            $table->text('address');
            $table->string('city', 50);
            $table->string('state', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('pincode', 10);

            $table->float('order_cost', 8,2);
            $table->float('shipping_cost', 8,2);
            $table->float('tax_amount', 8,2);
            $table->float('discount', 8,2);
            $table->float('subtotal', 12,2);

            $table->string('coupon', 20)->nullable();
            $table->float('coupon_discount', 8,2)->nullable();

            $table->string('shipment_name', 50)->nullable();
            $table->string('shipment_id')->nullable(true)->unique();
            $table->dateTime('delivered_dt')->nullable(true)->unique();


            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
