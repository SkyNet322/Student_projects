<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
       /* Schema::create('connects', function (Blueprint $table) {
            $table->id();
            //$table->integer('guid_id');
            $table->timestamps();
        });*/
        Schema::table('personnels', function (Blueprint $table) {
            $table->integer('connect_id')->nullable();
            $table->foreign('connect_id')->references('id')->on('connects')->onDelete('cascade');;
        });

        Schema::table('inflics', function (Blueprint $table) {
            $table->integer('connect_id')->nullable();
            $table->foreign('connect_id')->references('id')->on('connects');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connects');
    }
};
