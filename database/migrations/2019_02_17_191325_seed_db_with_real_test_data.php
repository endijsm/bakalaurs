<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedDbWithRealTestData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $now= new DateTime;

        DB::table('faculties')->insert([
            'name' => 'Informācijas tehnoloģiju fakultāte',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('faculties')->insert([
            'name' => 'Ekonomikas un pārvaldības fakultāte',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('faculties')->insert([
            'name' => 'Tulkošanas studiju fakultāte',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_directions')->insert([
            'name' => 'Informācijas tehnoloģija, datortehnika, elektronika, telekomunikācijas, datorvadība un datorzinātne',
            'faculty_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_directions')->insert([
            'name' => 'Vadība, administrēšana un nekustamo īpašumu pārvaldība',
            'faculty_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_directions')->insert([
            'name' => 'Tulkošana',
            'faculty_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_directions')->insert([
            'name' => 'Valodu un kultūras studijas, dzimtās valodas studijas un valodu programmas',
            'faculty_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_programs')->insert([
            'name' => 'Datorzinātnes',
            'level' => 'Bakalaura', 
            'study_direction_id' => 1,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Dabaszinātņu bakalaura grāds datorzinātnēs',
            'director_id' => 2,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Programmēšanas speciālists',
            'level' => 'Pirmā līmeņa profesionālā', 
            'study_direction_id' => 1,
            'kp' => 80,
            'duration' => 2,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība (3.kvalifikācijas līmenis)',
            'degree' => 'Kvalifikācija – programmētājs, kas atbilst 4. profesionālās kvalifikācijas līmenim.',
            'director_id' => 3,
            'objective' => 'Studiju programmas mērķis ir sagatavot speciālistus atbilstoši ceturtā profesionālā kvalifikācijas līmeņa profesijai programmētājs, nodrošinot nepieciešamās zināšanas un prasmes saistībā ar programmatūras izstrādi, kas ļautu sekmīgi iekļauties darba tirgū un patstāvīgi piemēroties mainīgajām darba tirgus prasībām.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Datorzinātnes',
            'level' => 'Maģistra', 
            'study_direction_id' => 1,
            'kp' => 80,
            'duration' => 2,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Bakalaura grāds datorzinātnēs',
            'degree' => 'Dabaszinātņu maģistra grāds datorzinātnēs',
            'director_id' => 2,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Elektronika',
            'level' => 'Bakalaura', 
            'study_direction_id' => 1,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Dabaszinātņu bakalaura grāds',
            'director_id' => 2,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Kuģu navigācijas elektronika',
            'level' => 'Bakalaura', 
            'study_direction_id' => 1,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Dabaszinātņu bakalaura grāds',
            'director_id' => 2,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Elektronika',
            'level' => 'Maģistra', 
            'study_direction_id' => 1,
            'kp' => 80,
            'duration' => 2,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Bakalaura grāds',
            'degree' => 'Dabaszinātņu maģistra grāds',
            'director_id' => 2,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_programs')->insert([
            'name' => 'Biznesa vadība',
            'level' => 'Bakalaura', 
            'study_direction_id' => 2,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Vadībzinātne',
            'level' => 'Bakalaura', 
            'study_direction_id' => 2,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Uzņēmējdarbības vadība',
            'level' => 'Maģistra', 
            'study_direction_id' => 2,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Bakalaura grāds',
            'degree' => 'Maģistra grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Starptautiskais bizness un eksporta menedžments',
            'level' => 'Maģistra', 
            'study_direction_id' => 2,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Bakalaura grāds',
            'degree' => 'Maģistra grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Biznesa vadība',
            'level' => 'Doktora', 
            'study_direction_id' => 2,
            'kp' => 80,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Maģistra grāds',
            'degree' => 'Doktora grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_programs')->insert([
            'name' => 'Tulkošana (angļu-latviešu-krievu/vācu valodā)',
            'level' => 'Bakalaura', 
            'study_direction_id' => 3,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Tulkošana (vācu-latviešu-krievu/angļu valodā)',
            'level' => 'Bakalaura', 
            'study_direction_id' => 3,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Juridisko tekstu tulkošana',
            'level' => 'Profesionālā augstākā izglītība', 
            'study_direction_id' => 3,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_programs')->insert([
            'name' => 'Valodniecība',
            'level' => 'Doktora', 
            'study_direction_id' => 4,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Maģistra grāds ...',
            'degree' => 'Doktora grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Valodas un starpkultūru komunikācija',
            'level' => 'Maģistra', 
            'study_direction_id' => 4,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Bakalaura gtāds ...',
            'degree' => 'Maģistra grāds ...',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_programs')->insert([
            'name' => 'Valodas un kultūrvide',
            'level' => 'Bakalaura', 
            'study_direction_id' => 4,
            'kp' => 120,
            'duration' => 3,
            'type' => 'pilna laika',
            'language' => 'Latviešu',
            'prerequisites' => 'Vispārējā vidējā izglītība vai vidējā profesionālā izglītība',
            'degree' => 'Bakalaura grāds',
            'director_id' => 10,
            'objective' => 'Studiju programmas mērķis ir ....',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast programmēšanas valodas Java un Phyton',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast algoritmu izstrādes pamatprincipus',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast datu bāzu izstrādes principus',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast programminženierijas procesus',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast IT nozares standartus',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast darba tiesisko attiecību normas',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast darba aizsardzības, ugunsdrošības un vides aizsardzības normatīvo aktu prasības',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast uzņēmējdarbības pamatus',
            'type' => 'zināšanas',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt izveidot programmas algoritmu',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt izmantot matemātikas zināšanas programmēšanā',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt veikt programmatūras instalāciju',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt analizēt programmas izpildes laiku un to optimizēt',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt dokumentēt programmas izmaiņas',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt lasīt un analizēt profesionālo literatūru svešvalodā',
            'type' => 'prasmes',
            'study_program_id' => 1,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast matemātikas nozīmi programmēšanā',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast algoritmu izstrādes pamatprincipus',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast programmēšanas valodas Java un Phyton',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast datu bāzu izstrādes principus',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast programminženierijas procesus',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Zināt un izprast IT nozares standartus',
            'type' => 'zināšanas',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt analizēt programmas ieejas un izejas datus',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt izveidot programmas algoritmu',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt izmantot matemātikas zināšanas programmēšanā',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt veikt programmatūras instalāciju',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt veikt programmatūras instalāciju',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt dokumentēt programmas izmaiņas',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt izstrādāt programmas kodu saskaņā ar programmatūras izstādes dokumentāciju',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt projektēt sistēmas, izstrādājot sistēmas projektējuma dokumentāciju',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Spēt ieviest programmatūru, izpildot programmatūras uzstādīšanu un parametrizēšanu un veicot datu pārnešanu',
            'type' => 'prasmes',
            'study_program_id' => 2,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 1',
            'type' => 'zināšanas',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 2',
            'type' => 'zināšanas',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 3',
            'type' => 'zināšanas',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 4',
            'type' => 'zināšanas',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 5',
            'type' => 'prasmes',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 6',
            'type' => 'prasmes',
            'study_program_id' => 12,
        ]);
        DB::table('study_program_results')->insert([
            'result' => 'Tulkošanas programmas rezultāts 7',
            'type' => 'prasmes',
            'study_program_id' => 12,
        ]);

        DB::table('type_of_tests')->insert(['type_of_test' => 'Eksāmens']);
        DB::table('type_of_tests')->insert(['type_of_test' => 'Ieskaite']);

        DB::table('study_program_parts')->insert(['part' => 'Zinātņu nozares vai apakšnozares pamatnostādnes, principus, struktūru un metodoloģiju']);
        DB::table('study_program_parts')->insert(['part' => 'Zinātņu nozares vai apakšnozares attīstības vēsturi un aktuālās problēmas']);
        DB::table('study_program_parts')->insert(['part' => 'Zinātņu nozares vai apakšnozares raksturojumu un problēmas starpnozaru aspektā']);
        DB::table('study_program_parts')->insert(['part' => 'Ierobežotās izvēles daļa']);
        DB::table('study_program_parts')->insert(['part' => 'Bakalaura darbs']);
        DB::table('study_program_parts')->insert(['part' => 'Vispārizglītojošie mācību kursi']);
        DB::table('study_program_parts')->insert(['part' => 'Nozares mācību kursi']);
        DB::table('study_program_parts')->insert(['part' => 'Obligātie kursi']);
        DB::table('study_program_parts')->insert(['part' => 'Konkrētās profesijas mācību kursi']);
        DB::table('study_program_parts')->insert(['part' => 'Izvēles mācību kursi']);
        DB::table('study_program_parts')->insert(['part' => 'Prakse']);
        DB::table('study_program_parts')->insert(['part' => 'Kvalifikācijas darbs']);
        
        
        DB::table('study_courses')->insert([
            'name' => 'Vizuālās programmēšanas valodas',
            'name_eng' => 'Visual programming languages',
            'LAIS_code' => '123456',
            'kp' => 4,
            'number_of_lectures' => 8,
            'number_of_seminars' => 24,
            'prerequisites' => 'Programmēšanas pamatprasmes, OOP programmēšanas pamatzināšanas, pieredze darbā ar JAVA vai C/C++ programmēšanas valodu',
            'objective' => 'Šis ir praktisks kurss, kas iepazīstinās VeA studentus ar mūsdienu vizuālo
            programmēšanas valodu iespējām programmatūras inženierijā.
            Šī kursa galvenais mērķis ir iepazīstināt studentus ar Microsoft Visual Studio IDE,
            .NET platformu, C # programmēšanas valodu un ar dažādām saistītām progresīvām
            tehnoloģijām, lai izprastu tehnoloģiju priekšrocības un trūkumus, kā arī galvenās to
            pielietojuma shēmas.
            Šis kurss ietver POPBL (uz projektiem orientētu problēmu risināšanas) apguves
            modeli, kura mērķis ir saskaņot studentu prasmes ar industrijas vajadzībām, kas
            attiecīgi nodrošina, ka students iegūst nepieciešamo praktisko pieredzi un zināšanas
            reālistiska projekta realizācijas laikā.
            Šis kurss iepazīstinās studentus ar fundamentālajām vizuālās programmēšanas
            koncepcijām, kas tiks uzreiz pielietotas dažādos vingrinājumos un projektos. Šajā
            kursā studenti iemācīsies strādāt ar MS Visual Studio, radīt darbvirsmas un mobilās
            lietojumprogrammas un pielietot C # programmēšanas valodu, lai risinātu dažādu
            scenāriju reālās dzīves problēmas.',
            'author_id' => 9,
            'type_of_test_id' => 1,
            'study_program_part_id' => 2,
            'faculty_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
            'direct_results' => 0,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'Programmēšana tīmeklī JAVA',
            'name_eng' => 'JAVA programming',
            'LAIS_code' => '123456',
            'kp' => 4,
            'number_of_lectures' => 4,
            'number_of_seminars' => 28,
            'prerequisites' => 'Sekmīgi apgūts objektorientētās programmēšanas kurss',
            'objective' => 'Kursa mērķis ir iepazīstināt studentus ar JAVA programmēšanas tehnoloģijām, sniegt
            izpratni par to pielietošanas iespējām un priekšrocībām.',
            'author_id' => 4,
            'type_of_test_id' => 1,
            'study_program_part_id' => 2,
            'faculty_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
            'direct_results' => 0,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'Matemātiskā analīze',
            'name_eng' => 'Mathematical analysis',
            'LAIS_code' => '123464',
            'kp' => 4,
            'number_of_lectures' => 16,
            'number_of_seminars' => 16,
            'prerequisites' => 'Matemātika vidusskolas programmas apjomā',
            'objective' => 'Iepazīstināt ar matemātiskās analīzes pamatmetodēm un lietojumiem dažādu procesu pētīšanā.',
            'author_id' => 2,
            'type_of_test_id' => 1,
            'study_program_part_id' => 8,
            'faculty_id' => 1,
            'created_at' => $now,
            'updated_at' => $now,
            'direct_results' => 0,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'Tulkošanas kurss 1',
            'name_eng' => 'Translating course 1',
            'LAIS_code' => '123464',
            'kp' => 4,
            'number_of_lectures' => 16,
            'number_of_seminars' => 16,
            'prerequisites' => 'Priekšnosacījumi tulkošanas kursam 1',
            'objective' => 'Tulkošanas kursa 1 mērķis',
            'author_id' => 2,
            'type_of_test_id' => 1,
            'study_program_part_id' => 8,
            'faculty_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'Tulkošanas kurss 2',
            'name_eng' => 'Translating course 2',
            'LAIS_code' => '123464',
            'kp' => 4,
            'number_of_lectures' => 16,
            'number_of_seminars' => 16,
            'prerequisites' => 'Priekšnosacījumi tulkošanas kursam 2',
            'objective' => 'Tulkošanas kursa 2 mērķis',
            'author_id' => 2,
            'type_of_test_id' => 1,
            'study_program_part_id' => 8,
            'faculty_id' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'C kurss 1',
            'name_eng' => 'C course 1',
            'LAIS_code' => '123464',
            'kp' => 2,
            'number_of_lectures' => 16,
            'number_of_seminars' => 0,
            'prerequisites' => 'Priekšnosacījumi C kursam 1',
            'objective' => 'C kursa 1 mērķis',
            'author_id' => 2,
            'type_of_test_id' => 2,
            'study_program_part_id' => 8,
            'faculty_id' => 0,
            'created_at' => $now,
            'updated_at' => $now,
            'c_course' => 1,
        ]);
        DB::table('study_courses')->insert([
            'name' => 'C kurss 2',
            'name_eng' => 'C course 2',
            'LAIS_code' => '123464',
            'kp' => 2,
            'number_of_lectures' => 16,
            'number_of_seminars' => 0,
            'prerequisites' => 'Priekšnosacījumi C kursam 2',
            'objective' => 'C kursa 2 mērķis',
            'author_id' => 2,
            'type_of_test_id' => 2,
            'study_program_part_id' => 8,
            'faculty_id' => 0,
            'created_at' => $now,
            'updated_at' => $now,
            'c_course' => 1,
        ]);

        DB::table('independent_tasks')->insert([
            'task' => 'regulāru studiju kursa vielas apgūšanu, izmantojot lekciju materiālus, mācību literatūru, interneta resursus',
            'study_course_id' => 1]);
        DB::table('independent_tasks')->insert(['task' => 'mājas darbu izpildi', 'study_course_id' => 1]);
        DB::table('independent_tasks')->insert(['task' => 'kursa darba izstrādi', 'study_course_id' => 1]);
        DB::table('independent_tasks')->insert(['task' => 'gatavošanos kontroldarbiem un eksāmenam', 'study_course_id' => 1]);
        DB::table('independent_tasks')->insert([
            'task' => 'Regulāra studiju kursa vielas apgūšana, izmantojot lekcijas materiālus, mācību literatūru, interneta resursus',
            'study_course_id' => 2]);
        DB::table('independent_tasks')->insert(['task' => 'Laboratorijas darbu izstrāde', 'study_course_id' => 2]);
        DB::table('independent_tasks')->insert(['task' => 'Iknedēļas pasniedzējas konsultācijas', 'study_course_id' => 2]);
        DB::table('independent_tasks')->insert([
            'task' => 'Regulāra studiju kursa vielas apgūšana, izmantojot lekcijas materiālus, mācību literatūru, interneta resursus',
            'study_course_id' => 3]);
        DB::table('independent_tasks')->insert(['task' => 'Regulāra mājas uzdevumu izpildīšana', 'study_course_id' => 3]);
        DB::table('independent_tasks')->insert(['task' => 'Iknedēļas pasniedzēja konsultācijas', 'study_course_id' => 3]);
        DB::table('independent_tasks')->insert(['task' => 'Gatavošanās eksāmenam', 'study_course_id' => 3]);
        DB::table('independent_tasks')->insert(['task' => 'Regulāra mājas darbu izpilde', 'study_course_id' => 4]);
        DB::table('independent_tasks')->insert(['task' => 'Gatavošanās kontroldarbiem un eksāmenam', 'study_course_id' => 4]);
        DB::table('independent_tasks')->insert(['task' => 'Regulāra mājas darbu izpilde', 'study_course_id' => 5]);
        DB::table('independent_tasks')->insert(['task' => 'Gatavošanās kontroldarbiem un eksāmenam', 'study_course_id' => 5]);
        DB::table('independent_tasks')->insert(['task' => 'Regulāra mājas darbu izpilde', 'study_course_id' => 6]);
        DB::table('independent_tasks')->insert(['task' => 'Gatavošanās kontroldarbiem un eksāmenam', 'study_course_id' => 6]);
        DB::table('independent_tasks')->insert(['task' => 'Regulāra mājas darbu izpilde', 'study_course_id' => 7]);
        DB::table('independent_tasks')->insert(['task' => 'Gatavošanās kontroldarbiem un eksāmenam', 'study_course_id' => 7]);

        DB::table('basic_literatures')->insert([
            'name' => 'J.Sharp, Microsoft Visual C# Step by Step (9th Edition) (Developer Reference),
            Microsoft Press, ISBN-13: 978-1509307760, ISBN-10: 1509307761, July 2018',
            'study_course_id' => 1
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Andrew Troelsen, Pro C# 7: With .NET and .NET Core 8th ed. Edition,
            Professional Apress, ISBN-13: 978-1484230176, ISBN-10: 1484230175, November 2017',
            'study_course_id' => 1
        ]);
        DB::table('basic_literatures')->insert([
            'name' => "'Learning Java, 4th Edition', Patrick Niemeyer, Daniel Leuck, O'Reilly Media, ISBN: 144-9-319-246",
            'study_course_id' => 2
        ]);
        DB::table('basic_literatures')->insert([
            'name' => "'Effective Java Second Edition', Joshua Bloch, Prentice Hall, ISBN:978-0-321-35668-0",
            'study_course_id' => 2
        ]);
        DB::table('basic_literatures')->insert([
            'name' => "'Java How to Program, 7th Edition', H.M.Deitel, Prentice Hall, ISBN:0132222205",
            'study_course_id' => 2
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Kārlis Šteiners. Augstākā matemātika III. - Zvaigzne ABC, 1998',
            'study_course_id' => 3
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Kārlis Šteiners. Augstākā matemātika IV. - Zvaigzne ABC, 1999',
            'study_course_id' => 3
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Kārlis Šteiners. Augstākā matemātika VI. - Zvaigzne ABC, 2001',
            'study_course_id' => 3
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Inta Volodko. Augstākā matemātika. Īss teorijas izklāsts, uzdevumu risinājumu paraugi. Divas daļas - Zvaigzne ABC, 2007',
            'study_course_id' => 3
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 1',
            'study_course_id' => 4
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 2',
            'study_course_id' => 4
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 1',
            'study_course_id' => 5
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 1',
            'study_course_id' => 6
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 2',
            'study_course_id' => 6
        ]);
        DB::table('basic_literatures')->insert([
            'name' => 'Pamatliteratūra 1',
            'study_course_id' => 7
        ]);

        DB::table('additional_literatures')->insert([
            'name' => 'Anders Hejlsberg, Mads Torgersen, Scott Wiltamuth, Peter Golde, C#
            Programming Language, The 4th Edition, Courier in Westford, Massachusetts, 2010',
            'study_course_id' => 1
        ]);
        DB::table('additional_literatures')->insert([
            'name' => 'Jesse Liberty, Programming C#. Building .NEt applications, O Reilly Media, 2001',
            'study_course_id' => 1
        ]);
        DB::table('additional_literatures')->insert([
            'name' => 'A.Harris, Microsoft C# Programming for the absolute beginner, Series Edition, Premier Press, 2002',
            'study_course_id' => 1
        ]);
        DB::table('additional_literatures')->insert([
            'name' => 'Eric Brown, Windows Forms programming with C#, Hanning Publications Co., 2002',
            'study_course_id' => 1
        ]);
        DB::table('additional_literatures')->insert([
            'name' => "'Core Web Programming, Second Edition', Marty Hall, Larry Brown, Prentice Hall, ISBN: 978-0-13-089793-0",
            'study_course_id' => 2
        ]);
        DB::table('additional_literatures')->insert([
            'name' => "'Pro Java Programming, Second Edition ', Brett Spell, ISBN:1-59059-474-6",
            'study_course_id' => 2
        ]);
        DB::table('additional_literatures')->insert([
            'name' => "'The Complete Reference JAVA, Seventh Edition', Herbert Schildt, Mc Graw Hill Companies, ISBN: 978-0-07-163177-8",
            'study_course_id' => 2
        ]);
        DB::table('additional_literatures')->insert([
            'name' => 'Andrew Browder. Mathematical Analysis. – Springer, 2001',
            'study_course_id' => 3
        ]);
        DB::table('additional_literatures')->insert([
            'name' => 'Erwin Kreyszig. Advanced Engineering Mathematics.- John Wiley & SONS, INC, 1999',
            'study_course_id' => 3
        ]);

        DB::table('other_information_sources')->insert([
            'name' => 'Microsoft Developer Network (MSDN), C# Tutorials: http://msdn.microsoft.com/en-us/library/aa288436%28v=vs.71%29.aspx',
            'study_course_id' => 1
        ]);
        DB::table('other_information_sources')->insert([
            'name' => 'Working with C#: https://code.visualstudio.com/docs/languages/csharp',
            'study_course_id' => 1
        ]);
        DB::table('other_information_sources')->insert([
            'name' => 'The JAVA Tutorial website: http://download.oracle.com/javase/tutorial/index.html',
            'study_course_id' => 2
        ]);
        DB::table('other_information_sources')->insert([
            'name' => 'Web developer information website: http://www.w3schools.com/',
            'study_course_id' => 2
        ]);
        DB::table('other_information_sources')->insert([
            'name' => 'Vitolds Gedroics. Viena argumenta funkciju diferenciālrēķini. Daugavpils universitāte, 2002 http://www.de.dau.lv/matematika/ievmatanavit2ht/index.html',
            'study_course_id' => 3
        ]);
        DB::table('other_information_sources')->insert([
            'name' => 'Vitolds Gedroics. Viena argumenta funkciju integrālrēķini. Daugavpils universitāte, 2002. http://www.de.dau.lv/matematika/int1ht/index.html',
            'study_course_id' => 3
        ]);


        DB::table('study_course_results')->insert([
            'result' => 'Prot veidot, kompilēt un palaist objektorientētas C# programmas, izmantojot MS Visual Studio',
            'study_course_id' => 1
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Spēj rakstīt un izprast C# valodas konstrukcijas, izmantojot pareizo sintaksi un semantiku',
            'study_course_id' => 1
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Izpratne par paraugprakses pieejām programmēšanai un izņēmumu apstrādi, izmantojot C# valodu',
            'study_course_id' => 1
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Prot piekļūt datu bāzēm, izmantojot valodu integrētu vaicājumu (LINQ)',
            'study_course_id' => 1
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Prot atkārtot, pārbaudīt, optimizēt un dokumentēt pašrakstīto programmatūru',
            'study_course_id' => 1
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Pēc šī kursa sekmīgas apguves studentiem ir jābūt zināšanām par programmēšanas valodu JAVA',
            'study_course_id' => 2
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'ir jābūt izpratnei par JAVA pielietošanas iespējām un priekšrocībām',
            'study_course_id' => 2
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'studentiem jābūt spējīgiem izstrādāt aplikācijas par kursa saturā apskatītajām tēmām.',
            'study_course_id' => 2
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'Pēc šī kursa sekmīgas apguves studenti būs spējīgi:
            parādīt svarīgāko jēdzienu un likumsakarību izpratni;',
            'study_course_id' => 3
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'risināt matemātiskās analīzes standarta uzdevumus (atrast funkcijas robežu, atvasināt funkcijas, integrēt funkcijas,
            konstruēt funkcijas grafiku u.c.);',
            'study_course_id' => 3
        ]);
        DB::table('study_course_results')->insert([
            'result' => 'pielietot teorētiskās zināšanas praktisko uzdevumu risināšanā.',
            'study_course_id' => 3
        ]);

        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 1, 'study_program_result_id' => 2]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 1, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 2, 'study_program_result_id' => 2]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 2, 'study_program_result_id' => 4]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 2, 'study_program_result_id' => 5]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 2, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 3, 'study_program_result_id' => 2]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 3, 'study_program_result_id' => 4]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 3, 'study_program_result_id' => 5]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 3, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 3, 'study_program_result_id' => 12]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 4, 'study_program_result_id' => 3]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 5, 'study_program_result_id' => 4]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 5, 'study_program_result_id' => 5]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 5, 'study_program_result_id' => 12]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 5, 'study_program_result_id' => 13]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 6, 'study_program_result_id' => 1]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 6, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 7, 'study_program_result_id' => 1]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 7, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 8, 'study_program_result_id' => 1]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 8, 'study_program_result_id' => 2]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 8, 'study_program_result_id' => 3]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 8, 'study_program_result_id' => 9]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 8, 'study_program_result_id' => 12]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 9, 'study_program_result_id' => 2]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 9, 'study_program_result_id' => 10]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 9, 'study_program_result_id' => 14]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 10, 'study_program_result_id' => 10]);
        DB::table('study_course_result_study_program_result')->insert(['study_course_result_id' => 11, 'study_program_result_id' => 10]);
        
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj strādāt ar MS Visual Studio, .NET vidi un C# programmēšanas valodu; un izpratni par to pielietošanas iespējām',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj identificēt uzdevumus, kurus var izpildīt, izmantojot MS Visual Studio',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Prot izmantot grafiskā lietotāja interfeisa (GUI) komponentes',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj izveidot GUI lietojumprogrammas, XAML valodu',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj veidot savu projektu izmantojot MS Visual Studio un pielietot iegūtās zināšanas no citiem kursiem praksē',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj izmantot OOP pieeju; pielāgot sarežģītāku programmu fragmentus un izmantot esošās bibliotēkas, lai sasniegtu vēlamo uzvedību',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Spēj izstrādāt atkārtoti izmantojamus .NET komponentus, izmantojot saskarnes realizāciju un standarta dizaina modeļus',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Prot piesaistīt galvenās nosaukumu telpas un klases .NET Framework',
            'study_course_id' => 1
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Tulkošanas studiju kursa rezultāts 1',
            'study_course_id' => 4
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Tulkošanas studiju kursa rezultāts 2',
            'study_course_id' => 4
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Tulkošanas studiju kursa rezultāts 3',
            'study_course_id' => 4
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Tulkošanas studiju kursa rezultāts 1',
            'study_course_id' => 5
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'Tulkošanas studiju kursa rezultāts 2',
            'study_course_id' => 5
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'C kursa studiju rezultāts 1',
            'study_course_id' => 6
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'C kursa studiju rezultāts 2',
            'study_course_id' => 6
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'C kursa studiju rezultāts 1',
            'study_course_id' => 7
        ]);
        DB::table('additional_study_course_results')->insert([
            'result' => 'C kursa studiju rezultāts 2',
            'study_course_id' => 7
        ]);

        DB::table('evaluations')->insert([
            'percent' => 20,
            'type_of_evaluation' => 'Grupas projekts un mājasdarbi',
            'study_course_id' => 1
        ]);
        DB::table('evaluations')->insert([
            'percent' => 20,
            'type_of_evaluation' => 'Testi',
            'study_course_id' => 1
        ]);
        DB::table('evaluations')->insert([
            'percent' => 20,
            'type_of_evaluation' => 'Kursa darbs',
            'study_course_id' => 1
        ]);
        DB::table('evaluations')->insert([
            'percent' => 40,
            'type_of_evaluation' => 'Eksāmens',
            'study_course_id' => 1
        ]);
        DB::table('evaluations')->insert([
            'percent' => 50,
            'type_of_evaluation' => 'eksāmens/kursa darbs',
            'study_course_id' => 2
        ]);
        DB::table('evaluations')->insert([
            'percent' => 10,
            'type_of_evaluation' => 'teorētisko testu vidējā atzīme',
            'study_course_id' => 2
        ]);
        DB::table('evaluations')->insert([
            'percent' => 20,
            'type_of_evaluation' => 'praktisko mājas darbu vidējā atzīme',
            'study_course_id' => 2
        ]);
        DB::table('evaluations')->insert([
            'percent' => 20,
            'type_of_evaluation' => 'praktisko kontroldarbu vidējā atzīme',
            'study_course_id' => 2
        ]);
        DB::table('evaluations')->insert([
            'percent' => 30,
            'type_of_evaluation' => 'semestra vidējā atzīme',
            'study_course_id' => 3
        ]);
        DB::table('evaluations')->insert([
            'percent' => 70,
            'type_of_evaluation' => 'eksāmena atzīme',
            'study_course_id' => 3
        ]);
        DB::table('evaluations')->insert([
            'percent' => 30,
            'type_of_evaluation' => 'semestra vidējā atzīme',
            'study_course_id' => 4
        ]);
        DB::table('evaluations')->insert([
            'percent' => 70,
            'type_of_evaluation' => 'eksāmena atzīme',
            'study_course_id' => 4
        ]);
        DB::table('evaluations')->insert([
            'percent' => 30,
            'type_of_evaluation' => 'semestra vidējā atzīme',
            'study_course_id' => 5
        ]);
        DB::table('evaluations')->insert([
            'percent' => 70,
            'type_of_evaluation' => 'eksāmena atzīme',
            'study_course_id' => 5
        ]);
        DB::table('evaluations')->insert([
            'percent' => 100,
            'type_of_evaluation' => 'ieskaites darbs (tests)',
            'study_course_id' => 6
        ]);
        DB::table('evaluations')->insert([
            'percent' => 100,
            'type_of_evaluation' => 'ieskaites darbs (tests)',
            'study_course_id' => 7
        ]);

        DB::table('study_course_subjects')->insert([
            'subject' => 'Ievads Visual Studio kā izstrādes platformā',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Grafiskās lietotāja saskarnes (GUI) reālās pasaules lietojumprogrammās',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Darbs ar C# projektiem, OOP un GUI izstrāde',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Darbs ar 2D / 3D grafiku. Canvas, 2D / 3D objekti. OpenGL pamati',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Video un sensora datu apstrāde un visualisācija',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Lietojumprogrammu atkļūdošana un testēšana',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Darbs ar datiem. Datu bāzu integrēšana un izmantošana',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Paralēlizācijas metodes un paralēlie skaitļošanas pamati',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tīmekļa lietojumprogrammu izstrāde',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Inovatīvu GUI lietojumprogrammu izveide reālās pasaules problēmu risināšanai (komandas darba projekts).',
            'study_course_id' => 1
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Objektorientētās programmēšanas pamatu atkārtojums',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Grafiskā interfeisa izveide un ievades/izvades straumes',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Pavedienošana',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tīklošana',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Savienojuma veidošana ar datubāzēm',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'JSP, HTML un JavaScript',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Versiju kontrole un testēšana',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Android - mobilās aplikācijas',
            'study_course_id' => 2
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'IEVADS MATEMĀTISKAJĀ ANALĪZĒ',
            'study_course_id' => 3
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'VIENA ARGUMENTA FUNKCIJU DIFERENCIĀLRĒĶINI',
            'study_course_id' => 3
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'VIENA ARGUMENTA FUNKCIJU INTEGRĀLRĒĶINI',
            'study_course_id' => 3
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'SKAITĻU RINDAS',
            'study_course_id' => 3
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 1',
            'study_course_id' => 4
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 2',
            'study_course_id' => 4
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 3',
            'study_course_id' => 4
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 1',
            'study_course_id' => 5
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 2',
            'study_course_id' => 5
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 3',
            'study_course_id' => 5
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 1',
            'study_course_id' => 6
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 2',
            'study_course_id' => 6
        ]);
        DB::table('study_course_subjects')->insert([
            'subject' => 'Tēma 1',
            'study_course_id' => 7
        ]);

        DB::table('calendar_plans')->insert([
            'lecture_num' => '1.',
            'subject' => 'Ievads Visual Studio kā izstrādes platformā',
            'type_of_lecture' => '2 lekcijas, 2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '2.',
            'subject' => 'Grafiskās lietotāja saskarnes (GUI) reālās pasaules lietojumprogrammās',
            'type_of_lecture' => '2 lekcijas, 2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3.',
            'subject' => 'Darbs ar C# projektiem, OOP un GUI izstrāde',
            'type_of_lecture' => '2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '4.',
            'subject' => 'Darbs ar 2D / 3D grafiku. Canvas, 2D / 3D objekti. OpenGL pamati',
            'type_of_lecture' => '1 lekcija, 2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '5.',
            'subject' => 'Video un sensora datu apstrāde un visualisācija',
            'type_of_lecture' => '1 lekcija, 2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '6.',
            'subject' => 'Lietojumprogrammu atkļūdošana un testēšana',
            'type_of_lecture' => '1 lekcija, 1 seminārs',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '7.',
            'subject' => 'Darbs ar datiem. Datu bāzu integrēšana un izmantošana',
            'type_of_lecture' => '2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '8.',
            'subject' => 'Paralēlizācijas metodes un paralēlie skaitļošanas pamati',
            'type_of_lecture' => '1 lekcija, 2 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '9.',
            'subject' => 'Tīmekļa lietojumprogrammu izstrāde',
            'type_of_lecture' => '3 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '10.',
            'subject' => 'Inovatīvu GUI lietojumprogrammu izveide reālās pasaules problēmu risināšanai (komandas darba projekts).',
            'type_of_lecture' => '6 semināri',
            'study_course_id' => 1
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1',
            'subject' => 'Objektorientētās programmēšanas pamatu atkārtojums: Mainīgo tipi, programmas uzbūve,
            pamata komandas, operatori; Mantošana, interfeisi, polimorfisms; Izņēmumu apstrāde;',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 2
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '2',
            'subject' => 'Grafiskā interfeisa izveide un ievades/izvades straumes',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 2
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3',
            'subject' => 'Pavedienošana',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 2
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '4',
            'subject' => 'Tīklošana',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 2
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1',
            'subject' => '1. IEVADS MATEMĀTISKAJĀ ANALĪZĒ.
            1.1. Reālie skaitļi. Reālo skaitļu kopa R. Reālo skaitļu
            ģeometriskā interpretācija. Reālā skaitļa modulis. Intervāli.
            Apkārtnes.
            1.2. Funkcijas. Funkcijas jēdziens. Funkciju kompozīcija.
            Apvērstā funkcija. Ierobežotas un neierobežotas, pāra un
            nepāra, periodiskas un neperiodiskas funkcijas. Funkcijas
            grafiks. Skaitļu virknes.',
            'type_of_lecture' => '1 lekcija un 1 praktiskā nodarbība',
            'study_course_id' => 3
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '2',
            'subject' => '1.3. Robeža. Virknes un funkcijas robežas jēdziens.
            Robežas vienīgums. Summas, reizinājuma un dalījuma
            robeža. Funkciju kompozīcijas robeža. Robežpāreja
            nevienādībās. Vienpusējās robežas. Bezgalīgi mazas
            funkcijas un to salīdzināšana. Bezgalīgi lielas funkcijas.
            Ievērojamās robežas. Skaitļu virknes konverģence.',
            'type_of_lecture' => '1 lekcija un 1 praktiskā nodarbība',
            'study_course_id' => 3
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3',
            'subject' => '1.4. Nepārtrauktība. Funkcijas nepārtrauktība punktā.
            Summas, reizinājuma un dalījuma nepārtrauktība. Pāreja
            pie robežas zem nepārtrauktas funkcijas zīmes. Funkciju
            kompozīcijas nepārtrauktība. Pārtraukuma punkti.
            Nepārtrauktu funkciju īpašības.',
            'type_of_lecture' => '1 lekcija un 1 praktiskā nodarbība',
            'study_course_id' => 3
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '4',
            'subject' => '2. VIENA ARGUMENTA FUNKCIJU DIFERENCIĀLRĒĶINI.
            2.1. Atvasinājums un diferenciālis. Funkcijas
            diferencējamība. Atvasinājums un diferenciālis, to
            ģeometriskā un mehāniskā interpretācija. Diferencējamas
            funkcijas nepārtrauktība. Summas, reizinājuma un dalījuma
            diferencēšana.',
            'type_of_lecture' => '1 lekcija un 1 praktiskā nodarbība',
            'study_course_id' => 3
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1. un 2.',
            'subject' => 'Tēma 1',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 4
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3. un 4.',
            'subject' => 'Tēma 2',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 4
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '5. un 6.',
            'subject' => 'Tēma 3',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 4
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1. un 2.',
            'subject' => 'Tēma 1',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 5
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1. un 2.',
            'subject' => 'Tēma 1',
            'type_of_lecture' => '2 lekcijas',
            'study_course_id' => 6
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3. un 4.',
            'subject' => 'Tēma 2',
            'type_of_lecture' => 'Lekcija un praktiskā nodarbība',
            'study_course_id' => 6
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '1. un 2.',
            'subject' => 'Tēma 1',
            'type_of_lecture' => '2 lekcijas',
            'study_course_id' => 7
        ]);
        DB::table('calendar_plans')->insert([
            'lecture_num' => '3. un 4.',
            'subject' => 'Tēma 2',
            'type_of_lecture' => '2 lekcijas',
            'study_course_id' => 7
        ]);

        DB::table('study_course_study_program')->insert(['study_course_id' => 1, 'study_program_id' => 1]);
        DB::table('study_course_study_program')->insert(['study_course_id' => 2, 'study_program_id' => 1]);
        DB::table('study_course_study_program')->insert(['study_course_id' => 3, 'study_program_id' => 1]);
        DB::table('study_course_study_program')->insert(['study_course_id' => 3, 'study_program_id' => 4]);
        DB::table('study_course_study_program')->insert(['study_course_id' => 4, 'study_program_id' => 12]);
        DB::table('study_course_study_program')->insert(['study_course_id' => 5, 'study_program_id' => 12]);
        
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 1, 'study_program_result_id' => 2]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 1, 'study_program_result_id' => 9]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 1, 'study_program_result_id' => 12]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 2, 'study_program_result_id' => 1]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 2, 'study_program_result_id' => 2]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 2, 'study_program_result_id' => 3]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 2, 'study_program_result_id' => 9]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 2, 'study_program_result_id' => 12]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 3, 'study_program_result_id' => 10]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 3, 'study_program_result_id' => 15]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 4, 'study_program_result_id' => 31]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 4, 'study_program_result_id' => 32]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 4, 'study_program_result_id' => 35]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 5, 'study_program_result_id' => 32]);
        DB::table('study_course_study_program_result')->insert(['study_course_id' => 5, 'study_program_result_id' => 36]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('faculties')->delete();
        DB::table('study_directions')->delete();
        DB::table('study_programs')->delete();
        DB::table('study_program_results')->delete();
        DB::table('lecturers')->delete();
        DB::table('type_of_tests')->delete();
        DB::table('study_program_parts')->delete();
        DB::table('study_courses')->delete();
        DB::table('independent_tasks')->delete();
        DB::table('basic_literatures')->delete();
        DB::table('additional_literatures')->delete();
        DB::table('other_information_sources')->delete();
        DB::table('study_course_results')->delete();
        DB::table('evaluations')->delete();
        DB::table('study_course_subjects')->delete();
        DB::table('calendar_plans')->delete();
        DB::table('study_course_study_program')->delete();
        DB::table('study_course_study_program_result')->delete();
    }
}
