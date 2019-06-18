@extends('layouts.app')

@section('content')
        <h1>Pievienot studiju programmu</h1><br>
        {!! Form::open(['action' => 'StudyProgramsController@store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('program_name_label', 'Jaunās studiju programmas nosaukums:')}}
                {{Form::text('program_name', '', ['class' => 'form-control', 'placeholder' => 'Studiju programmas nosaukums'])}}<br><br>
                {{Form::label('level_label', 'Līmenis:')}}<br>
                {{Form::select('level', ['Bakalaura' => 'Bakalaura',  'Maģistra' => 'Maģistra', 'Doktora' => 'Doktora', 'Pirmā līmeņa augstākā izglītība' => 'Pirmā līmeņa augstākā izglītība'], null, ['class' => 'form-control'])}}<br><br>
                {{Form::label('study_directions_label', 'Studiju virziens:')}}<br>
                {{Form::select('study_direction', $study_directions, null, ['class' => 'form-control'])}}<br><br>
                {{Form::label('kp_label', 'Studiju programmas īstenošanas apjoms (kredītpunkti):')}}
                {{Form::text('kp', '', ['class' => 'form-control', 'min' => '0', 'placeholder' => 'Kredītpunkti'])}}<br><br>
                {{Form::label('duration_label', 'Studiju programmas īstenošanas ilgums (gadi):')}}
                {{Form::text('duration', '', ['class' => 'form-control', 'min' => '0', 'step' => '0.1', 'placeholder' => 'Ilgums gados'])}}<br><br>                
                {{Form::label('type_label', 'Studiju programmas īstenošanas veids:')}}
                {{Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'Pilna laika / nepilna laika'])}}<br><br>                
                {{Form::label('language_label', 'Studiju programmas īstenošanas valoda:')}}
                {{Form::text('language', '', ['class' => 'form-control', 'placeholder' => 'Valoda'])}}<br><br>
                {{Form::label('prerequisites_label', 'Uzņemšanas prasības:')}}
                {{Form::text('prerequisites', '', ['class' => 'form-control', 'placeholder' => 'Uzņemšanas prasības'])}}<br><br>
                {{Form::label('degree_label', 'Piešķiramā kvalifikācija un/vai grāds:')}}
                {{Form::text('degree', '', ['class' => 'form-control', 'placeholder' => 'Kvalifikācija vai grāds'])}}<br><br>
                {{Form::label('study_directions_label', 'Studiju programmas direktors:')}}<br>
                {{Form::select('director', $directors, null, ['class' => 'form-control'])}}<br><br>
                {{Form::label('objective_label', 'Studiju programmas mērķis:')}}
                {{Form::textarea('objective', '', ['class' => 'form-control', 'rows' => 3])}}<br><br>
            </div>
            {{Form::submit('Pievienot studiju programmu', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        <br><br>
        <a href="/programs" class="btn btn-primary">Atpakaļ</a><br><br>
@endsection 