@extends('layouts.app')

@section('content')
        <h1>Studiju kursa pievienošana</h1>
        <br><a href="/courses" class ="btn btn-primary">Atpakaļ</a><br><br>
        
        <button class ="btn btn-primary" onclick="showDiv('fileUploadFormDiv')">Pievienot aprakstu augšupielādējot kursa apraksta failu</button><br><br>
        <div id="fileUploadFormDiv" style="display:none;">
            <p>Augšupielādējiet .pdf vai .docx formāta kursa apraksta failu (labākam rezultātam ieteicams .docx), nospiežot pogu 'Browse' un pēc tam izvēloties augšupielādējamo failu.</p>
            <p class="text-danger">Uzmanību! Failu augšupielāde un apstrāde (automātiska informācijas nolasīšana) šobrīd darbojas testa režīmā.
                Ir iespējamas kļūdas. Faila automātiskās nolasīšanas rezultāts atkarīgs no augšupielādētā kursa apraksta faila - jo precīzāk standartam aizpildīts fails, 
                jo lielāka varbūtība, ka faila nolasīšana būs veiksmīga. Pat nelielas atšķirības no kursu aprakstu standarta var izraisīt daļēju vai 
                pilnīgi nesekmīgu faila automātisku nolasīšanu. Dažus failus vispār neizdodas nolasīt (šobrīd nav zināms iemesls).
                Atsevišķi ievades lauki var netikt nolasīti. Studiju rezultātus nepieciešams definēt manuāli.
            </p>
            {!! Form::open(['action' => 'StudyCoursesController@uploadFile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::file('uploaded_file')}}
                </div>
                {{Form::submit('Augšupielādēt failu', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
            <br><br>
        </div>
        {!! Form::open(['action' => 'StudyCoursesController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                
                <input type="checkbox" name="c_courses_chbox" id="c_courses_chbox" onclick="c_courses_chbox_change()"> Brīvās izvēles studiju kurss (C kurss)<br><br>
                <input type="checkbox" name="eng_chbox" id="eng_chbox" onclick="eng_chbox_change()"> Studiju kursa apraksts angļu valodā (atzīmējiet, ja aizpildīsiet ievades laukus ar informāciju angļu valodā)<br><br>
                <div id="select_faculty_and_program">
                    {{Form::label('faculty_label', 'Norādiet, kurai fakultātei pieder šis studiju kurss')}}
                    {{Form::select('faculty', $faculties, null, ['class' => 'form-control'])}}<br><br>
                    {{Form::label('study_program_label', 'Norādiet, kurai / kurām studiju programmām pieder šis studiju kurss')}}
                    {{Form::select('study_program[]', $study_programs, null, ['size' => '6', 'id' => 'study_program', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                    <br><p>* Ja nepieciešams norādīt vairākas studiju programmas, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju programmām</p>
                </div>

                {{Form::label('course_name_label', 'Nosaukums')}}
                {{Form::text('course_name', '', ['class' => 'form-control', 'placeholder' => 'Nosaukums'])}}<br><br>
                <div id="course_name_eng_input">
                    {{Form::label('course_name_eng_label', 'Nosaukums angļu valodā')}}
                    {{Form::text('course_name_eng', '', ['class' => 'form-control', 'placeholder' => 'Nosaukums angļu valodā'])}}<br><br>
                </div>
                {{Form::Label('lecturer_label', 'Pasniedzējs:')}}
                {{Form::select('lecturers[]', $lecturers, null, ['size' => '10', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                <br><p>* Ja nepieciešams norādīt vairākus pasniedzējus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju programmām</p><br><br>
                {{Form::label('LAIS_code_label', 'LAIS kods')}}
                {{Form::text('LAIS_code', '', ['class' => 'form-control', 'placeholder' => 'LAIS kods'])}}<br><br>
                {{Form::label('type_of_test_label', 'Pārbaudes forma(veids)')}}
                {{Form::select('type_of_test', $types_of_tests, null, ['class' => 'form-control'])}}<br><br>
                {{Form::label('kp_label', 'Kredītpunkti')}}
                {{Form::text('kp', '', ['class' => 'form-control', 'placeholder' => 'Kredītpunkti'])}}<br><br>
                {{Form::label('number_of_lectures_label', 'Lekciju skaits')}}
                {{Form::text('number_of_lectures', '', ['class' => 'form-control', 'placeholder' => 'Lekciju skaits'])}}<br><br>
                {{Form::label('number_of_seminars_label', 'Praktisko nodarbību skaits')}}
                {{Form::text('number_of_seminars', '', ['class' => 'form-control', 'placeholder' => 'Praktisko nodarbību skaits'])}}<br><br>               
                {{Form::label('prerequisites_label', 'Nepieciešamās zināšanas kursa uzsākšanai')}}
                {{Form::textarea('prerequisites', '', ['class' => 'form-control'])}}<br><br>
                
                {{Form::label('study_program_part_label', 'Studiju programmas daļa')}}
                {{Form::select('study_program_part', $study_program_parts, null, ['class' => 'form-control'])}}<br><br>

                <h3>Studiju kursa mērķis</h3><br>
                {{Form::textarea('objective', '', ['class' => 'form-control'])}}<br><br>

                <h3>Studiju rezultāti</h3><br>
                
                <div id="non_c_course_results">
                    <p><strong>Absolūtā (tiešā) atbilstība</strong> - studiju kursam tiek pievienoti/norādīti studiju rezultāti no saraksta ar studiju programmas 
                        sasniedzamajiem studiju rezultātiem (izvēlas studiju rezultātus no saraksta).
                        Šādā veidā studiju programmas studiju kursu kartējumā redzams, kuri studiju programmas studiju rezultāti tiek īstenoti ar konkrēto
                        studiju kursu.
                    </p>
                    <p><strong>Pielāgotā (saistītā) atbilstība</strong> - studiju kursam tiek pievienoti studiju rezultāti, kuri tiek sasaistīti ar vienu vai vairākiem
                        studiju programmas sasniedzamajiem studiju rezultātiem. Šādā veidā studiju programmas studiju kursu kartējumā redzams, kuri studiju kursa
                        studiju rezultāti īsteno studiju programmas sasniedzamos studiju rezultātus.
                    </p>
                    <br>
                    <p>Lūdzu norādiet studiju rezultātu definēšanas veidu:</p>
                    <input type="radio" name="results_rb" onclick="handleClick(this);" value="direct_results" checked> Absolūtā (tiešā) atbilstība<br>
                    <input type="radio" name="results_rb" onclick="handleClick(this);" value="linked_results"> Pielāgotā (saistītā) atbilstība<br>
                    <br><br>

                    <div id="direct_results">
                        <h3>Izvēlieties no saraksta studiju programmas studiju rezultātus, kurus īsteno šis studiju kurss:</h3><br>
                        {{ Form::select('program_results[]', $study_program_results, null, ['size' => '10', 'id' => 'program_results', 'multiple' => 'multiple', 'class' => 'form-control']) }}
                        <br><p>* Lai izvēlētos vairākus studiju rezultātus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju rezultātiem</p>
                    </div>

                    <div id="linked_results" style="display:none;">
                        <h4>Ievadiet laukā 'Studiju kursa rezultāts' studiju kursa rezultātu un pēc tam norādiet, kuri studiju programmas
                            studiju rezultāti tiek īstenoti ar konkrēto studiju kursa studiju rezultātu (zem katra ievadītā studiju rezultāta atrodas
                            saraksts ar studiju programmas studiju rezultātiem).
                        </h4>
                        <br>
                        {{Form::text('course_results[]', '', ['class' => 'form-control', 'placeholder' => 'Studiju kursa rezultāts'])}}<br>
                        {{Form::select('program_results1[]', $study_program_results, null, ['size' => '10', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                        <br><p>* Lai izvēlētos vairākus studiju rezultātus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju rezultātiem</p>
                        {{Form::hidden('number_of_program_results', 1, ['id' => 'num_of_prog_res'])}}
                        <br>
                        <div id="linked_results_input">
                        </div>
                        <span class="btn btn-outline-dark" onClick="addDefineLinkedResults({{$study_program_results}});">+</span><br>
                    
                    </div>

                    <br><br>
                    <h4>Ja nepieciešams, variet papildus pievienot šim studiju kursam studiju rezultātus, kuri netiek saistīti ar studiju programmas
                            studiju rezultātiem (šie studiju rezultāti tiks attēloti kursa aprakstā, bet netiks attēloti studiju programmas kartējumā)*</h4>
                    <br><p>* Aizpildiet tikai nepieciešamības gadījumā</p>
                </div>
                {{Form::text('additional_course_results[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Studiju kursa rezultāts'])}}<br>
                <div id="additional_course_results_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('additional_course_results_input');">+</span><br>
                
                <br><br>                
                <h3>Studējošo patstāvīgā darba organizācijas veids</h3><br>
                <p>Studentu patstāvīgais darbs ietver:</p>
                {{Form::text('independent_tasks[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Patstāvīgais darbs'])}}<br>
                <div id="independent_tasks_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('independent_tasks_input');">+</span><br>

                <div id="independent_tasks_example" style="display:none;">
                    <br>
                    <h5>Studentu patstāvīgais darbs ietver:</h5>
                    <ul>
                        <li>regulāru studiju kursa vielas apgūšanu, izmantojot lekciju materiālus, mācību literatūru, interneta resursus</li>
                        <li>mājas darbu izpildi</li>
                        <li>kursa darba izstrādi</li>
                        <li>gatavošanos kontroldarbiem un eksāmenam</li>
                    </ul>
                </div>
                <br><button type="button" class="btn btn-outline-dark" id="independent_tasks_btn" onClick="showInputExampleDiv('independent_tasks_example', 'independent_tasks_btn');">Parādīt paraugu</button><br>

                <br><br>               
                <h3>Studiju rezultātu vērtēšana</h3><br>
                <p>Gala rezultātu veido:</p>
                <div class="input-group">
                    {{Form::text('percent[]', '', ['class' => 'form-control col-sm-1', 'placeholder' => '30'])}}
                    <div class="input-group-prepend">
                        <span class="input-group-text">%</span>
                    </div>
                    {{Form::text('evaluation[]', '', ['class' => 'form-control col-9', 'placeholder' => 'Novērtējuma veids'])}}
                </div>
                <br>
                <div id="evaluation_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('evaluation_input');">+</span><br>

                <div id="evaluation_example" style="display:none;">
                    <br>
                    <h5>Gala rezultātu veido:</h5>
                    <ul>
                        <li>Grupas projekts un mājasdarbi 20 %</li>
                        <li>Testi 20 %</li>
                        <li>Kursa darbs 20 %</li>
                        <li>Eksāmens 40 %</li>
                    </ul>
                </div>
                <br><button type="button" class="btn btn-outline-dark" id="evaluation_btn" onClick="showInputExampleDiv('evaluation_example', 'evaluation_btn');">Parādīt paraugu</button><br>

                <br><br>
                <h3>Studiju kursa saturs</h3><br>
                {{Form::text('course_subjects[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Tēmas nosaukums'])}}<br>
                <div id="course_subjects_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('course_subjects_input');">+</span><br>

                <div id="study_course_subjects_example" style="display:none;">
                    <br>
                    <h5>Studiju kursa saturs:</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>N.p.k.</th>
                                <th>Tēmas nosaukums</th>
                            </tr>
                        </thead>
                        <tbody>         
                                <tr>
                                    <td>1.</td>
                                    <td>Ievads Visual Studio kā izstrādes platformā</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Grafiskās lietotāja saskarnes (GUI) reālās pasaules lietojumprogrammās</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Darbs ar C# projektiem, OOP un GUI izstrāde</td>
                                </tr>
                                <tr>
                                    <td>...</td>
                                    <td>...</td>
                                </tr>

                        </tbody>
                    </table>
                </div>
                <br><button type="button" class="btn btn-outline-dark" id="study_course_subjects_btn" onClick="showInputExampleDiv('study_course_subjects_example', 'study_course_subjects_btn');">Parādīt paraugu</button><br>

                <br><br>
                <h3>Studiju kursa kalendārais plāns</h3><br>

                <div class="form-row">
                    <div class="col-2">
                        {{ Form::text('calendar_plan_lecture_num[]', '', ['class' => 'form-control', 'placeholder' => 'Nodarbības numurs']) }}
                    </div>
                    <div class="col-8">
                        {{ Form::textarea('calendar_plan_subject[]', '', ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Tēmas nosaukums']) }}
                    </div>
                    <div class="col">
                        {{ Form::text('calendar_plan_type[]', '', ['class' => 'form-control', 'placeholder' => 'Nodarbības veids']) }}
                    </div>
                </div>
                <br>
                <div id="calendar_plan_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('calendar_plan_input');">+</span><br> 
                <div id="calendar_plan_example" style="display:none;">
                    <br>
                    <h5>Kalendārais plāns:</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nodarbības numurs</th>
                                <th>Tēmas nosaukums</th>
                                <th>Nodarbības veids, akadēmisko stundu skaits</th>
                            </tr>
                        </thead>
                        <tbody>         
                                <tr>
                                    <td>1. - 4.</td>
                                    <td>Ievads Visual Studio kā izstrādes platformā</td>
                                    <td>2 lekcijas, 2 semināri</td>
                                </tr>
                                <tr>
                                    <td>5. un 6.</td>
                                    <td>Grafiskās lietotāja saskarnes (GUI) reālās pasaules lietojumprogrammās</td>
                                    <td>1 lekcija, 1 seminārs</td>
                                </tr>
                                <tr>
                                    <td>7. un 8.</td>
                                    <td>Darbs ar C# projektiem, OOP un GUI izstrāde</td>
                                    <td>2 lekcijas</td>
                                </tr>
                                <tr>
                                    <td>...</td>
                                    <td>...</td>
                                    <td>...</td>
                                </tr>

                        </tbody>
                    </table>
                </div>
                <br><button type="button" class="btn btn-outline-dark" id="calendar_plan_btn" onClick="showInputExampleDiv('calendar_plan_example', 'calendar_plan_btn');">Parādīt paraugu</button><br>

                <br><br>
                <h3>Pamatliteratūra</h3><br>
                {{Form::text('basic_literature[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Pamatliteratūra'])}}<br>
                <div id="basic_literature_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('basic_literature_input');">+</span><br><br>

                <br><h3>Papildliteratūra</h3><br>
                <p>* aizpildiet tikai nepieciešamības gadījumā</p>
                {{Form::text('additional_literature[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Papildliteratūra'])}}<br>
                <div id="additional_literature_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('additional_literature_input');">+</span><br><br>

                <br><h3>Citi informācijas avoti</h3><br>
                <p>* aizpildiet tikai nepieciešamības gadījumā</p>
                {{Form::text('other_information_sources[]', '', ['class' => 'form-control col-10', 'placeholder' => 'Citi informācijas avoti'])}}<br>
                <div id="other_information_sources_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('other_information_sources_input');">+</span><br>

            </div>
            <br><br>
            <p class="text-danger">Pirms pogas 'Pievienot studiju kursu' nospiešanas, lūdzu pārbaudiet, vai pareizi aizpildīti ievades lauki, 
                kā arī, vai obligātie ievades lauki nav atstāti tukši!</p>
            {{Form::submit('Pievienot studiju kursu', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

        <br><a href="/courses" class ="btn btn-primary">Atpakaļ</a><br><br>
@endsection