@extends('layouts.app')

@section('content')
        
    <h3 class="text-center"><strong>{{$study_course->name}}</strong></h3>
    @if($catalog->name_eng && $study_course->name_eng != null)
        <h3 class="text-center">({{$course->name_eng}})</h3>
    @endif
    <br>
    <table class="table table-bordered">
        <tbody>
            @if($catalog->lecturers)
                <tr>
                    <td>Author</td>
                    <td>
                        @foreach($study_course->lecturers as $lecturer)
                            {{$lecturer->degree.', '.$lecturer->position.' '.$lecturer->firstname.' '.$lecturer->lastname}}<br>
                        @endforeach
                    </td>
                </tr>
            @endif
            @if($catalog->LAIS_code)
                <tr>
                    <td>LAIS course code</td>
                    <td>{{$study_course->LAIS_code}}</td>
                </tr>
            @endif
            @if($catalog->type_of_test)
                <tr>
                    <td>Form of evaluation</td>
                    <td>
                        @if($study_course->type_of_test->type_of_test == 'Eksāmens')
                            Exam
                        @elseif($study_course->type_of_test->type_of_test == 'Ieskaite')
                            Test
                        @endif
                    </td>
                </tr>
            @endif
            @if($catalog->kp)
                <tr>
                    <td>Academic credit points (ECTS credit points)</td>
                    <td>{{$study_course->kp.'KP ('.$study_course->kp*1.5.' ECTS)'}}</td>
                </tr>
            @endif
            @if($catalog->total_number_of_lectures)
                <tr>
                    <td>The total number of contact lessons</td>
                    <td>{{$study_course->number_of_lectures+$study_course->number_of_seminars}}</td>
                </tr>
            @endif
            @if($catalog->number_of_lectures)
                <tr>
                    <td>The number of lectures</td>
                    <td>{{$study_course->number_of_lectures}}</td>
                </tr>
                <tr>
                    <td>The number of practical classes</td>
                    <td>{{$study_course->number_of_seminars}}</td>
                </tr>
            @endif
            @if($catalog->prerequisites)
                <tr>
                    <td>Prerequisites</td>
                    <td>{{$study_course->prerequisites}}</td>
                </tr>
            @endif
            @if($catalog->study_program_part)
                <tr>
                    <td>Part of the study programme</td>
                    <td>{{$study_course->study_program_part->part}}</td>
                </tr>
            @endif
        </tbody>
    </table>

    @if($catalog->objective)
        <br><h4>Study course objective:</h4><br><p>{{$study_course->objective}}</p>
    @endif

    @if($catalog->study_results)
        <br><h4>Study results:</h4><br>
            <ul>
                @foreach ($study_course->study_course_results as $course_result)
                    <li>{{$course_result->result}}</li>
                @endforeach
                @foreach ($study_course->additional_study_course_results as $course_result)
                    <li>{{$course_result->result}}</li>
                @endforeach
                @if(count($study_course->study_course_results) == 0 && count($study_course->additional_study_course_results) == 0)
                    @foreach ($study_course->study_program_results as $program_result)
                        <li>{{$program_result->result}}</li>
                    @endforeach
                @endif
            </ul>
    @endif

    @if($catalog->independent_tasks)
        <br><h4>Organization mode of students’ individual work</h4><br>
        <p>The independent work of students includes:</p>
        <ul>
        @foreach ($study_course->independent_tasks as $independent_task)
            <li>{{$independent_task->task}}</li>
        @endforeach
        </ul>
    @endif

    @if($catalog->evaluation)
        <br><h4>Evaluation of study results</h4><br>
        <p>The final result is made of:</p>
        <ul>
        @foreach ($study_course->evaluations as $evaluation)
            <li>{{$evaluation->type_of_evaluation.' '.$evaluation->percent.' %'}}</li>
        @endforeach
        </ul>
    @endif

    @if($catalog->subjects)
        <br><h4>Study course outline</h4><br>
        <table class="table table-bordered with_row_numbers">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title of the topic</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($study_course->subjects as $subject)
                    <tr>
                        <td></td>
                        <td>{{$subject->subject}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($catalog->calendar_plan)
        <br><h4>Study course schedule</h4><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No. of the class</th>
                    <th>Title of the topic</th>
                    <th>Type of class, amount of academic hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($study_course->calendar_plans as $calendar_plan)
                <tr>
                    <td>{{$calendar_plan->lecture_num}}</td>
                    <td>{{$calendar_plan->subject}}</td>
                    <td>{{$calendar_plan->type_of_lecture}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if($catalog->basic_literature)
        <br><h4>Basic literature</h4><br>
        <ul>
        @foreach ($study_course->basic_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>
    @endif

    @if($catalog->additional_literature)
        <br><h4>Supplementary literature</h4><br>
        <ul>
        @foreach ($study_course->additional_literature as $literature)
            <li>{{$literature->name}}</li>
        @endforeach
        </ul>
    @endif

    @if($catalog->other_information_sources)
        <br><h4>Other sources of information</h4><br>
        <ul>
        @foreach ($study_course->other_information_sources as $information_source)
            <li>{{$information_source->name}}</li>
        @endforeach
        </ul>
    @endif

    <br><hr><br>
    <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a><br><br>

@endsection
