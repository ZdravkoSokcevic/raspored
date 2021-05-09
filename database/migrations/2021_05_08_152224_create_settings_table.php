<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->time('weekup_time');
            $table->time('bed_time');
            
            // tea 143
            $table->string('tea_143_quantity', 15);
            $table->enum('tea_143_quatity_type', ['ml', 'dl', 'l']);

            // tea 11            
            $table->string('tea_11_quantity');
            $table->enum('tea_11_quatity_type', ['ml', 'dl', 'l']);            

            // tea 55
            $table->string('tea_55_quantity');
            $table->enum('tea_55_quatity_type', ['ml', 'dl', 'l']);

            // all day
            $table->string('tea_all_day_quantity');
            $table->enum('tea_all_day_quatity_type', ['ml', 'dl', 'l']);

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
        Schema::dropIfExists('settings');
    }
}
