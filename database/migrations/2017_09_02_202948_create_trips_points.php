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

            $table->integer('cargo_type_id')->index()->nullable();


            $table->float('cargo_weight')->nullable();
            $table->float('cargo_volume')->nullable();

            $table->text('details')->nullable();
            $table->date('schedule_date')->nullable();
            $table->time('schedule_time')->nullable();

            $table->date('confirmed_date')->nullable();
            $table->time('confirmed_time')->nullable();

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
