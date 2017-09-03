<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('sender_company_id')->nullable();
            $table->integer('receiver_company_id')->nullable();

            $table->integer('truck_id')->unsigned()->index()->nullable();
            $table->integer('driver_user_id')->unsigned()->index()->nullable();

            $table->text('description')->nullable();

            $table->float('pay_distance')->nullable();
            $table->float('payed_distance')->nullable();
            $table->float('real_distance')->nullable();

            $table->float('load_weight')->nullable();
            $table->float('payed_load_weight')->nullable();
            $table->float('load_volume')->nullable();
            $table->float('payed_load_volume')->nullable();

            $table->integer('event_type_id')->index();

            $table->integer('edited_by')->index()->nullable();
            $table->integer('created_by')->index()->nullable();

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
        Schema::dropIfExists('trips');
    }
}
