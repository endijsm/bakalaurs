@extends('layouts.app')

@section('mapping')

    <h1 class="text-center mt-5">Studiju programmas "{{$study_program->name}}" studiju kursu kartējums</h1><br>
    {!! link_to(URL::previous(), 'Atpakaļ', ['class' => 'btn btn-primary']) !!}
    <br><br>

    @if(count($study_program->study_courses) > 0)
        <table class="table table-bordered table-fixed">
            <thead>  
            <tr>
                <th></th>
                <th>Studiju kursu sasniedzamie studiju rezultāti</th>
                <!-- Print all study program study results in first table row -->
                @foreach($study_program->study_program_results as $result)
                    <th>{{$result->result}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($study_program->study_courses as $study_course)
                @if(!$study_course->eng)
                    <!-- Study courses with direct study program study results -->
                    @if($study_course->direct_results)
                        <tr>
                            <th>{{$study_course->name}}</th>
                            <th></th>
                            @foreach($study_program->study_program_results as $result)
                                @if($study_course->study_program_results->contains($result))
                                    <th style="font-size:20px">X</th>
                                @else
                                    <th></th>
                                @endif
                            @endforeach       
                        </tr>
                    @else
                        <!-- Study courses with linked study program study results -->
                        @for($i=0; $i<count($study_course->study_course_results); $i++)
                            <tr>
                                @if($i==0)
                                    <th rowspan="{{count($study_course->study_course_results)}}">{{$study_course->name}}</th>
                                @endif
                                <th>{{$study_course->study_course_results[$i]->result}}</th>
                                @foreach($study_program->study_program_results as $result)
                                    @if($study_course->study_course_results[$i]->study_program_results->contains($result))
                                        <th style="font-size:20px">X</th>
                                    @else
                                        <th></th>
                                    @endif
                                @endforeach       
                            </tr>
                        @endfor
                    @endif
                @endif
            @endforeach
            </tbody>
        </table>
        <br><br>
        {!! link_to(URL::previous(), 'Atpakaļ', ['class' => 'btn btn-primary']) !!}
        <br><br>
    @else
        <br><p class="text-danger">Nav iespējams attēlot studiju programmas studiju kursu kartējumu, jo studiju programmai nav pievienots neviens studiju kurss!</p>
    @endif

@endsection