@extends('layouts.app')

@section('content')
        <h1>Studiju kursa pievienošana</h1>
        <br><a href="/courses" class ="btn btn-primary">Atpakaļ</a><br><br>
        <br><button class="btn btn-outline-dark" id="showFileUploadResultBtn" onClick="showFileUploadResult('showFileUploadResultDiv', 'showFileUploadResultBtn')">Parādīt faila nolasīšanas rezultātus</button><br>

        <div id="showFileUploadResultDiv" style="display: none;">
            <br><br>********************************************************************************************************<br><br>
            @if($course_in_english)
                <p class="text-danger">Kursa apraksts angļu valodā</p>
            @endif
            <strong>Nosaukums :</strong> {{$course_name}}<br>
            @if(!$course_in_english)
                <strong>Nosaukums angļu valodā :</strong> {{$course_name_eng}}<br>
            @endif
            <strong>Autors :</strong> {{$lecturer}}<br>
            <strong>LAIS kods :</strong> {{$LAIS_code}}<br>
            <strong>Parbaudes forma :</strong> {{$type_of_test}}<br>
            <strong>Kredītpunkti :</strong> {{$kp}}<br>
            <strong>Lekciju skaits :</strong> {{$number_of_lectures}}<br>
            <strong>Praktisko nodarbību skaits :</strong> {{$number_of_seminars}}<br>
            <strong>Nepieciešamās zināšanas kursa uzsākšanai:</strong> {{$prerequisites}}<br>
            <strong>Studiju programmas daļa :</strong> {{$study_program_part}}<br>
            <br>
            <strong>Studiju kursa mērķis :</strong> {{$objective}}<br><br>
            <strong>Studiju rezultāti : </strong><br>
            @foreach ($course_results as $course_result)
                {{$course_result}}<br>
            @endforeach
            <br>
            <strong>Studējošo patstāvīgā darba organizācijas veids: </strong><br>
            @foreach ($independent_tasks as $independent_task)
                {{$independent_task}}<br>
            @endforeach
            <br><br>

            <strong>Studiju rezultātu vērtēšana<br>Gala rezultātu veido: </strong><br>
            @foreach ($evaluation as $e)
                {{$e}}<br>
            @endforeach
            <br>
            <strong>Studiju kursa saturs: </strong><br>
            @foreach ($course_subjects as $course_subject)
                {{$course_subject}}<br>
            @endforeach
            <br>
            <strong>Studiju kursa kalendārais plāns </strong><br>
            @foreach ($calendar_plan as $cp)
                {{$cp}}<br>
            @endforeach
            <br>
            <strong>Pamatliteratūra: </strong><br>
            @foreach ($basic_literature as $bl)
                {{$bl}}<br>
            @endforeach
            <br>
            <strong>Papildliteratūra: </strong><br>
            @foreach ($additional_literature as $al)
                {{$al}}<br>
            @endforeach
            <br>
            <strong>Citi informācijas avoti: </strong><br>
            @foreach ($other_information_sources as $ois)
                {{$ois}}<br>
            @endforeach
            <br><br>
            ********************************************************************************************************<br>
        </div>
        <br><br>
        <h4 class="text-danger">Pirms kursa apraksta saglabāšanas lūdzu pārbaudiet ievades laukus, jo iespējamas kļūdas, kas radušās augšupielādētā 
            dokumenta apstrādes procesā.</h4>
        <br><br>
        {!! Form::open(['action' => 'StudyCoursesController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                
                <input type="checkbox" name="c_courses_chbox" id="c_courses_chbox" onclick="c_courses_chbox_change()"> Brīvās izvēles studiju kurss<br><br>
                @if($course_in_english)
                    <input type="checkbox" name="eng_chbox" checked id="eng_chbox" onclick="eng_chbox_change()"> Studiju kursa apraksts angļu valodā (atzīmējiet, ja aizpildīsiet ievades laukus ar informāciju angļu valodā)<br><br>
                @else
                    <input type="checkbox" name="eng_chbox" id="eng_chbox" onclick="eng_chbox_change()"> Studiju kursa apraksts angļu valodā (atzīmējiet, ja aizpildīsiet ievades laukus ar informāciju angļu valodā)<br><br>
                @endif
                <div id="select_faculty_and_program">
                    {{Form::label('faculty_label', 'Norādiet, kurai fakultātei pieder šis studiju kurss')}}
                    {{Form::select('faculty', $faculties, null, ['class' => 'form-control'])}}<br><br>
                    {{Form::label('study_program_label', 'Norādiet, kurai / kurām studiju programmām pieder šis studiju kurss')}}
                    {{Form::select('study_program[]', $study_programs, null, ['size' => '6', 'id' => 'study_program', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                    <br><p>* Ja nepieciešams norādīt vairākas studiju programmas, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju programmām</p>
                </div>

                {{Form::label('course_name_label', 'Nosaukums')}}
                {{Form::text('course_name', $course_name, ['class' => 'form-control', 'placeholder' => 'Nosaukums'])}}<br><br>
                @if($course_in_english)
                    <div id="course_name_eng_input" style="display:none;">
                @else
                    <div id="course_name_eng_input">
                @endif
                        {{Form::label('course_name_eng_label', 'Nosaukums angļu valodā')}}
                        {{Form::text('course_name_eng', '', ['class' => 'form-control', 'placeholder' => 'Nosaukums angļu valodā'])}}<br><br>
                    </div>
                {{Form::Label('lecturer_label', 'Pasniedzējs:')}}
                <p>Lūdzu atzīmējiet pasniedzēju: <strong>{{$lecturer}}</strong></p>
                {{Form::select('lecturers[]', $lecturers, null, ['size' => '10', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                <br><p>* Ja nepieciešams norādīt vairākus pasniedzējus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju programmām</p><br><br>
                {{Form::label('LAIS_code_label', 'LAIS kods')}}
                {{Form::text('LAIS_code', $LAIS_code, ['class' => 'form-control', 'placeholder' => 'LAIS kods'])}}<br><br>
                {{Form::label('type_of_test_label', 'Pārbaudes forma (veids)')}}
                <p>Lūdzu atzīmējiet pārbaudes formu:<strong> {{$type_of_test}} </strong></p>
                {{Form::select('type_of_test', $types_of_tests, null, ['class' => 'form-control'])}}<br><br>
                {{Form::label('kp_label', 'Kredītpunkti')}}
                {{Form::text('kp', $kp, ['class' => 'form-control', 'placeholder' => 'Kredītpunkti'])}}<br><br>
                {{Form::label('number_of_lectures_label', 'Lekciju skaits')}}
                {{Form::text('number_of_lectures', $number_of_lectures, ['class' => 'form-control', 'placeholder' => 'Lekciju skaits'])}}<br><br>
                {{Form::label('number_of_seminars_label', 'Praktisko nodarbību skaits')}}
                {{Form::text('number_of_seminars', $number_of_seminars, ['class' => 'form-control', 'placeholder' => 'Praktisko nodarbību skaits'])}}<br><br>               
                {{Form::label('prerequisites_label', 'Nepieciešamās zināšanas kursa uzsākšanai')}}
                {{Form::textarea('prerequisites', $prerequisites, ['class' => 'form-control'])}}<br><br>
                
                {{Form::label('study_program_part_label', 'Studiju programmas daļa')}}
                <p>Lūdzu atzīmējiet studiju programmas daļu:<strong> {{$study_program_part}} </strong></p>
                {{Form::select('study_program_part', $study_program_parts, null, ['class' => 'form-control'])}}<br><br>

                <br><h3>Studiju kursa mērķis</h3><br>
                {{Form::textarea('objective', $objective, ['class' => 'form-control'])}}<br><br>
                
                <h3>Studiju rezultāti</h3><br>

                @foreach($course_results as $cr)
                    {{$cr}}<br>
                @endforeach
                <br><br>
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
                        {{Form::select('program_results1[]', $study_program_results, null, ['size' => '10', 'id' => 'program_resultsss', 'multiple' => 'multiple', 'class' => 'form-control'])}}
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
                @php
                    $additional_course_result_counter = 0;
                @endphp
                @foreach($course_results as $course_result)
                    @if(!empty($course_result))
                        <div id='additional_course_result{{++$additional_course_result_counter}}'>
                            <div class='form-row'>
                                {{Form::text('additional_course_results[]', $course_result, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('additional_course_result{{$additional_course_result_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
                <div id="additional_course_results_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('additional_course_results_input');">+</span><br>
               
                <br><br>                
                <h3>Studējošo patstāvīgā darba organizācijas veids</h3><br>
                <p>Studentu patstāvīgais darbs ietver:</p>
                @php
                    $independent_task_counter = 0;
                @endphp
                @foreach($independent_tasks as $independent_task)
                    @if(!empty($independent_task))
                        <div id='independent_task{{++$independent_task_counter}}'>
                            <div class='form-row'>
                                {{Form::text('independent_tasks[]', $independent_task, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('independent_task{{$independent_task_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
                <br>
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
                @php
                    $evaluation_counter = 0;
                @endphp
                @foreach($evaluation as $e)
                    @if(!empty($e))
                        <div id='evaluation{{++$evaluation_counter}}'>
                            <div class="input-group">
                                {{Form::text('percent[]', '', ['class' => 'form-control col-sm-1'])}}
                                <div class="input-group-prepend">
                                    <span class="input-group-text">%</span>
                                </div>
                                {{Form::text('evaluation[]', $e, ['class' => 'form-control col-9'])}}
                                &emsp;<span class='btn btn-outline-dark' onClick="removeElement('evaluation{{$evaluation_counter}}');">-</span>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
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
                @php
                    $course_subjects_counter = 0;
                @endphp
                @foreach($course_subjects as $course_subject)
                    @if(!empty($course_subject))
                        <div id='course_subjects{{++$course_subjects_counter}}'>
                            <div class='form-row'>
                                {{Form::text('course_subjects[]', $course_subject, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('course_subjects{{$course_subjects_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
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
                @php
                    $calendar_plan_counter = 0;
                @endphp
                @foreach($calendar_plan as $cp)
                    @if(!empty($cp))
                        <div id='calendar_plan{{++$calendar_plan_counter}}'>
                                
                            <div class='form-row'>
                                <div class='col-2'>
                                    {{Form::text('calendar_plan_lecture_num[]', '', ['class' => 'form-control'])}}
                                </div>
                                <div class='col-8'>
                                    {{Form::textarea('calendar_plan_subject[]', $cp, ['class' => 'form-control', 'rows' => 3])}}
                                </div>
                                <div class='col'>
                                    {{Form::text('calendar_plan_type[]', '', ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <span class='btn btn-outline-dark' onClick="removeElement('calendar_plan{{$calendar_plan_counter}}');">-</span>
                            <br><br>
                        </div>
                    @endif
                @endforeach
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
                @php
                    $basic_literature_counter = 0;
                @endphp
                @foreach($basic_literature as $bl)
                    @if(!empty($bl))
                        <div id='basic_literature{{++$basic_literature_counter}}'>
                            <div class='form-row'>
                                {{Form::text('basic_literature[]', $bl, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('basic_literature{{$basic_literature_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
                <div id="basic_literature_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('basic_literature_input');">+</span><br><br>

                <br><h3>Papildliteratūra</h3><br>
                <p>* aizpildiet tikai nepieciešamības gadījumā</p>
                @php
                    $additional_literature_counter = 0;
                @endphp
                @foreach($additional_literature as $al)
                    @if(!empty($al))
                        <div id='additional_literature{{++$additional_literature_counter}}'>
                            <div class='form-row'>
                                {{Form::text('additional_literature[]', $al, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('additional_literature{{$additional_literature_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
                <div id="additional_literature_input">
                </div>
                <span class="btn btn-outline-dark" onClick="addInput('additional_literature_input');">+</span><br><br>

                <br><h3>Citi informācijas avoti</h3><br>
                <p>* aizpildiet tikai nepieciešamības gadījumā</p>
                @php
                    $other_information_sources_counter = 0;
                @endphp
                @foreach($other_information_sources as $ois)
                    @if(!empty($ois))
                        <div id='other_information_sources{{++$other_information_sources_counter}}'>
                            <div class='form-row'>
                                {{Form::text('other_information_sources[]', $ois, ['class' => 'form-control col-10'])}}<br>
                                <div class='col'>
                                    <span class='btn btn-outline-dark' onClick="removeElement('other_information_sources{{$other_information_sources_counter}}');">-</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
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