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
                    <a href="{{route('subject.file.show', ['subject' => $subject])}}">Επιστροφή στον Αρχικό Κατάλογο</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row gap-3">
                <div class="col-lg-7 col-md-9">
                    <div class="folder-files">
                        <div class="flex folder-files-row">
                            <div class="type">ΤΥΠΟΣ</div>
                            <div class="name">ΟΝΟΜΑ</div>
                            <div class="date">ΗΜΕΡΟΜΗΝΙΑ</div>
                            <div class="size">ΜΕΓΕΘΟΣ</div>
                            <div class="download">ΛΗΨΗ</div>
                            <div class="delete"></div>
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
                                        <a href="{{route('subject.directory.show', ['subject' => $subject ,'folder' => basename($f)])}}">
                                            {{basename($f)}}
                                        </a>
                                    </div>
                                    <div class="size">&emsp;&emsp;&emsp;-</div>
                                    <div class="date">&emsp;&emsp;-</div>
                                    <div class="download">-</div>
                                    <div class="delete"><a
                                            href="{{route('teacher.subject.directory.delete', ['subject' => $subject, 'folder' => $f])}}"><i class="fa-solid fa-trash-can"></i></a></div>
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
                                        <a href="{{route('subject.file.download', ['subject' => $subject ,'file' => $file->filename])}}"><i
                                                class="fa-regular fa-download"></i></a>
                                    </div>
                                    <div class="delete"><a href="{{route('teacher.subject.file.delete', ['subject' => $subject, 'file' => $file])}}"><i class="fa-solid fa-trash-can"></i></a></div>

                                </div>
                            @endforeach
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="flex mb-3 mt-[13px] " style="justify-content: space-between">
                    <p id="folder-form-toggle" class="purple"><i class="fa-light fa-folder-plus fa-lg"></i>&nbsp;Δημιουργία
                        Φακέλου</p>
                    <p id="files-form-toggle" class="purple"><i class="fa-light fa-file-plus fa-lg"></i>&nbsp;Μεταφόρτωση
                        Αρχείου</p>
                </div>
                <form id="folder-form" class="flex mt-5 pt-1 d-none gap-4"
                      action="{{route('subject.subdirectory.store',['subject' => $subject, 'folder' => $folder])}}"
                      method="post">
                    @csrf
                    <div class=" col-5">
                        <label for="title" class="input-label">Όνομα Φακέλου</label>
                        <input name="title" id="title" type="text"
                               placeholder="Γράψτε εδώ..." class="text-input">
                    </div>

                    <div class="btn-container col-3 mt-2">
                        <button type="submit" class="button bold ">Δημιουργία Φακέλου</button>
                    </div>
                    <p class="paragraph">Εάν δημιουργήσετε φάκελο με όνομα που ήδη υπάρχει, ο παλιός φάκελος θα αντικατασταθεί.</p>
                </form>
                <form id="files-form" class="flex mt-5 pt-1 d-none gap-4"
                      action="{{route('subject.file.store',['subject' => $subject, 'folder' => basename($folder)])}}"
                      method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-5 mt-8 small-file-input">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="btn-container col-3 mt-2">
                        <button type="submit" class="button bold ">Προσθήκη Αρχείου</button>
                    </div>
                    <p class="paragraph">Εάν ανεβάσετε αρχείο με όνομα που ήδη υπάρχει, το παλιό αρχείο θα αντικατασταθεί.</p>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('javascripts')
    <script>
        const cc = $.noConflict();
        cc(document).ready(function () {
            const folderToggle = cc('#folder-form-toggle')
            const filesToggle = cc('#files-form-toggle')
            const folderForm = cc('#folder-form')
            const filesForm = cc('#files-form')

            folderToggle.on('click', function () {
                folderForm.removeClass('d-none')
                filesForm.addClass('d-none')
            })

            filesToggle.on('click', function () {
                filesForm.removeClass('d-none')
                folderForm.addClass('d-none')
            })


        });
    </script>
@endsection
