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
        Schema::create('brand_products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->boolean('status');

            $table->foreignId('provider_id')->nullable()->constrained();

            $table->timestamps();
        });

        DB::table("brand_products")
        ->insert([
            "name" => "default",
            "status" => 1,
            "provider_id" => 1

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brand_products');
    }
};
