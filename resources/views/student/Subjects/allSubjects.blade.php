@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section">
        </div>
        <div class="bottom-section">
            <p class="title purple">Μαθήματα</p>
            <div class="row">
                <div class="col-md-12">
                    <table>
                        @if(count($subjects) != 0)
                            <thead>
                            <tr class="tableRow colTitles">
                                <th class="subtitle">Τιτλος</th>
                                <th class="subtitle">Περιγραφη</th>
                                <th class="subtitle">Εξάμηνο</th>
                                <th class="subtitle">Κωδικός</th>
                                <th class="subtitle">Εγγραφή</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr class="tableRow">

                                    <td class="col-md-3">
                                        <p class="paragraph">{{$subject->title}}</p>
                                    </td>
                                    <td class="col-md-5">
                                        <p class="paragraph">{{substr($subject->summary, 0,130)}}...</p>
                                    </td>
                                    <td class="col-md-3">
                                        <p class="paragraph">{{$subject->semester->number}}ο Εξάμηνο</p>
                                    </td>
                                    <td>
                                        @if(!is_null($subject->password))
                                            <input type="text" class="course-password" id="pass-{{$subject->id}}">
                                        @endif
                                    </td>
                                    <td class="col-1 text-center">
                                        <input type="checkbox" value="{{$subject->id}}" class="course-submit" @foreach(auth()->user()->student->subject as $sub) @if($sub->id == $subject->id ) checked @endif @endforeach>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
                            @endif
                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        let pending = false;
        $(document).ready(function () {
            console.log('loaded')

            $('.course-submit').on('click', function (e) {
                e.preventDefault()
                // console.log(e)
                if (pending) {
                    console.log('aborted')
                    return
                }
                const checked = $(this)[0].checked;
                const cid = $(this).val()
                const cpass = $(`#pass-${cid}`).val()
                if(cpass === '') {
                    $(this).prop( "checked", false )
                    toastr.warning('Παρακαλώ συμπληρώστε τον κωδικό του μαθήματος')
                    return
                }
                if (checked) {
                    registerCourse(cid, cpass, $(this))
                }
                else{
                    unRegisterCourse(cid, $(this))
                }
            })
        });

        function registerCourse(cid, cpass, checkbox){
            pending = true
            $.post( "{{route('student.subject.register')}}", { id: cid, pass: cpass })
                .done(function( res ) {
                    console.log(res)
                    toastr.success(res);
                    checkbox.prop( "checked", true )
                })
                .error(function (err){
                    toastr.error(err.responseJSON)
                    checkbox.prop( "checked", false )
                })
                .always(function (){
                    pending = false
                })

            ;
        }

        function unRegisterCourse(cid, checkbox){
            pending = true
            $.post( "{{route('student.subject.unregister')}}", { id: cid})
                .done(function( res ) {
                    toastr.warning(res);
                    checkbox.prop( "checked", false )
                })
                .error(function (err){
                    toastr.error('Κάτι πήγε στραβά :(');
                    checkbox.prop( "checked", true )
                })
                .always(function (){
                    pending = false
                })
            ;
        }
    </script>
@endsection

