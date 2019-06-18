<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_eng')->nullable();
            $table->string('LAIS_code', 45);
            $table->integer('kp');
            $table->integer('number_of_lectures');
            $table->integer('number_of_seminars');
            $table->text('prerequisites');
            $table->text('objective');
            $table->integer('type_of_test_id');
            $table->integer('study_program_part_id');
            $table->timestamps();
            $table->integer('author_id');
            $table->integer('faculty_id');
            $table->boolean('c_course')->default(0);
            $table->boolean('eng')->default(0); // course description is written in english
            $table->boolean('direct_results')->default(1); // 2 ways of defining study results - direct results or linked results
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_courses');
    }
}
