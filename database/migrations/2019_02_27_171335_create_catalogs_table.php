<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('faculty_id')->default(0);
            $table->integer('study_program_id')->default(0);
            $table->boolean('c_courses')->default(0);
            $table->boolean('name_eng')->default(0);
            $table->boolean('lecturers')->default(0);
            $table->boolean('LAIS_code')->default(0);
            $table->boolean('type_of_test')->default(0);
            $table->boolean('kp')->default(0);
            $table->boolean('total_number_of_lectures')->default(0);
            $table->boolean('number_of_lectures')->default(0);
            $table->boolean('prerequisites')->default(0);
            $table->boolean('study_program_part')->default(0);
            $table->boolean('objective')->default(0);
            $table->boolean('study_results')->default(0);
            $table->boolean('independent_tasks')->default(0);
            $table->boolean('evaluation')->default(0);
            $table->boolean('subjects')->default(0);
            $table->boolean('calendar_plan')->default(0);
            $table->boolean('basic_literature')->default(0);
            $table->boolean('additional_literature')->default(0);
            $table->boolean('other_information_sources')->default(0);
            $table->boolean('show_in_one_page')->default(0);
            $table->boolean('available_for_students')->default(0);
            $table->boolean('available_for_guests')->default(0);
            $table->boolean('contents_only_eng')->default(0);
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
        Schema::dropIfExists('catalogs');
    }
}
