@extends('layouts.app')

@section('content')
    <h1>Labot studiju programmu</h1><br>
    {!! Form::open(['action' => ['StudyProgramsController@update', $study_program->id],'method' => 'POST']) !!}

        {{Form::label('program_name_label', 'Jaunās studiju programmas nosaukums:')}}
        {{Form::text('program_name', $study_program->name, ['class' => 'form-control', 'placeholder' => 'Studiju programmas nosaukums'])}}<br><br>
        {{Form::label('level_label', 'Līmenis:')}}<br>
        {{Form::select('level', ['Bakalaura' => 'Bakalaura', 'Maģistra' => 'Maģistra', 'Doktora' => 'Doktora', 'Pirmā līmeņa augstākā izglītība' => 'Pirmā līmeņa augstākā izglītība'], $study_program->level, ['class' => 'form-control'])}}<br><br>
        {{Form::label('study_directions_label', 'Studiju virziens:')}}<br>
        @if($study_program->study_direction_id != 0)
            {{Form::select('study_direction', $study_directions, $study_program->study_direction->id, ['class' => 'form-control'])}}<br><br>
        @else
            {{Form::select('study_direction', $study_directions, null, ['class' => 'form-control'])}}<br><br>
        @endif
        {{Form::label('kp_label', 'Studiju programmas īstenošanas apjoms (kredītpunkti):')}}
        {{Form::text('kp', $study_program->kp, ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Kredītpunkti'])}}<br><br>      
        {{Form::label('duration_label', 'Studiju programmas īstenošanas ilgums (gadi):')}}
        {{Form::text('duration', floatval($study_program->duration), ['class' => 'form-control', 'min' => '0', 'step' => '0.1', 'placeholder' => 'Ilgums gados'])}}<br><br>    
        {{Form::label('type_label', 'Studiju programmas īstenošanas veids:')}}
        {{Form::text('type', $study_program->type, ['class' => 'form-control', 'placeholder' => 'Pilna laika / nepilna laika'])}}<br><br>
        {{Form::label('language_label', 'Studiju programmas īstenošanas valoda:')}}
        {{Form::text('language', $study_program->language, ['class' => 'form-control', 'placeholder' => 'Valoda'])}}<br><br>
        {{Form::label('prerequisites_label', 'Uzņemšanas prasības:')}}
        {{Form::text('prerequisites', $study_program->prerequisites, ['class' => 'form-control', 'placeholder' => 'Uzņemšanas prasības'])}}<br><br>
        {{Form::label('degree_label', 'Piešķiramā kvalifikācija un/vai grāds:')}}
        {{Form::text('degree', $study_program->degree, ['class' => 'form-control', 'placeholder' => 'Kvalifikācija vai grāds'])}}<br><br>
        {{Form::label('study_directions_label', 'Studiju programmas direktors:')}}<br>
        {{Form::select('director', $directors, $study_program->director_id, ['class' => 'form-control'])}}<br><br>
        {{Form::label('objective_label', 'Studiju programmas mērķis:')}}
        {{Form::textarea('objective', $study_program->objective, ['class' => 'form-control', 'rows' => 3])}}<br><br>      
        {{Form::hidden('_method', 'PUT')}} 
        {{Form::submit('Saglabāt', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <br><a href="/programs" class="btn btn-primary">Atpakaļ</a><br><br>
@endsection