@extends('layouts.teacher')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
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
            @if(count($subjects) != 0)
                {{$subjects->links()}}
                <div class="accordionTitles flex" style="padding: 1rem 1.25rem;">
                    <div class="flex colTitles" style="flex: 1 0 0%;">
                        <div class="col-3 ">Όνομα</div>
                        <div class="col-2">Εξάμηνο</div>
                        <div class="col-2 ">Εργασίες</div>
                        <div class="col-3">Ομάδα</div>
                        <div class="col-2">Ώρα Ομάδας</div>
                    </div>
                </div>
                <div class="accordion accordion-flush" id="accordion">
                    @foreach($subjects as $sub)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading{{$loop->index}}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{$loop->index}}" aria-expanded="false"
                                        aria-controls="flush-collapse{{$loop->index}}"
                                        @if(count($student->homework()->where('subject_id', '=', $sub->id)->get()) == 0) disabled @endif>
                                <span class="flex w-full">
                                    <span class="col-3">{{$sub->title}}</span>
                                    <span class="col-2">{{$sub->semester->number}}</span>
                                    <span class="col-2 ">{{count($student->homework()->where('subject_id', '=', $sub->id)->get())}}
                                        / {{count($sub->homework)}}</span>
                                    <span class="col-3">
                                        @if(!$student->groups()->where('subject_id', '=', $sub->id)->first())
                                            <span class="ml-6">-</span>
                                        @else
                                            {{$student->groups()->where('subject_id', '=', $sub->id)->first()->title}}
                                        @endif
                                    </span>
                                    <span class="col-2">
                                        @if(!$student->groups()->where('subject_id', '=', $sub->id)->first())
                                            <span class="ml-12">-</span>
                                        @else
                                            {{$student->groups()->where('subject_id', '=', $sub->id)->first()->time}}
                                        @endif
                                    </span>
                                </span>
                                </button>
                            </h2>
                            @if(count($student->homework()->where('subject_id', '=', $sub->id)->get()) > 0)
                                <div id="flush-collapse{{$loop->index}}" class="accordion-collapse collapse"
                                     aria-labelledby="flush-heading{{$loop->index}}"
                                     data-bs-parent="#accordion">
                                    <span class="accordion-body"  style="padding: 1rem 1.25rem;display: block">
                                        <span class="flex colTitles  mb-2" style="flex: 1 0 0%;">
                                            <span class="col-3">Όνομα Εργασίας</span>
                                            <span class="col-2">Αρχείο</span>
                                        </span>
                                        @foreach($student->homework()->where('subject_id', '=', $sub->id)->get() as $hw)
                                            <span class="flex">
                                                <span class="col-3">{{$hw->title}}</span>
                                                <span class="col-2"><a href="{{route('teacher.homework.studentfile.download', ['student' => $student ,'homework' => $hw])}}">{{$hw->students()->where('student_id', '=', $student->id)->first()->pivot->filename}} </a>
                                                    </span>
                                                </span>
                                        @endforeach
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

