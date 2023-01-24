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
                        <p class="title"
                           style="margin-bottom: 0 !important;">{{$student->user->name}} {{$student->user->surname}}</p>
                    </div>
                    <p class="paragraph mt-1">
                        Αρ.Μητρώου: {{$student->am}} | Email: {{$student->user->email}}
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('subject.students.show' , ['subject' => $subject])}}">Επιστροφή</a>
                </div>

            </div>
        </div>
        <div class="bottom-section">
            <div class="row gap-3">
                @if(count($subjects) != 0)
                    <div>
                        {{$subjects->links()}}
                    </div>
                    <p class="subtitle">Μαθήματα</p>
                    <table>
                        <thead>
                        <tr class=" colTitles ">
                            <th>Όνομα</th>
                            <th>Εξάμηνο</th>
                            <th>Εργασίες</th>
                            <th>Ομάδα</th>
                            <th>Ώρα Ομάδας</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $sub)
                            <tr>
                                <td>
                                    <p class="name paragraph">{{$sub->title}}</p>
                                </td>
                                <td>
                                    <p class="paragraph">{{$sub->semester->number}}<small>ο</small> Εξάμηνο</p>
                                </td>
                                <td>
                                    @if(count($student->homework()->where('subject_id', '=', $sub->id)->get()) <= 0)
                                        -
                                    @else
                                        <ul>
                                            @foreach($student->homework()->where('subject_id', '=', $sub->id)->get() as $hw)
                                                <li>
                                                    <span>{{$hw->title}}</span>
                                                    <span
                                                        title="{{$hw->students()->where('student_id', '=', $student->id)->first()->pivot->filename}}"><a
                                                            href="{{route('teacher.homework.studentfile.download', ['student' => $student ,'homework' => $hw])}}"><i
                                                                class="purple fa-regular fa-file-arrow-down fa-lg ml-2"></i></a>
                                                    </span>
                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif
                                </td>
                                <td>
                                    <p class="paragraph">@if(!$student->groups()->where('subject_id', '=', $sub->id)->first())
                                            -
                                        @else
                                            {{$student->groups()->where('subject_id', '=', $sub->id)->first()->title}}
                                        @endif</p>
                                </td>
                                <td>
                                    <p class="paragraph">@if(!$student->groups()->where('subject_id', '=', $sub->id)->first())
                                            -
                                        @else
                                            {{$student->groups()->where('subject_id', '=', $sub->id)->first()->time}}
                                        @endif</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="paragraph">Δεν υπάρχουν μαθήματα.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

