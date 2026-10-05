<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add id to sensor_values table
        Schema::table('sensor_values', function (Blueprint $table) {
            $table->id()->first(); // Add auto-incrementing primary key 'id' at the beginning
        });

        // Add id to sensor_s3 table
        Schema::table('sensor_s3', function (Blueprint $table) {
            $table->id()->first(); // Add auto-incrementing primary key 'id' at the beginning
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove id from sensor_values table
        Schema::table('sensor_values', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // Remove id from sensor_s3 table
        Schema::table('sensor_s3', function (Blueprint $table) {
            $table->dropColumn('id');
        });
    }
};
