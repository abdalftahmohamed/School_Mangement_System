<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('Name_Section');
            $table->string('Status');
            $table->unsignedBigInteger('Grade_id')->unsigned();
            $table->foreign('Grade_id')->references('id')->on('Grades')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('Class_id')->unsigned();
            $table->foreign('Class_id')->references('id')->on('Classrooms')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('sections');
    }
};
