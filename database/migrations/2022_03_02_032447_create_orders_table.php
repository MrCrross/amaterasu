<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('seance');
            $table->boolean('status');
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();

            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
            ->onDelete('restrict');

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict');

            $table->foreign('worker_id')
                ->references('id')
                ->on('workers')
                ->onDelete('restrict');

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
        Schema::dropIfExists('orders');
    }
}
