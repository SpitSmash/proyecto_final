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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ship_id')->nullable();
            $table->unsignedBigInteger('itinerary_id')->nullable();

            $table->foreign('ship_id')
                ->references('id')
                ->on('ships')
                ->onDelete('cascade');

            $table->foreign('itinerary_id')
                ->references('id')
                ->on('itinerates')
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
        Schema::dropIfExists('requests');
    }
};
