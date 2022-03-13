<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_services', function (Blueprint $table) {
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict');

            $table->foreign('worker_id')
                ->references('id')
                ->on('workers')
                ->onDelete('restrict');

            $table->primary(['worker_id','service_id']);
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
        Schema::dropIfExists('worker_services');
    }
}
