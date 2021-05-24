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
            $table->time('wakeup_time');
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

            // tea 143 times
            $table->string('tea_143_times')->nullable();
            
            // tea 11 times
            $table->string('tea_11_times')->nullable();
            
            // tea 55 times
            $table->string('tea_55_times')->nullable();

            // drops I times
            $table->string('drops_I_times')->nullable();

            // drops II times
            $table->string('drops_II_times')->nullable();

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
