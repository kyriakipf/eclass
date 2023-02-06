@extends('layouts.teacher')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Στατιστικά</p>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <div class="row">
                    <div class="courses-chart col-7 col-xl-7">
                        <p class="smallTitle">Φοιτητές ανα Μάθημα</p>
                        <div class="panel-body">
                            <canvas id="allSubjects" height="280" width="600"></canvas>
                        </div>
                    </div>
                    <div class="courses-chart col-6 col-xl-6 mt-5">
                        <p class="smallTitle">Φοιτητές ανα Εξάμηνο</p>
                        <div class="panel-body">
                            <canvas id="semesterStudents" height="280" width="600"></canvas>
                        </div>
                    </div>
                    <div class="courses-chart col-6 col-xl-6 mt-5">
                        <p class="smallTitle">Εργασίες ανα Εξάμηνο</p>
                        <div class="panel-body">
                            <canvas id="hwSemester" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        var allSubjects = <?php echo $allSubjects; ?>;
        var allStudents = <?php echo $allStudents; ?>;

        const data = {
            labels: allSubjects,
            datasets: [{
                label: 'Φοιτητές',
                backgroundColor: ["#C28CAE", "#CCDBDC", "#B5AEC0", "#667761", "#D0ABA0", "#90BAAD", "#94c5cc", "#3C787E", "#99588C",
                    "#AE729D", "#C99CA7", "#CDA4A4", "#92748B", "#615B68", "#314345", "#B4656F", "#797A9E", "#F4989C",
                    "#F7B1AB", "#464E47", "#7D4F50", "#C97064", "#523F38", "#9984D4", "#E9AFA3"
                ],
                data: allStudents
            }]
        };

        var allSemesters = <?php echo $allSemesters; ?>;
        var semesterStudents = <?php echo $semesterStudents; ?>;

        const semesterData = {
            labels: allSemesters,
            datasets: [{
                label: 'Φοιτητές',
                data: semesterStudents,
                backgroundColor: ["#C28CAE", "#C28CAE", "#C28CAE", "#C28CAE", "#C28CAE", "#C28CAE", "#C28CAE", "#C28CAE"]
            }]
        };

        var hw = <?php echo $hwData; ?>;

        const hwData = {
            labels: allSemesters,
            datasets: [{
                label: 'Εργασίες',
                data: hw,
                backgroundColor: [ "#CCDBDC"]
            }]
        }

        window.onload = function () {
            var ctx = document.getElementById("allSubjects");
            window.myPie = new Chart(ctx, {
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


            var semesterStudentsChart = document.getElementById("semesterStudents");
            window.myBar = new Chart(semesterStudentsChart, {
                type: 'bar',
                data: semesterData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Students on each semester'
                        }
                    }
                }
            });

            var semesterHwChart = document.getElementById("hwSemester");
            window.myLine = new Chart(semesterHwChart, {
                type: 'line',
                data: hwData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                            text: 'Homework on each semester'
                        }
                    }
                }
            });
        };
    </script>
@endsection
