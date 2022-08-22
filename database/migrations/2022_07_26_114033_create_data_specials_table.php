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
        Schema::create('data_specials', function (Blueprint $table) {
            $table->id();
            $table->string('GUID')->nullable();
            $table->string('name')->nullable();
            $table->string('status_IS')->nullable();
            $table->string('criticality')->nullable();
            $table->string('expert')->nullable();
            $table->string('responsible_for_development')->nullable();
            $table->string('responsible_for_maintenance')->nullable();
            $table->string('functions_IS')->nullable();
            $table->string('producer_IS')->nullable();
            $table->string('domain')->nullable();
            $table->string('subdomain')->nullable();
            $table->timestamps();
        });

        Schema::create('connects', function (Blueprint $table) {
            $table->id();
            //$table->integer('guid_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::table('connects', function (Blueprint $table) {
            $table->integer('guid_id')->nullable()->unsigned();
            $table->foreign('guid_id')->references('id')->on('data_specials')->onDelete('cascade');;
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_specials');
    }
};
