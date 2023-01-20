@extends('layouts.student')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    student dashboard
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
                <div class="col-md-2 ml-auto">
                    <a href="{{route('student.subject.file.show', ['subject' => $subject])}}">Επιστροφή στον Αρχικό
                        Κατάλογο</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row gap-3">
                <div class="col-lg-7 col-md-9">
                    <div class="flex folder-files-row">
                        <div class="type">ΤΥΠΟΣ</div>
                        <div class="name">ΟΝΟΜΑ</div>
                        <div class="date">ΗΜΕΡΟΜΗΝΙΑ</div>
                        <div class="size">ΜΕΓΕΘΟΣ</div>
                        <div class="download">ΛΗΨΗ</div>
                    </div>
                    @if(count($subfolders) <= 0 && count($files) <= 0)
                        <div class="flex folder-files-row">
                            <div>
                                <p class="ml-4 paragraph">Δεν υπάρχουν διαθέσιμα έγγραφα</p>
                            </div>
                        </div>
                    @else
                        @foreach($subfolders as $f)

                            <div class="flex folder-files-row">
                                <div class="type"><i class="purple fa-regular fa-folder-open"></i></div>
                                <div class="name">
                                    <a href="{{route('student.subject.directory.show', ['subject' => $subject ,'folder' => basename($f)])}}">
                                        {{basename($f)}}
                                    </a>
                                </div>
                                <div class="size">&emsp;&emsp;&emsp;-</div>
                                <div class="date">&emsp;&emsp;-</div>
                                <div class="download">-</div>
                            </div>

                        @endforeach
                        @foreach($files as $file)

                            <div class="flex folder-files-row">
                                <div class="type"><i class="purple fa-regular fa-file-lines"></i></div>

                                <div class="name"><a
                                        href="{{asset('storage/' . $file->filepath . DIRECTORY_SEPARATOR . $file->filename)}}"
                                        target="_blank">{{$file->filename}}</a></div>
                                <div class="date">
                                    &emsp;{{\Carbon\Carbon::parse($file->created_at)->format('d-m-Y')}}</div>
                                <div class="size">&ensp;{{$sizes[$loop->index]}} KB</div>
                                <div class="download">
                                    <a href="{{route('student.subject.file.download', ['subject' => $subject ,'file' => $file->filename])}}"><i
                                            class="fa-regular fa-download"></i></a>
                                </div>
                            </div>
                        @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
