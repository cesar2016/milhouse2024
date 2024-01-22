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
        Schema::create('type_sales', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->integer('code');
            $table->boolean('status');

            $table->timestamps();
        });

        $data = [
            [
                "name" => "contado",
                "code" => 1,
                "status" => true,
            ],
            [
                "name" => "Credito",
                "code" => 2,
                "status" => true,

            ],
            [
                "name" => "Cont/Transf",
                "code" => 3,
                "status" => true,

            ],
            [
                "name" => "Cheque",
                "code" => 4,
                "status" => true,

            ]
            ];

        DB::table("type_sales")
        ->insert( $data );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_sales');
    }
};
