<?php

use Illuminate\Database\Seeder;
use App\Catalog;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalog1 = new Catalog();
        $catalog1->name = 'Visi kursi, priekšnosacījumi, kursu mērķis, rezultāti';
        $catalog1->prerequisites = 1;
        $catalog1->objective = 1;
        $catalog1->study_results = 1;
        $catalog1->save();

        $catalog2 = new Catalog();
        $catalog2->name = 'Visi kursi, priekšnosacījumi, kursu mērķis, rezultāti (vienā lapā)';
        $catalog2->prerequisites = 1;
        $catalog2->objective = 1;
        $catalog2->study_results = 1;
        $catalog2->show_in_one_page = 1;
        $catalog2->save();

        $catalog3 = new Catalog();
        $catalog3->name = 'Visi kursi, viss saturs';
        $catalog3->lecturers = 1;
        $catalog3->LAIS_code = 1;
        $catalog3->type_of_test = 1;
        $catalog3->kp = 1;
        $catalog3->total_number_of_lectures = 1;
        $catalog3->number_of_lectures = 1;
        $catalog3->prerequisites = 1;
        $catalog3->study_program_part = 1;
        $catalog3->objective = 1;
        $catalog3->independent_tasks = 1;
        $catalog3->evaluation = 1;
        $catalog3->subjects = 1;
        $catalog3->calendar_plan = 1;
        $catalog3->basic_literature = 1;
        $catalog3->additional_literature = 1;
        $catalog3->other_information_sources = 1;
        $catalog3->save();

        $catalog4 = new Catalog();
        $catalog4->name = 'Tulkošanas fakultātes kursi';
        $catalog4->faculty_id = 3;
        $catalog4->prerequisites = 1;
        $catalog4->objective = 1;
        $catalog4->study_results = 1;
        $catalog4->save();

        $catalog5 = new Catalog();
        $catalog5->name = 'Studiju programmas Datorzinātnes (bakalaura) kursi';
        $catalog5->study_program_id = 1;
        $catalog5->prerequisites = 1;
        $catalog5->objective = 1;
        $catalog5->study_results = 1;
        $catalog5->save();

        $catalog6 = new Catalog();
        $catalog6->name = 'C kursi';
        $catalog6->c_courses = 1;
        $catalog6->lecturers = 1;
        $catalog6->LAIS_code = 1;
        $catalog6->type_of_test = 1;
        $catalog6->kp = 1;
        $catalog6->total_number_of_lectures = 1;
        $catalog6->number_of_lectures = 1;
        $catalog6->prerequisites = 1;
        $catalog6->study_program_part = 1;
        $catalog6->objective = 1;
        $catalog6->independent_tasks = 1;
        $catalog6->evaluation = 1;
        $catalog6->subjects = 1;
        $catalog6->calendar_plan = 1;
        $catalog6->basic_literature = 1;
        $catalog6->additional_literature = 1;
        $catalog6->other_information_sources = 1;
        $catalog6->save();

        $catalog7 = new Catalog();
        $catalog7->name = 'Katalogs redzams viesiem';
        $catalog7->prerequisites = 1;
        $catalog7->objective = 1;
        $catalog7->study_results = 1;
        $catalog7->available_for_guests = 1;
        $catalog7->save();

        $catalog8 = new Catalog();
        $catalog8->name = 'Katalogs redzams studentiem';
        $catalog8->prerequisites = 1;
        $catalog8->objective = 1;
        $catalog8->study_results = 1;
        $catalog8->available_for_students = 1;
        $catalog8->save();

        $catalog9 = new Catalog();
        $catalog9->name = 'Katalogs redzams gan viesiem, gan studentiem';
        $catalog9->prerequisites = 1;
        $catalog9->objective = 1;
        $catalog9->study_results = 1;
        $catalog9->show_in_one_page = 1;
        $catalog9->available_for_guests = 1;
        $catalog9->available_for_students = 1;
        $catalog9->save();

        $catalog10 = new Catalog();
        $catalog10->name = 'C kursi (redzams viesiem un studentiem)';
        $catalog10->c_courses = 1;
        $catalog10->prerequisites = 1;
        $catalog10->objective = 1;
        $catalog10->independent_tasks = 1;
        $catalog10->evaluation = 1;
        $catalog10->subjects = 1;
        $catalog10->available_for_guests = 1;
        $catalog10->available_for_students = 1;
        $catalog10->save();

        $catalog11 = new Catalog();
        $catalog11->name = 'Visi studiju kursi angļu valodā';
        $catalog11->lecturers = 1;
        $catalog11->LAIS_code = 1;
        $catalog11->type_of_test = 1;
        $catalog11->kp = 1;
        $catalog11->total_number_of_lectures = 1;
        $catalog11->number_of_lectures = 1;
        $catalog11->prerequisites = 1;
        $catalog11->study_program_part = 1;
        $catalog11->objective = 1;
        $catalog11->independent_tasks = 1;
        $catalog11->evaluation = 1;
        $catalog11->subjects = 1;
        $catalog11->calendar_plan = 1;
        $catalog11->basic_literature = 1;
        $catalog11->additional_literature = 1;
        $catalog11->other_information_sources = 1;
        $catalog11->contents_only_eng = 1;
        $catalog11->save();
    }
}
