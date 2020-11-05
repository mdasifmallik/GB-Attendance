@extends('layouts.home')



@section('content')

                    <div class="row" style="margin-top: 80px;">
                        <div class="col-md-12">
                            <a class="back-button" href="/"><i class="fas fa-angle-left"></i>Back to search panel</a>
                        </div>
                    </div>
                    <h3 class="text-center green" style="margin-bottom: 20px;">Attendance Sheet</h3>

                    @if($batch)
                        <div class="student-info">
                            <nav>
                                <ul>
                                    <li><b>Department:</b> {{$department->name}}</li>
                                    <li><b>Batch:</b> {{$batch->name}}</li>
                                    <li><b>Subject:</b> {{$subject->name}}</li>
                                </ul>
                            </nav>
                        </div>
                        <div class="table-responsive sheet" style="margin-top: 15px;">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Student's Name</th>
                                        @foreach($batch->students as $student)
                                            <th>{{$student->name}}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Percentage</th>
                                        @foreach($batch->students as $student)
                                            @php
                                                $present=0;
                                                $absent=0;
                                            @endphp
                                            @foreach($student->attendances as $attendance)
                                                @foreach($attendance->subjects as $sub)
                                                    @php
                                                        if ($subject->id == $sub->id) {
                                                            if ($attendance->attendance > 0) {
                                                                $present += $attendance->attendance;
                                                            }else{
                                                                $absent++;
                                                            }
                                                        }
                                                    @endphp
                                                @endforeach
                                            @endforeach
                                            @php
                                                $total= $present+$absent;
                                                if ($total<=0) {
                                                    $present=1;
                                                    $total=1;
                                                }
                                                $percent= ($present/$total)*100;
                                            @endphp
                                            <th>{{round($percent)}}%</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th class="fixed">Roll</th>
                                        @foreach($batch->students as $student)
                                            <th class="fixed">{{$student->roll}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($batch->lectures as $lecture)
                                        @foreach($lecture->subjects as $sub)
                                            @if($subject->name == $sub->name)
                                                <tr>
                                                    <th>ID: {{$lecture->name}} | {{$lecture->created_at->format('d/M/y')}}</th>
                                                    @foreach($lecture->attendances as $attendance)
                                                        <td>{{$attendance->attendance}}</td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <h2>Your selected semester has no batch assigned.</h2>
                        </div>
                    @endif

                </div>
            </div>

@endsection