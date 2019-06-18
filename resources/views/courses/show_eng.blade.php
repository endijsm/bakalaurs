@extends('layouts.app')

@section('content')
        <h1>Study course:</h1><br><br>
        <a href="/courses" class ="btn btn-primary">Back</a><br><br>
        
        <h1 class="text-center">{{$course->name}}</h1>
        @if($course->name_eng != null)
            <h3 class="text-center">({{$course->name_eng}})</h3>
        @endif

        @if(Auth::user()->canAddCourseDescriptions())
            <a href="/courses/{{$course->id}}/edit" class="btn btn-outline-dark">Edit</a><br><br>
            {!!Form::open(['action' => ['StudyCoursesController@destroy', $course->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger delete-course'])}}
            {!!Form::close()!!}
        @endif
        <br><br>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Author</td>
                    <td>
                        @foreach($course->lecturers as $lecturer)
                            {{$lecturer->degree.', '.$lecturer->position.' '.$lecturer->firstname.' '.$lecturer->lastname}}<br>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td>LAIS course code</td>
                    <td>{{$course->LAIS_code}}</td>
                </tr>
                <tr>
                    <td>Form of evaluation</td>
                    <td>
                        @if($course->type_of_test->type_of_test == 'Eksāmens')
                            Exam
                        @elseif($course->type_of_test->type_of_test == 'Ieskaite')
                            Test
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Academic credit points (ECTS credit points)</td>
                    <td>{{$course->kp.'KP ('.$course->kp*1.5.' ECTS)'}}</td>
                </tr>
                <tr>
                    <td>The total number of contact lessons</td>
                    <td>{{$course->number_of_lectures+$course->number_of_seminars}}</td>
                </tr>
                <tr>
                    <td>The number of lectures</td>
                    <td>{{$course->number_of_lectures}}</td>
                </tr>
                <tr>
                    <td>The number of practical classes</td>
                    <td>{{$course->number_of_seminars}}</td>
                </tr>
                <tr>
                    <td>Prerequisites</td>
                    <td>{{$course->prerequisites}}</td>
                </tr>
                <tr>
                    <td>Part of the study programme</td>
                    <td>{{$course->study_program_part->part}}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <h3>Study course objective</h3><br>
        <p>{{$course->objective}}</p>

        <br>
        <h3>Study results</h3>
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

        @if($course->c_course)
            <div style="display:none">
        @else
            <div>
        @endif
            <ul>
                @foreach ($course->study_program_results as $result)
                    <li>{{$result->result}}</li>
                @endforeach
            </ul>
            </div>

        <br>
        <h3>Organization mode of students’ individual work</h3><br>
        <p>The independent work of students includes:</p>
        <ul>
        @foreach ($course->independent_tasks as $independent_task)
            <li>{{$independent_task->task}}</li>
        @endforeach
        </ul>

        <br>
        <h3>Evaluation of study results</h3><br>
        <p>The final result is made of:</p>
        <ul>
        @foreach ($course->evaluations as $evaluation)
            <li>{{$evaluation->type_of_evaluation.' '.$evaluation->percent.' %'}}</li>
        @endforeach
        </ul>

        <br>
        <h3>Study course outline</h3><br>
        <table class="table table-bordered with_row_numbers">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title of the topic</th>
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
        <h3>Study course schedule</h3><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. of the class</th>
                    <th>Title of the topic</th>
                    <th>Type of class, amount of academic hours</th>
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
        <h3>Basic literature</h3><br>
        <ul>
        @foreach ($course->basic_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>

        <br><br>
        <h3>Supplementary literature</h3><br>
        <ul>
        @foreach ($course->additional_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>

        <br><br>
        <h3>Other sources of information</h3><br>
        <ul>
            @foreach ($course->other_information_sources as $information_source)
                <li>{{$information_source->name}}</li>
            @endforeach
        </ul>
        
        <br><br><hr>
        <p>Course description added by: {{$course->author->firstname.' '.$course->author->lastname}}</p>
        <p>Last changes: {{$course->updated_at}}</p>
        <br><a href="/courses" class ="btn btn-primary">Back</a><br><br>
@endsection