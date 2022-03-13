<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceIndicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_indications', function (Blueprint $table) {
            $table->bigInteger('indication_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict');

            $table->foreign('indication_id')
                ->references('id')
                ->on('indications')
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
        Schema::dropIfExists('service_indications');
    }
}
