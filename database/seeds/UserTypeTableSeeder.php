<?php

use Illuminate\Database\Seeder;
use App\UserType;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userType1 = new UserType();
        $userType1->type = 'lecturer';
        $userType1->description = 'Pasniedzējs';
        $userType1->save();

        $userType2 = new UserType();
        $userType2->type = 'dean';
        $userType2->description = 'Dekāns';
        $userType2->save();

        $userType3 = new UserType();
        $userType3->type = 'director';
        $userType3->description = 'Studiju programmas direktors';
        $userType3->save();

        $userType4 = new UserType();
        $userType4->type = 'vice_rector';
        $userType4->description = 'Mācību prorektors';
        $userType4->save();

        $userType5 = new UserType();
        $userType5->type = 'study_manager';
        $userType5->description = 'Mācību daļas vadītājs';
        $userType5->save();

        $userType6 = new UserType();
        $userType6->type = 'study_specialist';
        $userType6->description = 'Speciālists studiju un studiju kvalitātes jautājumos';
        $userType6->save();

        $userType7 = new UserType();
        $userType7->type = 'external_issues_specialist';
        $userType7->description = 'Speciālists ārējo sakaru jautājumos';
        $userType7->save();

        $userType8 = new UserType();
        $userType8->type = 'secretary';
        $userType8->description = 'Studiju administrēšanas speciālists-lietvedis';
        $userType8->save();

        $userType9 = new UserType();
        $userType9->type = 'student';
        $userType9->description = 'Students';
        $userType9->save();

        $userType10 = new UserType();
        $userType10->type = 'admin';
        $userType10->description = 'Sistēmas administrators';
        $userType10->save();
    }
}