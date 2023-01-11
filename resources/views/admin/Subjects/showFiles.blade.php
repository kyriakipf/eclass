@extends('layouts.admin')
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
                        <p class="title" style="margin-bottom: 0 !important;">{{$subject->title}} </p>
                        <p class="smallTitle mt-2">&ensp; {{$subject->semester->number}}<small>o</small> Εξάμηνο</p>
                    </div>
                    <p class="paragraph mt-1">
                        @foreach($users as $user)
                            {{$user->user->name}} {{$user->user->surname}}
                        @endforeach
                        @if($subject->isPublic)
                            | Κωδικός Μαθήματος: {{$subject->password}}
                        @endif
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('admin.subjects')}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="flex mt-3">

                </div>

                <h3>Φακέλοι</h3>
                <div class="folder-files">
                    <div class="flex">
                        <div class="type">TYPE</div>
                        <div class="name">NAME</div>
                        <div class="date">DATE</div>
                    </div>
                    @foreach($folders as $folder)
                        <a href="{{route('admin.subject.directory.show', ['subject' => $subject ,'folder' => basename($folder)])}}">
                            <div class="flex">
                                <div class="type">FOLDER</div>
                                <div class="name">{{basename($folder)}}</div>
                                <div class="date"></div>
                            </div>
                        </a>

                    @endforeach
                    @foreach($files as $file)
                        <a href="{{route('admin.subject.file.download', ['subject' => $subject ,'file' => basename($file)])}}">
                            <div class="flex">
                                <div class="type">FILE</div>
                                <div class="name">{{basename($file)}}</div>
                                <div class="date"></div>
                            </div>
                        </a>
                    @endforeach
                </div>


            </div>
            <h3>Arxeia</h3>
            @foreach($files as $file)
                <a href="{{route('admin.subject.file.download', ['subject' => $subject ,'file' => basename($file)])}}">{{basename($file)}}</a>

            @endforeach

        </div>
    </div>
    </div>
@endsection

@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "100px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "100px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
