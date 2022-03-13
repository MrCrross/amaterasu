<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceContraindicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_contraindications', function (Blueprint $table) {
            $table->bigInteger('contraindication_id')->unsigned();
            $table->bigInteger('service_id')->unsigned();

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict');

            $table->foreign('contraindication_id')
                ->references('id')
                ->on('contraindications')
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
        Schema::dropIfExists('service_contraindications');
    }
}
