@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/search.css")}}">
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
                        <p class="title" style="margin-bottom: 0 !important;">Ομάδες</p>
                    </div>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('student.subject.show' , ['subject' => $subject])}}">Επιστροφή</a>
                </div>

            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="col-md-12">
                    @if(count($groups) != 0)
                        <table>
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="sort">Τιτλος</th>
                                <th class="sort">Περιγραφη</th>
                                <th class="sort">Μάθημα</th>
                                <th class="sort">Ώρα</th>
                                <th class="sort">Αρ. Θέσεων</th>
                                <th class="sort">Εγγραφή</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr class="tableRow">
                                    <td >
                                        <a href="{{route('student.group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                            <p class="paragraph">{{$group->title}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                            <p
                                                class="paragraph">{{substr($group->summary, 0,130)}}...</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                            <p
                                                class="paragraph">{{$group->subject->title}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                            <p
                                                class="paragraph">{{$group->time}}</p></a>
                                    </td>
                                    <td >
                                        <a href="{{route('student.group.show', ['group' => $group, 'subject' => $group->subject])}}">
                                            <p
                                                class="paragraph">{{count($group->student)}}/{{$group->capacity}}</p>
                                        </a>
                                    </td>
                                    <td>
                                        <input type="checkbox" value="{{$group->id}}" class="group-submit"
                                               @foreach(auth()->user()->student->groups as $gr) @if($gr->id == $group->id ) checked
                                               @elseif(!is_null(auth()->user()->student->groups)) disabled
                                               @endif @if(count($group->student) == $group->capacity) disabled @endif @endforeach>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$groups->links()}}
                    @else
                        <div class="tableRow">
                            <p class="paragraph">Δεν
                                υπάρχουν διαθέσιμες ομάδες.</p>
                        </div>

                    @endif
                </div>
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
            setTimeout(location.reload.bind(location), 1000);
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
            setTimeout(location.reload.bind(location), 1000);
        }
    </script>
@endsection
