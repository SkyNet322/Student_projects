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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
           /* $table->integer('calculate_id');
            $table->index('calculate_id');*/
            $table->string('post')->nullable();
            $table->float('quantity_of_the_rate')->nullable();
            $table->string('unified_social_tax')->nullable();
            $table->bigInteger('wage')->nullable();
            $table->integer('number_of_month_of_work')->nullable();
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
        Schema::dropIfExists('personnels');
    }
};
