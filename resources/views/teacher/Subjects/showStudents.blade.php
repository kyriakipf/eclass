@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">Φοιτητές</p>
                    </div>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('subject.show' , ['subject' => $subject])}}">Επιστροφή</a>
                </div>

            </div>
        </div>
        <div class="bottom-section">
            <div class="row gap-3">
                @if(count($students) != 0)
                    <div>
                        {{$students->links()}}
                    </div>
                    <table>
                        <thead>
                        <tr class="tableRow colTitles">
                            <th>Όνομα</th>
                            <th>Επίθετο</th>
                            <th>Email</th>
                            <th>Μητρώο</th>
                            <th>Εργασίες</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr class="tableRow cursor-pointer"
                                onclick="window.location='{{route('teacher.student.show', ['student' => $student, 'subject' => $subject])}}'">
                                <td>
                                    <p class="name paragraph">{{$student->user->name}}</p>
                                </td>
                                <td>
                                    <p class="paragraph">{{$student->user->surname}}</p>
                                </td>
                                <td>
                                    <p class="paragraph">{{$student->user->email}}</p>
                                </td>
                                <td>
                                    <p class="paragraph">{{$student->am}}</p>
                                </td>
                                <td>
                                    <p class="paragraph">{{count($student->homework()->where('subject_id', '=', $subject->id)->get())}}
                                        / {{count($subject->homework)}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="paragraph">Δεν εχουν προσκληθεί χρήστες.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

