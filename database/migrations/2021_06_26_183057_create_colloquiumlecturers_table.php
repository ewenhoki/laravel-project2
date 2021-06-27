<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColloquiumlecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colloquiumlecturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('colloquium_id');
            $table->integer('lecturer_id');
            $table->integer('confirm')->nullable();
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
        Schema::dropIfExists('colloquiumlecturers');
    }
}
