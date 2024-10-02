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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->text('thumb_image');
            $table->integer('brand_id');
            $table->integer('model_id');

            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('type_id');

            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->text('video_link')->nullable();

            $table->integer('sku')->nullable();

            $table->double('price', 10 ,2);
            $table->integer('client_discount');
            $table->integer('distributor_discount');

            $table->boolean('status')->default(false);
            $table->boolean('product_type')->default(1);

            $table->longText('features')->nullable();
            $table->string('warrenty')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
