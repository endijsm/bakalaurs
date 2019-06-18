<?php

use Illuminate\Database\Seeder;
use App\User;
use App\StudyCourse;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->firstname = 'Administrators';
        $admin->lastname = 'Uzvārds';
        $admin->username = 'admin';
        $admin->degree = 'nav norādīts';
        $admin->position = 'nav norādīts';
        $admin->user_type_id = 10;
        $admin->is_lecturer = 0;
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('admin');
        $admin->save();

        $study_course1 = StudyCourse::where('id', '1')->first();
        $study_course2 = StudyCourse::where('id', '2')->first();
        $study_course3 = StudyCourse::where('id', '3')->first();
        $study_course4 = StudyCourse::where('id', '4')->first();
        $study_course5 = StudyCourse::where('id', '5')->first();
        $study_course6 = StudyCourse::where('id', '6')->first();
        $study_course7 = StudyCourse::where('id', '7')->first();

        $lecturer1 = new User();
        $lecturer1->firstname = 'Gaļina';
        $lecturer1->lastname = 'Hiļķeviča';
        $lecturer1->username = 'galina';
        $lecturer1->degree = 'Dr.math.';
        $lecturer1->position = 'asoc.prof.';
        $lecturer1->user_type_id = 1;
        $lecturer1->is_lecturer = 1;
        $lecturer1->email = 'galina@example.com';
        $lecturer1->password = bcrypt('galina');
        $lecturer1->save();
        $lecturer1->study_courses()->attach($study_course3);

        $lecturer2 = new User();
        $lecturer2->firstname = 'Raita';
        $lecturer2->lastname = 'Rollande';
        $lecturer2->username = 'raita';
        $lecturer2->degree = 'Dr.sc.ing';
        $lecturer2->position = 'asoc.prof.';
        $lecturer2->user_type_id = 1;
        $lecturer2->is_lecturer = 1;
        $lecturer2->email = 'raita@example.com';
        $lecturer2->password = bcrypt('raita');
        $lecturer2->save();

        $lecturer3 = new User();
        $lecturer3->firstname = 'Karina';
        $lecturer3->lastname = 'Šķirmante';
        $lecturer3->username = 'karina';
        $lecturer3->degree = 'Mg.sc.comp.';
        $lecturer3->position = 'lektore';
        $lecturer3->user_type_id = 1;
        $lecturer3->is_lecturer = 1;
        $lecturer3->email = 'karina@example.com';
        $lecturer3->password = bcrypt('karina');
        $lecturer3->save();
        $lecturer3->study_courses()->attach($study_course2);

        $lecturer4 = new User();
        $lecturer4->firstname = 'Juris';
        $lecturer4->lastname = 'Žagars';
        $lecturer4->username = 'jurisz';
        $lecturer4->degree = 'Dr.hab.phys.';
        $lecturer4->position = 'asoc.prof.';
        $lecturer4->user_type_id = 1;
        $lecturer4->is_lecturer = 1;
        $lecturer4->email = 'jurisz@example.com';
        $lecturer4->password = bcrypt('jurisz');
        $lecturer4->save();

        $lecturer5 = new User();
        $lecturer5->firstname = 'Estere';
        $lecturer5->lastname = 'Vītola';
        $lecturer5->username = 'estere';
        $lecturer5->degree = 'Mg.paed.';
        $lecturer5->position = 'lektore';
        $lecturer5->user_type_id = 1;
        $lecturer5->is_lecturer = 1;
        $lecturer5->email = 'estere@example.com';
        $lecturer5->password = bcrypt('estere');
        $lecturer5->save();

        $lecturer6 = new User();
        $lecturer6->firstname = 'Jeļena';
        $lecturer6->lastname = 'Mihailova';
        $lecturer6->username = 'jelena';
        $lecturer6->degree = 'Mg.math.';
        $lecturer6->position = 'lektore';
        $lecturer6->user_type_id = 1;
        $lecturer6->is_lecturer = 1;
        $lecturer6->email = 'jelena@example.com';
        $lecturer6->password = bcrypt('jelena');
        $lecturer6->save();
        $lecturer6->study_courses()->attach($study_course3);

        $lecturer7 = new User();
        $lecturer7->firstname = 'Gints';
        $lecturer7->lastname = 'Neimanis';
        $lecturer7->username = 'gints';
        $lecturer7->degree = 'Mg.oec.';
        $lecturer7->position = 'lektors';
        $lecturer7->user_type_id = 1;
        $lecturer7->is_lecturer = 1;
        $lecturer7->email = 'gints@example.com';
        $lecturer7->password = bcrypt('gints');
        $lecturer7->save();

        $lecturer8 = new User();
        $lecturer8->firstname = 'Juris';
        $lecturer8->lastname = 'Kļonovs';
        $lecturer8->username = 'jurisk';
        $lecturer8->degree = 'PhD cand., Mg.sc.comp.';
        $lecturer8->position = 'lektors';
        $lecturer8->user_type_id = 1;
        $lecturer8->is_lecturer = 1;
        $lecturer8->email = 'jurisk@example.com';
        $lecturer8->password = bcrypt('jurisk');
        $lecturer8->save();
        $lecturer8->study_courses()->attach($study_course1);

        $lecturer9 = new User();
        $lecturer9->firstname = 'Vārds';
        $lecturer9->lastname = 'Uzvārds';
        $lecturer9->username = 'pasniedzejs2';
        $lecturer9->degree = 'Mg.sc.comp.';
        $lecturer9->position = 'lektors';
        $lecturer9->user_type_id = 1;
        $lecturer9->is_lecturer = 1;
        $lecturer9->email = 'lecturer2@example.com';
        $lecturer9->password = bcrypt('pasniedzejs2');
        $lecturer9->save();
        $lecturer9->study_courses()->attach($study_course4);
        $lecturer9->study_courses()->attach($study_course5);
        $lecturer9->study_courses()->attach($study_course6);
        $lecturer9->study_courses()->attach($study_course7);

        $director = new User();
        $director->firstname = 'Vārds';
        $director->lastname = 'Uzvārds';
        $director->username = 'direktors';
        $director->degree = '-';
        $director->position = 'studiju programmas direktors';
        $director->user_type_id = 3;
        $director->is_lecturer = 0;
        $director->email = 'director@example.com';
        $director->password = bcrypt('direktors');
        $director->save();

        $vice_rector = new User();
        $vice_rector->firstname = 'Vārds';
        $vice_rector->lastname = 'Uzvārds';
        $vice_rector->username = 'prorektors';
        $vice_rector->degree = '-';
        $vice_rector->position = 'mācību prorektors';
        $vice_rector->user_type_id = 4;
        $vice_rector->is_lecturer = 0;
        $vice_rector->email = 'vice.rector@example.com';
        $vice_rector->password = bcrypt('prorektors');
        $vice_rector->save();
        
        $study_manager = new User();
        $study_manager->firstname = 'Vārds';
        $study_manager->lastname = 'Uzvārds';
        $study_manager->username = 'mdvad';
        $study_manager->degree = '-';
        $study_manager->position = 5;
        $study_manager->user_type_id = 5;
        $study_manager->is_lecturer = 0;
        $study_manager->email = 'mdvad@example.com';
        $study_manager->password = bcrypt('mdvad');
        $study_manager->save();

        $study_specialist = new User();
        $study_specialist->firstname = 'Vārds';
        $study_specialist->lastname = 'Uzvārds';
        $study_specialist->username = 'studspec';
        $study_specialist->degree = '-';
        $study_specialist->position = 'speciālists studiju kvalitātes jautājumos';
        $study_specialist->user_type_id = 6;
        $study_specialist->is_lecturer = 0;
        $study_specialist->email = 'studspec@example.com';
        $study_specialist->password = bcrypt('studspec');
        $study_specialist->save();
        
        $external_issues_specialist = new User();
        $external_issues_specialist->firstname = 'Vārds';
        $external_issues_specialist->lastname = 'Uzvārds';
        $external_issues_specialist->username = 'arejiesakari';
        $external_issues_specialist->degree = '-';
        $external_issues_specialist->position = 'speciālists ārējo sakaru jautājumos';
        $external_issues_specialist->user_type_id = 7;
        $external_issues_specialist->is_lecturer = 0;
        $external_issues_specialist->email = 'arejiesakari@example.com';
        $external_issues_specialist->password = bcrypt('arejiesakari');
        $external_issues_specialist->save();
        
        $secretary = new User();
        $secretary->firstname = 'Vārds';
        $secretary->lastname = 'Uzvārds';
        $secretary->username = 'lietvedis';
        $secretary->degree = '-';
        $secretary->position = 'studiju administrēšanas speciālists - lietvedis';
        $secretary->user_type_id = 8;
        $secretary->is_lecturer = 0;
        $secretary->email = 'lietvedis@example.com';
        $secretary->password = bcrypt('lietvedis');
        $secretary->save();

        $student = new User();
        $student->firstname = 'Vārds';
        $student->lastname = 'Uzvārds';
        $student->username = 'students';
        $student->degree = '-';
        $student->position = '-';
        $student->user_type_id = 9;
        $student->is_lecturer = 0;
        $student->email = 'students@example.com';
        $student->password = bcrypt('students');
        $student->save();
    }
}
