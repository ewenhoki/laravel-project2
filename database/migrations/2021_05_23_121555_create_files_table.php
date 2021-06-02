<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_id');
            $table->string('title')->nullable();
            $table->string('krs')->nullable();
            $table->string('kss')->nullable();
            $table->string('proposal')->nullable();
            $table->string('paper')->nullable();
            $table->string('letter_1')->nullable();
            $table->string('letter_2')->nullable();
            $table->timestamp('upload_date')->nullable();
            $table->timestamp('letter_1_date')->nullable();
            $table->timestamp('letter_2_date')->nullable();
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
        Schema::dropIfExists('files');
    }
}
