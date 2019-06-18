@extends('layouts.app')

@section('content')
        <h1>Definēt jaunu katalogu</h1>
        <br>
        
        {!! Form::open(['action' => 'CatalogsController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('catalog_name_label', 'Jaunā kataloga nosaukums:')}}
                {{Form::text('catalog_name', '', ['class' => 'form-control', 'placeholder' => 'Nosaukums'])}}<br>

                <br>
                Izvēlieties, kurus studiju kursus iekļaut katalogā:
                <br><br>
                <input type="radio" name="courses_rb" onclick="handleClick(this);" value="all_courses" checked> Visi studiju kursi no visām fakultātēm un visām studiju programmām<br>
                <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_faculty"> Izvēlētas fakultātes studiju kursi<br>
                <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_program"> Izvēlētas studiju programmas studiju kursi<br>
                <input type="radio" name="courses_rb" onclick="handleClick(this);" value="c_courses"> Brīvās izvēles studiju kursi<br>
                <br>
                
                <div id="facultiesDropdownList" style="display: none">
                    {{Form::label('faculty_label', 'Izvēlieties fakultāti')}}
                    {{Form::select('faculty', $faculties, null, ['class' => 'form-control'])}}<br><br>
                </div>
                <div id="programsDropdownList" style="display: none">
                    {{Form::label('programs_label', 'Izvēlieties studiju programmu')}}
                    {{Form::select('study_program', $study_programs, null, ['class' => 'form-control'])}}<br><br>
                </div>
                <br>
                {{Form::label('target_users_label', 'Kataloga mērķauditorija:')}}<br><br>
                {{Form::checkbox('available_for_students_checkbox')}} Katalogs redzams studentiem (autentificējoties sistēmā)<br>
                {{Form::checkbox('available_for_guests_checkbox')}} Katalogs redzams viesiem (neautentificētiem lietotājiem)<br>
                {{Form::checkbox('only_eng_checkbox')}} Katalogs satur tikai kursu aprakstus angļu valodā (ārzemju studentiem)<br><br><br>

                {{Form::label('catalog_contents_label', 'Atzīmējiet, kurus kursu aprakstu laukus iekļaut katalogā:')}}<br><br>
                {{Form::checkbox('check_all_checkbox', 0, false, ['onClick' => "checkAllCheckboxes('catalog_contents')", 'id' => 'check_all']) }} Atzīmēt visus <br><br>
                <div id="catalog_contents">
                    {{Form::checkbox('name_eng_checkbox')}} Nosaukums angļu valodā<br>
                    {{Form::checkbox('lecturers_checkbox')}} Kursa pasniedzēji<br>
                    {{Form::checkbox('LAIS_code_checkbox')}} LAIS kods<br>
                    {{Form::checkbox('type_of_test_checkbox')}} Pārbaudes forma<br>
                    {{Form::checkbox('kp_checkbox')}} Kredītpunkti<br>
                    {{Form::checkbox('total_number_of_lectures_checkbox')}} Kopējais kontaktnodarbību skaits<br>
                    {{Form::checkbox('number_of_lectures_checkbox')}} Lekciju skaits un praktisko nodarbību skaits<br>
                    {{Form::checkbox('prerequisites_checkbox')}} Priekšnosacījumi kursa uzsākšanai<br>
                    {{Form::checkbox('study_program_part_checkbox')}} Studiju programmas daļa<br>
                    {{Form::checkbox('objective_checkbox')}} Kursa mērķis<br>
                    {{Form::checkbox('study_results_checkbox')}} Studiju rezultāti<br>
                    {{Form::checkbox('independent_tasks_checkbox')}} Studējošo patstāvīgā darba organizācijas veids<br>
                    {{Form::checkbox('evaluation_checkbox')}} Studiju rezultātu vērtēšana<br>
                    {{Form::checkbox('subjects_checkbox')}} Studiju kursa saturs (tēmas)<br>
                    {{Form::checkbox('calendar_plan_checkbox')}} Studiju kursa kalendārais plāns<br>
                    {{Form::checkbox('basic_literature_checkbox')}} Pamatliteratūra<br>
                    {{Form::checkbox('additional_literature_checkbox')}} Papildliteratūra<br>
                    {{Form::checkbox('other_information_sources_checkbox')}} Citi informācijas avoti<br>
                </div>

                <br><br>
                {{Form::label('additional_options_label', 'Papildus iespējas:')}}<br>
                {{Form::checkbox('show_in_one_page_checkbox')}} Rādīt visu kataloga saturu vienā lapā<br>

            </div>
            <br>
            {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

        <br><br>
        <a href="/catalogs" class="btn btn-primary">Atpakaļ</a><br><br>
@endsection