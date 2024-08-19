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
        Schema::create('racers', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation');
            $table->string('full_name');
            $table->string('car');
            $table->timestamp('best_time_start', 3);
            $table->timestamp('best_time_end', 3);
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
        Schema::dropIfExists('racers');
    }
};
