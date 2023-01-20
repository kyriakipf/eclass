@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="top-section row">
        <div class=" main-info flex justify-start align-baseline">
            <div class="col-md-auto">
                <div class="flex">
                    <p class="title" style="margin-bottom: 0 !important;">{{$subject->title}} </p>
                    <p class="smallTitle mt-2">&ensp; {{$subject->semester->number}}<small>o</small> Εξάμηνο</p>
                </div>
                <p class="paragraph mt-1">
                    @foreach($users as $user)
                        {{$user->name}} {{$user->surname}}
                    @endforeach
                    @if($subject->isPublic)
                        | Κωδικός Μαθήματος: {{$subject->password}}
                    @endif
                    | ECTS: {{$subject->ects}} | {{$subject->type}}
                </p>
            </div>
            <div class="col-md-1 ml-auto">
                <a href="{{route('student.subjects')}}">Επιστροφή</a>
            </div>
        </div>
    </div>
    <div class="bottom-section">
        <div class="row">
            <div class="flex mt-3">
                <div class="summary">
                    <p class="subtitle">Περιγραφή</p>
                    @if($subject->summary != null)
                        <p class="paragraph collapsable">{{$subject->summary}}</p>
                        @if(strlen($subject->summary) > 5300)
                            <span class="show-more">Περισσότερα...</span>
                            <span class="show-less">Λιγότερα...</span>
                        @endif
                    @else
                        <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
                    @endif
                </div>
            </div>
            <div class="flex mt-5 gap-4">
                <div class="col-auto">
                    <a href="{{route('student.subject.file.show', ['subject' => $subject])}}"
                       class=" button bold">Έγγραφα
                        Μαθήματος</a>
                </div>
                <div class="col-auto">
                    <a href="{{route('student.subject.homework.show', ['subject' => $subject])}}"
                       class=" button bold">Εργασίες
                        Μαθήματος</a>
                </div>
                <div class="col-auto">
                    <a href="{{route('student.subject.groups.show', ['subject' => $subject])}}"
                       class=" button bold">Ομάδες
                        Μαθήματος</a>
                </div>
                <div class="col-auto">
                    <a href="{{route('student.subject.email.show', ['subject' => $subject])}}"
                       class=" button bold">Μηνύματα
                        Μαθήματος</a>
                </div>
            </div>
        </div>
{{--        <div class="summary">--}}
{{--            @if($subject->summary == null)--}}
{{--                Δεν υπάρχει διαθέσιμη περιγραφή.--}}
{{--            @endif--}}
{{--            {{$subject->summary}}--}}
{{--        </div>--}}
{{--        <div class="files">--}}
{{--            @if($files != null)--}}
{{--                <p>Αρχεία</p>--}}
{{--                @foreach($files as $file)--}}
{{--                    <div>--}}
{{--                        <a href="{{route('student.subject.file.download', ['file' => basename($file), 'subject' => $subject])}}">{{basename($file)}}</a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @else--}}
{{--                <p>Δεν υπάρχουν διαθέσιμα αρχεία</p>--}}
{{--            @endif--}}
{{--            <h3>Φακέλοι</h3>--}}
{{--            @foreach($folders as $folder)--}}
{{--                <a href="{{route('student.subject.directory.show', ['subject' => $subject ,'folder' => basename($folder)])}}">{{basename($folder)}}</a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="groups">--}}
{{--            <h3>Ομάδες</h3>--}}
{{--            @if(count($subject->groups) != 0)--}}
{{--                @foreach($subject->groups as $group)--}}
{{--                    <div class="group-info">--}}
{{--                        <a @foreach(auth()->user()->student->groups as $gr) @if($gr->id == $group->id ) href="{{route('student.group.show',['group' => $group])}}" @endif @endforeach>{{$group->title}}--}}
{{--                            {{count($group->student)}}/{{$group->capacity}}</a>--}}
{{--                        <input type="checkbox" value="{{$group->id}}" class="group-submit"--}}
{{--                               @foreach(auth()->user()->student->groups as $gr) @if($gr->id == $group->id ) checked--}}
{{--                               @elseif(!is_null(auth()->user()->student->groups)) disabled--}}
{{--                               @endif @if(count($group->student) == $group->capacity) disabled @endif @endforeach>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <div class="homework">--}}
{{--            <h3>Εργασίες</h3>--}}
{{--            @if(count($subject->homework) != 0)--}}
{{--                @foreach($subject->homework as $homework)--}}
{{--                    <div>--}}
{{--                        <a href="{{route('student.homework.show', ['homework' => $homework])}}">{{$homework->title}}</a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
    </div>
@endsection
@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "500px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "500px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
{{--@section('javascripts')--}}
{{--    <script>--}}
{{--        let pending = false;--}}
{{--        $(document).ready(function () {--}}
{{--            $('.group-submit').on('click', function (e) {--}}
{{--                e.preventDefault()--}}
{{--                if (pending) {--}}
{{--                    return--}}
{{--                }--}}
{{--                const checked = $(this)[0].checked;--}}
{{--                const gid = $(this).val()--}}
{{--                if (checked) {--}}
{{--                    registerGroup(gid, $(this))--}}
{{--                } else {--}}
{{--                    unRegisterGroup(gid, $(this))--}}
{{--                }--}}
{{--            })--}}
{{--        });--}}

{{--        function registerGroup(gid, checkbox) {--}}
{{--            pending = true--}}
{{--            $.post("{{route('student.group.register')}}", {id: gid})--}}
{{--                .done(function (res) {--}}
{{--                    toastr.success(res);--}}
{{--                    checkbox.prop("checked", true)--}}
{{--                })--}}
{{--                .error(function (err) {--}}
{{--                    toastr.error(err.responseJSON)--}}
{{--                    checkbox.prop("checked", false)--}}
{{--                })--}}
{{--                .always(function () {--}}
{{--                    pending = false--}}
{{--                })--}}
{{--            ;--}}
{{--            setTimeout(location.reload.bind(location), 1000);--}}
{{--        }--}}

{{--        function unRegisterGroup(cid, checkbox) {--}}
{{--            pending = true--}}
{{--            $.post("{{route('student.group.unregister')}}", {id: cid})--}}
{{--                .done(function (res) {--}}
{{--                    toastr.warning(res);--}}
{{--                    checkbox.prop("checked", false)--}}
{{--                })--}}
{{--                .error(function (err) {--}}
{{--                    toastr.error('Κάτι πήγε στραβά :(');--}}
{{--                    checkbox.prop("checked", true)--}}
{{--                })--}}
{{--                .always(function () {--}}
{{--                    pending = false--}}
{{--                })--}}
{{--            ;--}}
{{--            setTimeout(location.reload.bind(location), 1000);--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}
