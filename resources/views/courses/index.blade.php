@extends('layouts.app')

@section('content')
    <h1>Studiju kursi</h1><br>
    
    @if(Auth::user()->canAddCourseDescriptions())
        <a href="/courses/create" class ="btn btn-primary">Pievienot studiju kursu</a><br><br>
    @endif

    {!! Form::open(['action' => 'StudyCoursesController@filterCourses', 'method' => 'POST']) !!}
        <div class="form-group">
            <hr>
            Izvēlieties, kurus studiju kursus attēlot:
            <br><br>
            <input type="radio" name="courses_rb" onclick="handleClick(this);" value="all_courses" checked> Visi studiju kursi no visām fakultātēm un visām studiju programmām<br>
            <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_faculty"> Izvēlētas fakultātes studiju kursi<br>
            <input type="radio" name="courses_rb" onclick="handleClick(this);" value="courses_program"> Izvēlētas studiju programmas studiju kursi<br>
            <input type="radio" name="courses_rb" onclick="handleClick(this);" value="c_courses"> Brīvās izvēles studiju kursi<br><br>
            {{Form::checkbox('only_eng_checkbox')}} Tikai kursu apraksti angļu valodā<br>
            <br>
            <div id="facultiesDropdownList" style="display: none">
                {{Form::label('faculty_label', 'Izvēlieties fakultāti')}}
                {{Form::select('faculty', $faculties, null, ['class' => 'form-control'])}}<br><br>
            </div>
            <div id="programsDropdownList" style="display: none">
                {{Form::label('programs_label', 'Izvēlieties studiju programmu')}}
                {{Form::select('study_program', $study_programs, null, ['class' => 'form-control'])}}<br><br>
            </div>
            {{Form::text('course_name', '', ['class' => 'form-control', 'placeholder' => 'Pilns vai daļējs kursa nosaukums'])}}<br>
            {{Form::submit('Meklēt', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <hr><br><br>

    @if(count($courses) > 0)
        @foreach ($courses as $course)
            <ul class="list-group">
                <li class="list-group-item"><a href="/courses/{{$course->id}}">{{$course->name}}</a></li>
            </ul>
        @endforeach
        <br><br>
        <!-- next line is for pagination-->
        @if($paginate)
            {{ $courses->links() }}
        @endif

        @if($search)
        <br><p>Meklēšanas rezultātiem atbilst {{count($courses)}} studiju kursu apraksti</p>
        @endif
    @else
        @if($search)
            <p>Meklēšanas rezultātiem neatbilst neviens studiju kurss</p>
        @else
            <p>Sistēmā nav reģistrētu studiju kursu</p>
        @endif
    @endif

    <p>Sistēmā kopā saglabāti {{$number_of_added_courses}} kursu apraksti</p><br>
    <br><a href="/" class ="btn btn-primary">Atpakaļ</a><br><br>

 @endsection