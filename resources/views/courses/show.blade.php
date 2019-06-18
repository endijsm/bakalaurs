@extends('layouts.app')

@section('content')
        <h1>Studiju kurss:</h1><br><br>
        <a href="/courses" class ="btn btn-primary">Atpakaļ</a><br><br>
        
        <h1 class="text-center">{{$course->name}}</h1>
        @if($course->name_eng != null)
            <h3 class="text-center">({{$course->name_eng}})</h3>
        @endif

        @if(Auth::user()->canAddCourseDescriptions())
            <a href="/courses/{{$course->id}}/edit" class="btn btn-outline-dark">Labot</a><br><br>
            {!!Form::open(['action' => ['StudyCoursesController@destroy', $course->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Dzēst', ['class' => 'btn btn-danger delete-course'])}}
            {!!Form::close()!!}
        @endif
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Kursa pasniedzējs:</td>
                    <td>
                        @foreach($course->lecturers as $lecturer)
                            {{$lecturer->degree.', '.$lecturer->position.' '.$lecturer->firstname.' '.$lecturer->lastname}}<br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>LAIS kods</td>
                    <td>{{$course->LAIS_code}}</td>
                </tr>
                <tr>
                    <td>Pārbaudes forma</td>
                    <td>{{$course->type_of_test->type_of_test}}</td>
                    </tr>
                <tr>
                    <td>Kredītpunkti (ECTS kredītpunkti)</td>
                    <td>{{$course->kp.'KP ('.$course->kp*1.5.' ECTS)'}}</td>
                </tr>
                <tr>
                    <td>Kopējais kontaktnodarībību skaits</td>
                    <td>{{$course->number_of_lectures+$course->number_of_seminars}}</td>
                </tr>
                <tr>
                    <td>Lekciju skaits</td>
                    <td>{{$course->number_of_lectures}}</td>
                </tr>
                <tr>
                    <td>Praktisko nodarbību skaits</td>
                    <td>{{$course->number_of_seminars}}</td>
                </tr>
                <tr>
                    <td>Nepieciešamās zināšanas kursa uzsākšanai</td>
                    <td>{{$course->prerequisites}}</td>
                </tr>
                <tr>
                    <td>Studiju programmas daļa</td>
                    <td>{{$course->study_program_part->part}}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <h3>Studiju kursa mērķis</h3><br>
        <p>{{$course->objective}}</p>

        <br>
        <h3>Studiju rezultāti</h3><br>
        <ul>
            @foreach ($course->study_course_results as $course_result)
                <li>{{$course_result->result}}</li>
            @endforeach
            @foreach ($course->additional_study_course_results as $course_result)
                <li>{{$course_result->result}}</li>
            @endforeach
            @if(count($course->study_course_results) == 0 && count($course->additional_study_course_results) == 0)
                @foreach ($course->study_program_results as $program_result)
                    <li>{{$program_result->result}}</li>
                @endforeach
            @endif
        </ul>

        <br>
        <h3>Studējošo patstāvīgā darba organizācijas veids</h3><br>
        <p>Studentu patstāvīgais darbs ietver:</p>
        <ul>
        @foreach ($course->independent_tasks as $independent_task)
            <li>{{$independent_task->task}}</li>
        @endforeach
        </ul>

        <br>
        <h3>Sudiju rezultātu vērtēšana</h3><br>
        <p>Gala rezultātu veido:</p>
        <ul>
        @foreach ($course->evaluations as $evaluation)
            <li>{{$evaluation->type_of_evaluation.' '.$evaluation->percent.' %'}}</li>
        @endforeach
        </ul>

        <br>
        <h3>Studiju kursa saturs</h3><br>
        <table class="table table-bordered with_row_numbers">
            <thead>
                <tr>
                    <th>N.p.k.</th>
                    <th>Tēmas nosaukums</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->subjects as $subject)
                    <tr>
                        <td></td>
                        <td>{{$subject->subject}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <br>
        <h3>Studiju kursa kalendārais plāns</h3><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nodarbības numurs</th>
                    <th>Tēmas nosaukums</th>
                    <th>Nodarbības veids, akadēmisko stundu skaits</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->calendar_plans as $calendar_plan)
                <tr>
                    <td>{{$calendar_plan->lecture_num}}</td>
                    <td>{{$calendar_plan->subject}}</td>
                    <td>{{$calendar_plan->type_of_lecture}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <br><br>
        <h3>Pamatliteratūra</h3><br>
        <ul>
        @foreach ($course->basic_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>

        <br><br>
        <h3>Papildliteratūra</h3><br>
        <ul>
        @foreach ($course->additional_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>

        <br><br>
        <h3>Citi informācijas avoti</h3><br>
        <ul>
            @foreach ($course->other_information_sources as $information_source)
                <li>{{$information_source->name}}</li>
            @endforeach
        </ul>
        
        <br><br><hr>
        @if($course->author != null)
            <p>Aprakstu pievienoja: {{$course->author->firstname.' '.$course->author->lastname}}</p>
        @endif
        <p>Pēdējās izmaiņas: {{$course->updated_at}}</p>
        <br><a href="/courses" class ="btn btn-primary">Atpakaļ</a><br><br>
@endsection