<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->string('name');
            $table->bigInteger('stock');
            $table->integer('price_purchase');
            $table->integer('price_sale');
            $table->boolean('status')->default(1);
            $table->date('date_purchase');

            /*$table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');*/

            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('brand_product_id')->nullable()->constrained();
            //$table->foreignId('provider_id')->constrained();


            $table->timestamps();
        });

        DB::table("products")
        ->insert([
            "code" => "def000",
            "name" => "default",
            "stock" => 1000000000,
            "price_purchase" => 1,
            "price_sale" => 1,
            "status" => 1,
            "date_purchase" => date('Y-m-d'),
            "category_id" => 1,
            "brand_product_id" => 1

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
