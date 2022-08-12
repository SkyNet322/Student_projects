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
        Schema::create('inflics', function (Blueprint $table) {
            $table->id();
            $table->string('item')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->bigInteger('inflic_1_year')->nullable();
            $table->bigInteger('inflic_2_year')->nullable();
            $table->bigInteger('inflic_3_year')->nullable();
            $table->bigInteger('inflic_4_year')->nullable();
            $table->bigInteger('inflic_5_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inflics');
    }
};
