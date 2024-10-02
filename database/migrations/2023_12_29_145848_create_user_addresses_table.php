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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned() ->index();
            $table->string('full_name');
            $table->string('country')->default('India')->nullable();
            $table->string('pincode');
            $table->string('city');
            $table->string('state')->nullable();
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->string('mobile_number');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
