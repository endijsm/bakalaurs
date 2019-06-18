@extends('layouts.app')

@section('content')
        <h1>Labot kataloga saturu</h1><br>
        {!! Form::open(['action' => ['CatalogsController@update', $catalog->id],'method' => 'POST']) !!}
        
            <div class="form-group">
                {{Form::label('new_catalog_name_label', 'Kataloga nosaukums:')}}
                {{Form::text('new_catalog_name', $catalog->name, ['class' => 'form-control'])}}<br><br>

                Izvēlieties, kurus studiju kursus iekļaut katalogā:
                <br><br>
                @if($catalog->faculty_id == 0 && $catalog->study_program_id == 0 && $catalog->c_courses == 0)
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="all_courses" checked> Visi studiju kursi no visām fakultātēm un visām studiju programmām<br>
                @else
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="all_courses"> Visi studiju kursi no visām fakultātēm un visām studiju programmām<br>
                @endif
                
                @if($catalog->faculty_id != 0)
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_faculty" checked> Izvēlētas fakultātes studiju kursi<br>
                @else
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_faculty"> Izvēlētas fakultātes studiju kursi<br>
                @endif
                
                @if($catalog->study_program_id != 0)
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_program" checked> Izvēlētas studiju programmas studiju kursi<br>
                @else
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_program"> Izvēlētas studiju programmas studiju kursi<br>
                @endif

                @if($catalog->c_courses != 0)
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="c_courses" checked> Brīvās izvēles studiju kursi<br>
                @else
                    <input type="radio" name="courses_rb" onclick="handleClick(this);" value="c_courses"> Brīvās izvēles studiju kursi<br>
                @endif
                <br>
                
                @if($catalog->faculty_id == 0)
                    <div id="facultiesDropdownList" style="display: none">
                @else
                    <div id="facultiesDropdownList">
                @endif
                    {{Form::label('faculty_label', 'Izvēlieties fakultāti')}}
                    {{Form::select('faculty', $faculties, $catalog->faculty_id, ['class' => 'form-control'])}}<br><br>
                    </div>
                @if($catalog->study_program_id == 0)
                    <div id="programsDropdownList" style="display: none">
                @else
                    <div id="programsDropdownList">
                @endif
                    {{Form::label('programs_label', 'Izvēlieties studiju programmu')}}
                    {{Form::select('study_program', $study_programs, $catalog->study_program_id, ['class' => 'form-control'])}}<br><br>
                    </div>
                <br>
                {{Form::label('target_users_label', 'Kataloga mērķauditorija:')}}<br><br>
                {{Form::checkbox('available_for_students_checkbox', 0, $catalog->available_for_students)}} Katalogs redzams studentiem (autentificējoties sistēmā)<br>
                {{Form::checkbox('available_for_guests_checkbox', 0, $catalog->available_for_guests)}} Katalogs redzams viesiem (neautentificētiem lietotājiem)<br>
                {{Form::checkbox('only_eng_checkbox', 0, $catalog->contents_only_eng)}} Katalogs satur tikai kursu aprakstus angļu valodā (ārzemju studentiem)<br><br><br>



                {{Form::label('catalog_contents_label', 'Atzīmējiet, kurus kursu aprakstu laukus iekļaut katalogā:')}}<br><br>
                {{Form::checkbox('check_all_checkbox', 0, false, ['onClick' => "checkAllCheckboxes('catalog_contents')", 'id' => 'check_all']) }} Atzīmēt visus <br><br>
                <div id="catalog_contents">
                    {{Form::checkbox('name_eng_checkbox', 0, $catalog->name_eng)}} Nosaukums angļu valodā<br>
                    {{Form::checkbox('lecturers_checkbox', 0, $catalog->lecturers)}} Kursa pasniedzēji<br>
                    {{Form::checkbox('LAIS_code_checkbox', 0, $catalog->LAIS_code)}} LAIS kods<br>
                    {{Form::checkbox('type_of_test_checkbox', 0, $catalog->type_of_test)}} Pārbaudes forma<br>
                    {{Form::checkbox('kp_checkbox', 0, $catalog->kp)}} Kredītpunkti<br>
                    {{Form::checkbox('total_number_of_lectures_checkbox', 0, $catalog->total_number_of_lectures)}} Kopējais kontaktnodarbību skaits<br>
                    {{Form::checkbox('number_of_lectures_checkbox', 0, $catalog->number_of_lectures)}} Lekciju skaits un praktisko nodarbību skaits<br>
                    {{Form::checkbox('prerequisites_checkbox', 0, $catalog->prerequisites)}} Priekšnosacījumi kursa uzsākšanai<br>
                    {{Form::checkbox('objective_checkbox', 0, $catalog->objective)}} Kursa mērķis<br>
                    {{Form::checkbox('study_results_checkbox', 0, $catalog->study_results)}} Studiju rezultāti<br>
                    {{Form::checkbox('independent_tasks_checkbox', 0, $catalog->independent_tasks)}} Studējošo patstāvīgā darba organizācijas veids<br>
                    {{Form::checkbox('evaluation_checkbox', 0, $catalog->evaluation)}} Studiju rezultātu vērtēšana<br>
                    {{Form::checkbox('subjects_checkbox', 0, $catalog->subjects)}} Studiju kursa saturs (tēmas)<br>
                    {{Form::checkbox('calendar_plan_checkbox', 0, $catalog->calendar_plan)}} Studiju kursa kalendārais plāns<br>
                    {{Form::checkbox('basic_literature_checkbox', 0, $catalog->basic_literature)}} Pamatliteratūra<br>
                    {{Form::checkbox('additional_literature_checkbox', 0, $catalog->additional_literature)}} Papildliteratūra<br>
                    {{Form::checkbox('other_information_sources_checkbox', 0, $catalog->other_information_sources)}} Citi informācijas avoti<br>
                </div>

                <br><br>
                {{Form::label('additional_options_label', 'Papildus iespējas:')}}<br>
                {{Form::checkbox('show_in_one_page_checkbox', 0, $catalog->show_in_one_page)}} Rādīt visu kataloga saturu vienā lapā<br>
            </div>
            <br>
            {{Form::hidden('_method', 'PUT')}} 
            {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        <br><br>
        <a href="/catalogs/{{$catalog->id}}" class="btn btn-primary">Atpakaļ</a><br><br>
@endsection