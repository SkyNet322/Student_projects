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
        Schema::create('calculates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->timestamps();
        });
/*
        Schema::table('personnels', function (Blueprint $table) {
            $table->integer('calculate_id')->nullable();
            $table->foreign('calculate_id')->references('id')->on('calculates')->onDelete('cascade');;
        });

        Schema::table('inflics', function (Blueprint $table) {
            $table->integer('calculate_id')->nullable();
            $table->foreign('calculate_id')->references('id')->on('calculates');
        });

        Schema::enableForeignKeyConstraints();*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('inflics', function($table) {
            $table->dropForeign('inflics_calculate_id_foreign');
            $table->dropColumn('calculate_id');
        });
        Schema::dropIfExists('calculates');
    }
};
