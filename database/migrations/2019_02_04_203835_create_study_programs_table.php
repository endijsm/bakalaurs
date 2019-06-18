<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('level', 255);
            $table->integer('study_direction_id');
            $table->integer('kp');
            $table->decimal('duration', 3, 1);
            $table->string('type', 255);
            $table->string('language', 255);
            $table->text('prerequisites');
            $table->string('degree');
            $table->integer('director_id');
            $table->text('objective');
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
        Schema::dropIfExists('study_programs');
    }
}
