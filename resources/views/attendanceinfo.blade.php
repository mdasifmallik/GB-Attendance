@extends('layouts.home')



@section('content')

            <div class="by-student-content">
                <div class="row">
                    <div class="col-md-12">
                        <a class="back-button" href="/"><i class="fas fa-angle-left"></i>Back to search panel</a>
                    </div>
                </div>
                <h3 class="pink" style="margin-bottom: 20px;">Attendance Info</h3>
                @if($batch==null)
                    <div class="alert alert-danger">
                        <h2>Your selected semester has no batch assigned.</h2>
                    </div>
                @endif

                @if($student)
                    <div class="student-info">
                        <nav>
                            <ul>
                                <li><b>Department:</b> {{$department->name}}</li>
                                <li><b>Batch:</b> {{$batch->name}}</li>
                                <li><b>Student's Name:</b> {{$student->name}}</li>
                            </ul>
                        </nav>
                    </div>
                    @foreach($batch->semester as $sem)
                        @foreach($sem->subjects as $subject)
                            @foreach($subject->department as $dep)
                                @if($department->id == $dep->id)
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
                                        $percent= ($present/$total)*100;
                                    @endphp

                                    <div class="subject-attendance-info">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>{{$subject->name}}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><span>Total: {{$present+$absent}} classes</span></div>
                                            <div class="col-md-3"><span>Attended: {{$present}} classes</span></div>
                                            <div class="col-md-3"><span>Absent: {{$absent}} classes</span></div>
                                            <div class="col-md-3"><span>Percentage: {{$percent}}%</span></div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                @else
                    <div class="alert alert-danger">
                        <h2>Roll not matched.</h2>
                    </div>
                @endif
            </div>

@endsection