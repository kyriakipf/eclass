@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="bottom-section">
        <div class="row">
            <a href="{{route('student.subjects')}}">Back</a>
            <div class=" main-info">
                <h1>{{$subject->title}}</h1>
                @foreach($users as $user)
                    <h3>{{$user->name}} {{$user->surname}}</h3>
                @endforeach
                <p>{{$subject->semester->number}}o Εξάμηνο
                    @if($subject->isPublic)
                        - Κωδικός: {{$subject->password}}
                    @endif
                </p>
            </div>
            <div class="summary">
                @if($subject->summary == null)
                    Δεν υπάρχει διαθέσιμη περιγραφή.
                @endif
                {{$subject->summary}}
            </div>
            <div class="files">
                @if($files != null)
                    <p>Αρχεία</p>
                    @foreach($files as $file)
                        <div>
                            <a href="{{route('student.subject.file.download', ['file' => basename($file), 'subject' => $subject])}}">{{basename($file)}}</a>
                        </div>
                    @endforeach
                @else
                    <p>Δεν υπάρχουν διαθέσιμα αρχεία</p>
                @endif
                <h3>Φακέλοι</h3>
                @foreach($folders as $folder)
                    <a href="{{route('student.subject.directory.show', ['subject' => $subject ,'folder' => basename($folder)])}}">{{basename($folder)}}</a>
                @endforeach
            </div>
            <div class="groups">
                <h3>Ομάδες</h3>
                @if(count($subject->groups) != 0)
                    @foreach($subject->groups as $group)
                        <div class="group-info">
                            <a href="{{route('student.group.show',['group' => $group])}}">{{$group->title}}
                                {{count($group->student)}}/{{$group->capacity}}</a>
                            <input type="checkbox" value="{{$group->id}}" class="group-submit"
                                   @foreach(auth()->user()->student->groups as $gr) @if($gr->id == $group->id ) checked @endif @endforeach>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="homework">
                <h3>Εργασίες</h3>
                @if(count($subject->homework) != 0)
                    @foreach($subject->homework as $homework)
                        <div>
                            <a href="{{route('student.homework.show', ['homework' => $homework])}}">{{$homework->title}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    <script>
        let pending = false;
        $(document).ready(function () {
            $('.group-submit').on('click', function (e) {
                e.preventDefault()
                if (pending) {
                    return
                }
                const checked = $(this)[0].checked;
                const gid = $(this).val()
                if (checked) {
                    registerGroup(gid, $(this))
                } else {
                    unRegisterGroup(gid, $(this))
                }
            })
        });

        function registerGroup(gid, checkbox) {
            pending = true
            $.post("{{route('student.group.register')}}", {id: gid})
                .done(function (res) {
                    toastr.success(res);
                    checkbox.prop("checked", true)
                })
                .error(function (err) {
                    toastr.error(err.responseJSON)
                    checkbox.prop("checked", false)
                })
                .always(function () {
                    pending = false
                })

            ;
        }

        function unRegisterGroup(cid, checkbox) {
            pending = true
            $.post("{{route('student.group.unregister')}}", {id: cid})
                .done(function (res) {
                    toastr.warning(res);
                    checkbox.prop("checked", false)
                })
                .error(function (err) {
                    toastr.error('Κάτι πήγε στραβά :(');
                    checkbox.prop("checked", true)
                })
                .always(function () {
                    pending = false
                })
            ;
        }
    </script>
@endsection
