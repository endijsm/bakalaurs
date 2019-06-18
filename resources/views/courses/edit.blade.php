@extends('layouts.app')

@section('content')
        <h1>Labot studiju kursa datus</h1>
        <br><a href="/courses/{{$course->id}}" class="btn btn-primary">Atpakaļ</a><br><br>
        
        {!! Form::open(['action' => ['StudyCoursesController@update', $course->id],'method' => 'POST']) !!}
        
        <div class="form-group">

            @if($course->c_course)
                <input type="checkbox" name="c_courses_chbox" id="c_courses_chbox" onclick="c_courses_chbox_change()" checked> Brīvās izvēles studiju kurss<br><br>
            @else
                <input type="checkbox" name="c_courses_chbox" id="c_courses_chbox" onclick="c_courses_chbox_change()"> Brīvās izvēles studiju kurss<br><br>
            @endif
            @if($course->eng)
                <input type="checkbox" name="eng_chbox" checked id="eng_chbox" onclick="eng_chbox_change()"> Studiju kursa apraksts angļu valodā (atzīmējiet, ja aizpildīsiet ievades laukus ar informāciju angļu valodā)<br><br>
            @else
                <input type="checkbox" name="eng_chbox" id="eng_chbox" onclick="eng_chbox_change()"> Studiju kursa apraksts angļu valodā (atzīmējiet, ja aizpildīsiet ievades laukus ar informāciju angļu valodā)<br><br>
            @endif
    
            @if($course->c_course)
                <div id="select_faculty_and_program" style="display:none">
            @else
                <div id="select_faculty_and_program">
            @endif
                    {{Form::label('faculty_label', 'Norādiet, kurai fakultātei pieder šis studiju kurss')}}
                    {{Form::select('faculty', $faculties, $course->faculty_id, ['class' => 'form-control'])}}<br><br>
                    {{Form::label('study_program_label', 'Norādiet, kurai / kurām studiju programmām pieder šis studiju kurss')}}
                    {{Form::select('study_programs[]', $study_programs, $course->study_programs->pluck('id'), ['size' => '6', 'id' => 'study_program', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                    <br><p>* Ja nepieciešams norādīt vairākas studiju programmas, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju programmām</p>
                </div>
            
            {{Form::label('course_name_label', 'Nosaukums')}}
            {{Form::text('course_name', $course->name, ['class' => 'form-control'])}}<br><br>
            @if($course->name_eng != null)
                <div id="course_name_eng_input">
                    {{Form::label('course_name_eng_label', 'Nosaukums angļu valodā')}}
                    {{Form::text('course_name_eng', $course->name_eng, ['class' => 'form-control', 'placeholder' => 'Nosaukums angļu valodā'])}}<br><br>
                </div>
            @else
                <div id="course_name_eng_input" style="display:none;">
            
                    {{Form::label('course_name_eng_label', 'Nosaukums angļu valodā')}}
                    {{Form::text('course_name_eng', '', ['class' => 'form-control', 'placeholder' => 'Nosaukums angļu valodā'])}}<br><br>
                </div>
            @endif

            {{Form::Label('lecturer_label', 'Pasniedzējs:')}}
            {{Form::select('lecturers[]', $lecturers, $course->lecturers->pluck('id'), ['size' => '10', 'multiple' => 'multiple', 'class' => 'form-control'])}}<br>
            <p>* Lai pievienotu vairākus pasniedzējus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz pasniedzēju vārdiem, uzvārdiem</p><br>

            {{Form::label('LAIS_code_label', 'LAIS kods')}}
            {{Form::text('LAIS_code', $course->LAIS_code, ['class' => 'form-control'])}}<br><br>
            {{Form::label('type_of_test_label', 'Pārbaudes forma(veids)')}}
            {{Form::select('type_of_test', $types_of_tests, $course->type_of_test->id, ['class' => 'form-control'])}}<br><br>
            {{Form::label('kp_label', 'Kredītpunkti')}}
            {{Form::text('kp', $course->kp, ['class' => 'form-control'])}}<br><br>
            {{Form::label('number_of_lectures_label', 'Lekciju skaits')}}
            {{Form::text('number_of_lectures', $course->number_of_lectures, ['class' => 'form-control'])}}<br><br>
            {{Form::label('number_of_seminars_label', 'Praktisko nodarbību skaits')}}
            {{Form::text('number_of_seminars', $course->number_of_seminars, ['class' => 'form-control'])}}<br><br>                    
            {{Form::label('prerequisites_label', 'Nepieciešamās zināšanas kursa uzsākšanai')}}
            {{Form::textarea('prerequisites', $course->prerequisites, ['class' => 'form-control'])}}<br><br>
            {{Form::label('study_program_part_label', 'Studiju programmas daļa')}}
            {{Form::select('study_program_part', $study_program_parts, $course->study_program_part->id, ['class' => 'form-control'])}}<br><br>
            <h3>Studiju kursa mērķis</h3><br>
            {{Form::textarea('objective', $course->objective, ['class' => 'form-control'])}}<br><br>

            <h3>Studiju rezultāti</h3><br>
            
            @if($course->c_course)
                <div id="non_c_course_results" style="display:none;">
            @else
                <div id="non_c_course_results">
            @endif
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
                    @if($course->direct_results)
                        <input type="radio" name="results_rb" onclick="handleClick(this);" value="direct_results" checked> Absolūtā (tiešā) atbilstība<br>
                        <input type="radio" name="results_rb" onclick="handleClick(this);" value="linked_results"> Pielāgotā (saistītā) atbilstība<br>
                    @else
                        <input type="radio" name="results_rb" onclick="handleClick(this);" value="direct_results"> Absolūtā (tiešā) atbilstība<br>
                        <input type="radio" name="results_rb" onclick="handleClick(this);" value="linked_results" checked> Pielāgotā (saistītā) atbilstība<br>
                    @endif
                    
                    <br><br>
                    @if($course->direct_results)
                        <div id="direct_results">
                    @else
                        <div id="direct_results" style="display:none;">
                    @endif
                            <h3>Izvēlieties no saraksta studiju programmas studiju rezultātus, kurus īsteno šis studiju kurss:</h3><br>
                            {{ Form::select('program_results[]', $study_program_results, $course->study_program_results->pluck('id'), ['size' => '10', 'id' => 'program_results', 'multiple' => 'multiple', 'class' => 'form-control']) }}
                            <br><p>* Lai izvēlētos vairākus studiju rezultātus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju rezultātiem</p>
                        </div>
                    @if($course->direct_results)
                        <div id="linked_results" style="display:none;">
                    @else
                        <div id="linked_results">
                    @endif
                            <h4>Ievadiet laukā 'Studiju kursa rezultāts' studiju kursa rezultātu un pēc tam norādiet, kuri studiju programmas
                                studiju rezultāti tiek īstenoti ar konkrēto studiju kursa studiju rezultātu (zem katra ievadītā studiju rezultāta atrodas
                                saraksts ar studiju programmas studiju rezultātiem).
                            </h4>
                            <br>

                            @php
                                $linked_results_counter = 0;
                            @endphp
                                
                            @foreach($course->study_course_results as $course_result)

                                {{Form::text('course_results[]', $course_result->result, ['class' => 'form-control', 'placeholder' => 'Studiju kursa rezultāts'])}}<br>
                                {{Form::select('program_results'.++$linked_results_counter.'[]', $study_program_results, $course_result->study_program_results->pluck('id'), ['size' => '10', 'multiple' => 'multiple', 'class' => 'form-control'])}}
                                <br><p>* Lai izvēlētos vairākus studiju rezultātus, nospiediet un turiet CTRL tausiņu, tad ar peli klikšķiniet uz studiju rezultātiem</p>
                            
                            @endforeach
                            
                            
                            {{Form::hidden('number_of_program_results', $linked_results_counter, ['id' => 'num_of_prog_res'])}}
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
                @foreach ($course->additional_study_course_results as $additional_course_result)
                <div id="additional_course_result{{$additional_course_result->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('additional_course_results[]', $additional_course_result->result, ['class' => 'form-control', 'id' => $additional_course_result->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('additional_course_result'+{{$additional_course_result->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="additional_course_results_input">
            </div>
            <span class="btn btn-outline-dark" onClick="addInput('additional_course_results_input');">+</span><br>

            <br><br>         
            <h3>Studējošo patstāvīgā darba organizācijas veids</h3><br>
            <h4>Studentu patstāvīgais darbs ietver:</h4><br>
            @foreach ($course->independent_tasks as $independent_task)
                <div id="independent_task{{$independent_task->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('independent_tasks[]', $independent_task->task, ['class' => 'form-control', 'id' => $independent_task->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('independent_task'+{{$independent_task->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="independent_tasks_input">
            </div><br>
            <span class="btn btn-outline-dark" onClick="addInput('independent_tasks_input');">+</span><br>

            <br><br> 
            <h3>Studiju rezultātu vērtēšana</h3><br>
            <h4>Gala rezultātu veido:</h4><br>

            @foreach ($course->evaluations as $evaluation)
                <div id="evaluation{{$evaluation->id}}">
                    <div class="input-group">
                        {{Form::text('percent[]', $evaluation->percent, ['class' => 'form-control col-sm-1'])}}
                        <div class="input-group-prepend">
                            <span class="input-group-text">%</span>
                        </div>
                        {{Form::text('evaluation[]', $evaluation->type_of_evaluation, ['class' => 'form-control col-sm-9'])}}
                        &emsp;<span class="btn btn-outline-dark" onClick="removeElement('evaluation'+{{$evaluation->id}});">-</span>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="evaluation_input">
            </div><br>
            <span class="btn btn-outline-dark" onClick="addInput('evaluation_input');">+</span><br>

            <br><br>
            <h3>Studiju kursa saturs</h3><br>
            @foreach ($course->subjects as $subject)
                <div id="subject{{$subject->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('course_subjects[]', $subject->subject, ['class' => 'form-control', 'id' => $subject->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('subject'+{{$subject->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="course_subjects_input">
            </div>
            <br>
            <span class="btn btn-outline-dark" onClick="addInput('course_subjects_input');">+</span><br>

            <br><br>
            <h3>Studiju kursa kalendārais plāns</h3><br>

            @foreach ($course->calendar_plans as $calendar_plan)
                <div id="calendar_plan{{$calendar_plan->id}}">
                    <div class="form-row">
                        <div class="col-2">
                            {{ Form::text('calendar_plan_lecture_num[]', $calendar_plan->lecture_num, ['class' => 'form-control', 'placeholder' => 'Nodarbības numurs']) }}
                        </div>
                        <div class="col-8">
                            {{ Form::textarea('calendar_plan_subject[]', $calendar_plan->subject, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Tēmas nosaukums']) }}
                        </div>
                        <div class="col">
                            {{ Form::text('calendar_plan_type[]', $calendar_plan->type_of_lecture, ['class' => 'form-control', 'placeholder' => 'Nodarbības veids']) }}
                        </div>
                    </div>
                    <span class="btn btn-outline-dark" onClick="removeElement('calendar_plan'+{{$calendar_plan->id}});">-</span>
                    <br><br>
                </div>
            @endforeach
            <div id="calendar_plan_input">
            </div>
            <br>
            <span class="btn btn-outline-dark" onClick="addInput('calendar_plan_input');">+</span><br><br>

            <br><br>
            <h3>Pamatliteratūra</h3><br>
            @foreach ($course->basic_literature as $literature)
                <div id="basic_literature{{$literature->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('basic_literature[]', $literature->name, ['class' => 'form-control', 'id' => $literature->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('basic_literature'+{{$literature->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            
            <div id="basic_literature_input">
            </div>
            <br>
            <span class="btn btn-outline-dark" onClick="addInput('basic_literature_input');">+</span><br><br>

            <br><br>
            <h3>Papildliteratūra</h3><br>
            @foreach ($course->additional_literature as $literature)
                <div id="additional_literature{{$literature->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('additional_literature[]', $literature->name, ['class' => 'form-control', 'id' => $literature->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('additional_literature'+{{$literature->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="additional_literature_input">
            </div>
            <br>
            <span class="btn btn-outline-dark" onClick="addInput('additional_literature_input');">+</span><br><br>
 
            <br><br>
            <h3>Citi informācijas avoti</h3><br>
            @foreach ($course->other_information_sources as $information_source)
                <div id="other_information_sources{{$information_source->id}}">
                    <div class="form-row">
                        <div class="col-10">
                            {{Form::text('other_information_sources[]', $information_source->name, ['class' => 'form-control', 'id' => $information_source->id])}}
                        </div>
                        <div class="col">
                            <span class="btn btn-outline-dark" onClick="removeElement('other_information_sources'+{{$information_source->id}});">-</span>
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            <div id="other_information_sources_input">
            </div>
            <br>
            <span class="btn btn-outline-dark" onClick="addInput('other_information_sources_input');">+</span><br>

        </div>
        <br><br>
            
            {{Form::hidden('_method', 'PUT')}} 
            {{Form::submit('Labot studiju kursu', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

    <br><a href="/courses/{{$course->id}}" class="btn btn-primary">Atpakaļ</a><br><br>
@endsection
