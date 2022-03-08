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
        Schema::create('itinerates', function (Blueprint $table) {

            $table->id();
            $table->datetime('date_takeoff');
            $table->datetime('date_estimated_takeoff');
            $table->datetime('date_landing');
            $table->datetime('date_estimated_landing');
            $table->float('cost')->default(0);
            $table->unsignedBigInteger('ship_id')->nullable();
            $table->unsignedBigInteger('bay_id')->nullable();
            $table->timestamps();

            $table->foreign('ship_id')
                ->references('id')
                ->on('ships')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('bay_id')
                ->references('id')
                ->on('bays')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itinerates');
    }
};
