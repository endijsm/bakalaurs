@extends('layouts.app')

@section('content')
        <h1>{{$catalog->name}}</h1>
        <br>
        @if(Auth::check() && Auth::user()->canDefineCatalog())
            <a href="/catalogs/{{$catalog->id}}/edit" class="btn btn-outline-dark">Labot katalogu</a><br><br>

            {!!Form::open(['action' => ['CatalogsController@destroy', $catalog->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Dzēst katalogu', ['class' => 'btn btn-danger delete-catalog'])}}
            {!!Form::close()!!}
        @endif

        <br><a href="{{ URL::previous() }}" class="btn btn-primary">Atpakaļ</a><br><br>

        @if($catalog->show_in_one_page)

            @foreach ($study_courses as $study_course)
                
                <h3 class="text-center"><strong>{{$study_course->name}}</strong></h3>
                @if($catalog->name_eng && $study_course->name_eng != null)
                    <h5 class="text-center">({{$study_course->name_eng}})</h5>
                @endif
                <br>
                <table class="table table-bordered">
                    <tbody>
                        @if($catalog->lecturers)
                            <tr>
                                <td>Kursa pasniedzējs:</td>
                                <td>
                                    @foreach($study_course->lecturers as $lecturer)
                                        {{$lecturer->degree.', '.$lecturer->position.' '.$lecturer->firstname.' '.$lecturer->lastname}}<br>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if($catalog->LAIS_code)
                            <tr>
                                <td>LAIS kods</td>
                                <td>{{$study_course->LAIS_code}}</td>
                            </tr>
                        @endif
                        @if($catalog->type_of_test)
                            <tr>
                                <td>Pārbaudes forma</td>
                                <td>{{$study_course->type_of_test->type_of_test}}</td>
                            </tr>
                        @endif
                        @if($catalog->kp)
                            <tr>
                                <td>Kredītpunkti (ECTS kredītpunkti)</td>
                                <td>{{$study_course->kp.'KP ('.$study_course->kp*1.5.' ECTS)'}}</td>
                            </tr>
                        @endif
                        @if($catalog->total_number_of_lectures)
                            <tr>
                                <td>Kopējais kontaktnodarībību skaits</td>
                                <td>{{$study_course->number_of_lectures+$study_course->number_of_seminars}}</td>
                            </tr>
                        @endif
                        @if($catalog->number_of_lectures)
                            <tr>
                                <td>Lekciju skaits</td>
                                <td>{{$study_course->number_of_lectures}}</td>
                            </tr>
                            <tr>
                                <td>Praktisko nodarbību skaits</td>
                                <td>{{$study_course->number_of_seminars}}</td>
                            </tr>
                        @endif
                        @if($catalog->prerequisites)
                            <tr>
                                <td>Nepieciešamās zināšanas kursa uzsākšanai</td>
                                <td>{{$study_course->prerequisites}}</td>
                            </tr>
                        @endif
                        @if($catalog->study_program_part)
                            <tr>
                                <td>Studiju programmas daļa</td>
                                <td>{{$study_course->study_program_part->part}}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                @if($catalog->objective)
                    <br><h4>Kursa mērķis:</h4><p>{{$study_course->objective}}</p>
                @endif

                @if($catalog->study_results)
                    <br><h4>Studiju rezultāti:</h4><br>
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
                    <br><h4>Studējošo patstāvīgā darba organizācijas veids</h4>
                    <p>Studentu patstāvīgais darbs ietver:</p>
                    <ul>
                    @foreach ($study_course->independent_tasks as $independent_task)
                        <li>{{$independent_task->task}}</li>
                    @endforeach
                    </ul>
                @endif

                @if($catalog->evaluation)
                    <br><h4>Sudiju rezultātu vērtēšana</h4>
                    <p>Gala rezultātu veido:</p>
                    <ul>
                    @foreach ($study_course->evaluations as $evaluation)
                        <li>{{$evaluation->type_of_evaluation.' '.$evaluation->percent.' %'}}</li>
                    @endforeach
                    </ul>
                @endif

                @if($catalog->subjects)
                    <br><h4>Studiju kursa saturs</h4>
                    <table class="table table-bordered with_row_numbers">
                        <thead>
                            <tr>
                                <th>N.p.k.</th>
                                <th>Tēmas nosaukums</th>
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
                    <br><h4>Studiju kursa kalendārais plāns</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nodarbības numurs</th>
                                <th>Tēmas nosaukums</th>
                                <th>Nodarbības veids, akadēmisko stundu skaits</th>
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
                    <br><h4>Pamatliteratūra:</h4>
                    <ul>
                    @foreach ($study_course->basic_literature as $literature)
                        <li>{{$literature->name}}</li>
                    @endforeach
                    </ul>
                @endif

                @if($catalog->additional_literature)
                    <br><h4>Papildliteratūra:</h4>
                    <ul>
                    @foreach ($study_course->additional_literature as $literature)
                        <li>{{$literature->name}}</li>
                    @endforeach
                    </ul>
                @endif

                @if($catalog->other_information_sources)
                    <br><h4>Citi informācijas avoti:</h4>
                    <ul>
                    @foreach ($study_course->other_information_sources as $information_source)
                        <li>{{$information_source->name}}</li>
                    @endforeach
                    </ul>
                @endif
                
                <br><br>
            @endforeach
        @else 
            <ul class="list-group">
                @foreach ($study_courses as $study_course)
                    <li class="list-group-item"><a href="/catalog/{{$catalog->id}}/course/{{$study_course->id}}">{{$study_course->name}}</a></li>
                @endforeach
            </ul> 
        @endif

        <br><hr>
        <p>Katalogs definēts: {{$catalog->created_at}}<p>
        <p>Pēdējās izmaiņas: {{$catalog->updated_at}}<p>
        <hr><br>
        <a href="{{ URL::previous() }}" class="btn btn-primary">Atpakaļ</a><br><br>

@endsection