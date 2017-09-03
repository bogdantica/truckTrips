<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips_points', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('trip_id')->index();
            $table->integer('point_type_id')->index();
            $table->integer('place_id')->nullable()->index();

            $table->text('description')->nullable();

            $table->float('current_kilometers')->nullable();

            $table->dateTime('arrived_at')->nullable();
            $table->dateTime('departed_at')->nullable();

            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips_points');
    }
}
