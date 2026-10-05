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
        Schema::create('sensor_s3', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->float('temperature')->nullable();
            $table->float('moisture')->nullable();
            $table->float('ph')->nullable();
            $table->float('conductivity')->nullable();
            $table->float('nitrogen')->nullable();
            $table->float('phosphorus')->nullable();
            $table->float('potassium')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensor_s3');
    }
};
