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

            $table->integer('driver_user_id')->unsigned()->index()->nullable();

            $table->float('distance')->nullable();

            $table->float('total_price')->nullable();
            $table->integer('vat_id')->nullable();


            $table->text('details')->nullable();

            $table->integer('pay_method_id')->index()->nullable();
            $table->integer('pay_days')->nullable();
            $table->text('pay_details')->nullable();
            $table->text('agreement')->nullable();

            $table->date('agreement_date')->nullable();

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
