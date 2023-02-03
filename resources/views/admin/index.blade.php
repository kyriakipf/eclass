@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">

        <div class="top-section row col-md-12" style="border-bottom: 2px solid #F9627D;">
            <div class="stats-container col-12 col-xl-6">
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-envelope"></i> Προσκεκλημένοι:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($invitedTeachers)}}</p>
                            <p>Καθηγητές</p>
                        </div>
                        <div class="counter">
                            <p class="number">{{count($invitedStudents)}}</p>
                            <p>Φοιτητές</p>
                        </div>
                    </div>
                </div>
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-pencil"></i> Εγγεγραμμένοι:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($teachers)}}</p>
                            <p>Καθηγητές</p>
                        </div>
                        <div class="counter">
                            <p class="number">{{count($students)}}</p>
                            <p>Φοιτητές</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-container col-12 col-xl-6">
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-books"></i> Χειμερινό:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($winterSubjects)}}</p>
                            <p>Μαθήματα</p>
                        </div>
                    </div>
                </div>
                <div class="stats col-md-5">
                    <div class="subtitle">
                        <p><i class="fa-solid fa-books"></i> Εαρινό:</p>
                    </div>
                    <div class="data">
                        <div class="counter">
                            <p class="number">{{count($summerSubjects)}}</p>
                            <p>Μαθήματα</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="bottom-section col-md-12 row">
        <div class="col-xl-6">
            <p class="title">Μαθήματα Τρέχοντος Εξαμήνου</p>
            @if(count($activeSubjects) > 0)
                {{$activeSubjects->links()}}
                <table>
                    <thead>
                    <tr class="tableRow">
                        <th class="colTitles">Τιτλος</th>
                        <th class="colTitles">Περιγραφη</th>
                        <th class="colTitles">Καθηγητής</th>
                        <th class="colTitles">Εξάμηνο</th>
                        <th class="colTitles">Φοιτητές</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activeSubjects as $subject)
                        <tr class="tableRow">
                            <td>
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{$subject->title}}</p></a>
                            </td>
                            <td>
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                </a>
                            </td>
                            <td>
                                <a href="{{route('admin.subject.show' , ['subject' => $subject])}}"><p
                                        class="paragraph">{{count($subject->student)}}</p>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
            @endif
        </div>
        <div class="courses-chart col-xl-6">
            <p class="title">Φοιτητές ανα Μάθημα</p>
            <div class="panel-body">
                <canvas id="canvas" height="280" width="600"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var subjects = <?php echo $subjectData; ?>;
        var students = <?php echo $studentsData; ?>;

        const data = {
            labels: subjects,
            datasets: [{
                label: 'Students',
                backgroundColor: ["#C28CAE","#CCDBDC","#B5AEC0","#667761","#D0ABA0", "#90BAAD", "#94c5cc","#3C787E","#99588C",
                    "#AE729D","#C99CA7","#CDA4A4","#92748B","#615B68","#314345","#B4656F","#797A9E","#F4989C",
                    "#F7B1AB", "#464E47","#7D4F50","#C97064", "#523F38", "#9984D4", "#E9AFA3"
                ],
                data: students
            }]
        };

        window.onload = function () {
            var ctx = document.getElementById("canvas");
            window.myBar = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Students on each subject'
                        }
                    }
                }
            });
        };
    </script>
@endsection
