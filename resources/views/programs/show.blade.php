@extends('layouts.app')

@section('content')
        <h1>Studiju programma: {{$study_program->name.' ('.$study_program->level.')'}}</h1>
        <br><br><a href="/programs" class ="btn btn-primary">Atpakaļ</a><br><br><br>
        @if(Auth::user()->canViewStudyProgramMapping())
            <a href="/mapping/{{$study_program->id}}" class="btn btn-outline-dark">Studiju programmas kartējums</a><br><br>
        @endif
        @if(Auth::user()->canDefineStructures())
            <a href="/programs/{{$study_program->id}}/edit" class="btn btn-outline-dark">Labot studiju programmu</a><br><br>
            
            {!!Form::open(['action' => ['StudyProgramsController@destroy', $study_program->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Dzēst studiju programmu', ['class' => 'btn btn-danger delete-study-program'])}}
            {!!Form::close()!!}
            <br>
        @endif

        <br>
        <table class="table">
            <tbody>
              <tr>
                <th>Studiju programmas nosaukums:</th>
                <td>{{$study_program->name}}</td>
              </tr>
              <tr>
                <th>Fakultāte:</th>
                <td>
                  @if($study_program->study_direction_id != 0)
                    @if($study_program->study_direction->faculty_id != 0)
                      {{$study_program->study_direction->faculty->name}}
                    @else
                      nav norādīta vai dzēsta
                    @endif
                  @else
                    nav norādīts studiju virziens
                  @endif
                </td>
              </tr>
              <tr>
                <th>Atbilstošā studiju virziena nosaukums:</th>
                <td>
                  @if($study_program->study_direction_id != 0)
                    {{$study_program->study_direction->name}}
                  @else
                    nav norādīts vai dzēsts studiju virziens
                  @endif
                </td>  
              </tr>
              <tr>
                <th>Studiju programmas līmenis:</th>
                <td>{{$study_program->level}}</td>
              </tr>
              <tr>
                <th>Studiju programmas īstenošanas apjoms:</th>
                <td>{{$study_program->kp}} kredītpunkti</td>
              </tr>
              <tr>
                <th>Studiju programmas īstenošanas ilgums:</th>
                <td>{{floatval($study_program->duration)}} gadi</td>  
              </tr>
              <tr>
                <th>Studiju programmas īstenošanas veids:</th>
                <td>{{$study_program->type}}</td>  
              </tr>
              <tr>
                <th>Studiju programmas īstenošanas valoda:</th>
                <td>{{$study_program->language}}</td>  
              </tr>
              <tr>
                <th>Uzņemšanas prasības:</th>
                <td>{{$study_program->prerequisites}}</td>  
              </tr>
              <tr>
                <th>Piešķiramā kvalifikācija un/vai grāds:</th>
                <td>{{$study_program->degree}}</td>  
              </tr>
              <tr>
                <th>Studiju programmas direktors:</th>
                @if($study_program->director != null)
                  <td>{{$study_program->director->degree.', '.$study_program->director->position.' '.$study_program->director->firstname.' '.$study_program->director->lastname}}</td>  
                @else
                  <td>nav norādīts vai dzēsts</td>
                @endif
              </tr>
              <tr>
                <th>Studiju programmas mērķis:</th>
                <td>{{$study_program->objective}}</td>  
              </tr>
            </tbody>
          </table>

        <br><br>
        <h3><strong>Studiju programmas sasniedzamie studiju rezultāti:</strong></h3><br>
        <h3>Zināšanas (zināšanas un izpratne):</h3><br>
        @if(count($study_program->study_program_results) > 0)
          @if(Auth::user()->canDefineStructures())
            <table class="table table-bordered">
                <tbody>
                    @foreach($study_program->study_program_results as $study_program_result)
                      @if($study_program_result->type == 'zināšanas')
                        <tr>
                          <td>{{$study_program_result->result}}</td>
                          <td><a href="/program_results/{{$study_program_result->id}}/edit" class="btn btn-outline-dark">Labot</a></td>
                          <td>
                            {!!Form::open(['action' => ['StudyProgramResultsController@destroy', $study_program_result->id], 'method' => 'POST'])!!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Dzēst', ['class' => 'btn btn-outline-dark delete-result'])}}
                            {!!Form::close()!!}
                          </td>
                        </tr>
                      @endif
                    @endforeach
                </tbody>
            </table> 
          @else
            <ul class="list-group">
              @foreach ($study_program->study_program_results as $study_program_result)
                @if($study_program_result->type == 'zināšanas')
                  <li class="list-group-item">{{$study_program_result->result}}</li>
                @endif
              @endforeach
            </ul>
          @endif
        @else 
          <p class="text-danger">Nav pievienotu studiju programmas rezultātu</p>
        @endif
        
        <br><br>

        @if(Auth::user()->canDefineStructures())
            <h4>Pievienot zināšanas</h4>
            {!! Form::open(['action' => 'StudyProgramResultsController@store', 'method' => 'POST']) !!}
            <div class="form-row">
                <div class="col-8">
                    {{ Form::text('result', '', ['class' => 'form-control', 'placeholder' => 'Zināšanas']) }}
                    {{ Form::hidden('type', 'zināšanas') }}
                    {{ Form::hidden('study_program_id', $study_program->id) }}
                </div>
                <div class="col">
                    {{ Form::submit('Pievienot zināšanas', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {!! Form::close() !!}
        @endif

        <br><br>
        <h3>Prasmes (spēja pielietot zināšanas, komunikācija, vispārējās prasmes):</h3><br>
        @if(count($study_program->study_program_results) > 0)
          @if(Auth::user()->canDefineStructures())
            <table class="table table-bordered">
                <tbody>
                    @foreach($study_program->study_program_results as $study_program_result)
                      @if($study_program_result->type == 'prasmes')
                        <tr>
                          <td>{{$study_program_result->result}}</td>
                          <td><a href="/program_results/{{$study_program_result->id}}/edit" class="btn btn-outline-dark">Labot</a></td>
                          <td>
                            {!!Form::open(['action' => ['StudyProgramResultsController@destroy', $study_program_result->id], 'method' => 'POST'])!!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Dzēst', ['class' => 'btn btn-outline-dark delete-result'])}}
                            {!!Form::close()!!}
                          </td>
                        </tr>
                      @endif
                    @endforeach
                </tbody>
            </table> 
          @else
            <ul class="list-group">
              @foreach ($study_program->study_program_results as $study_program_result)
                @if($study_program_result->type == 'prasmes')
                  <li class="list-group-item">{{$study_program_result->result}}</li>
                @endif
              @endforeach
            </ul>
          @endif
        @else 
          <p class="text-danger">Nav pievienotu studiju programmas rezultātu</p>
        @endif
        <br><br>

        @if(Auth::user()->canDefineStructures())
            <h4>Pievienot prasmes</h4>
            {!! Form::open(['action' => 'StudyProgramResultsController@store', 'method' => 'POST']) !!}
            <div class="form-row">
                <div class="col-8">
                    {{ Form::text('result', '', ['class' => 'form-control', 'placeholder' => 'Prasmes']) }}
                    {{ Form::hidden('type', 'prasmes') }}
                    {{ Form::hidden('study_program_id', $study_program->id) }}
                </div>
                <div class="col">
                    {{ Form::submit('Pievienot prasmes', ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {!! Form::close() !!}
        @endif

        <br><br><br><h3><strong>Studiju programmas kursi pa programmas daļām</strong></h3><br>
        @if(count($study_program->study_courses) > 0)
          @foreach ($study_program_parts as $part)
            @foreach ($study_program->study_courses as $study_course)
              @if($study_course->study_program_part_id == $part->id)
                <br><h3>{{$part->part}}</h3>
                @break
              @endif
            @endforeach
            <ul class="list-group">
              @foreach ($study_program->study_courses as $study_course)
                @if($study_course->study_program_part_id == $part->id)
                  <li class="list-group-item"><a href="/courses/{{$study_course->id}}">{{$study_course->name}} ({{$study_course->kp}} KP)</a></li>
                @endif
              @endforeach
            </ul>
          @endforeach
        @else
          <p class="text-danger">Studiju programmai nav pievienotu studiju kursu</p>
        @endif

        <br><br><a href="/programs" class ="btn btn-primary">Atpakaļ</a><br><br>
        
@endsection