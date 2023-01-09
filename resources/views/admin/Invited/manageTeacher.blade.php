@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="bottom-section">
            <div class="row">
                <div class="col-md-5">
                    <form action="{{route('teacher.invite.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="title purple">Προσθήκη Καθηγητή με Προσωπικά Στοιχεία</p>
                        <div class="row addForm bordered">
                            <div class="col-md-6">
                                <div class="input-container focused">
                                    <label for="name" class="input-label">Όνομα</label>
                                    <input type="text" name="name" id="name"
                                           placeholder="Γράψτε εδώ..." required class="text-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-container focused">
                                    <label for="surname" class="input-label">Επίθετο</label>
                                    <input type="text" name="surname" id="surname" class="text-input"
                                           placeholder="Γράψτε εδώ..." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-container focused">
                                    <label for="email" class="input-label">E-mail</label>
                                    <input type="text" name="email" id="email" class="text-input"
                                           placeholder="Γράψτε εδώ..." required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="select-container focused">
                                    <label class="input-label" for="domain">Τμήμα:</label>
                                    <select class="select-input" name="domain" id="domain" required>
                                        <option value="" selected disabled>Επιλέξτε Τμήμα</option>
                                        @foreach($domains as $domain)
                                            <option value="{{$domain->id}}">{{$domain->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="select-container focused">
                                    <label class="input-label" for="job_role">Ιδιότητα:</label>
                                    <select class="select-input" name="job_role" id="job_role" required>
                                        <option value="" selected disabled>Επιλέξτε Ιδιότητα</option>
                                        @foreach($job_roles as $job_role)
                                            <option value="{{$job_role->id}}">{{$job_role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 btn-container">
                                <button type="submit" class="button bold">
                                    <span>ΠΡΟΣΘΗΚΗ</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <form action="{{route('teacher.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="title purple">Προσθήκη Καθηγητών μέσω Excel</p>
                        <div class="row addForm bordered">
                            <div class="col-md-12">
                                <div class="input-container focused">
                                    <label for="file" class="input-label">Επιλέξτε Αρχείο</label>
                                    <input type="file" name="students" id="file" class="file-input" required/>
                                </div>
                            </div>
                            <div class="col-md-4 download--btn-container">
                                <a href="{{route('template.download', [ 'name'=>'teacherTemplate'])}}"
                                   class="download button bold" download><i class="fa-light fa-download"></i>ΛΗΨΗ
                                    TEMPLATE</a>
                            </div>
                            <div class="col-md-4 btn-container">
                                <button type="submit" class="button bold">ΠΡΟΣΘΗΚΗ</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    @if(count($entities) != 0)
                        <a href="{{route('teacher.mass.process')}}"><i class="fa-regular fa-envelope "></i>Μαζική
                            Πρόσκληση</a>
                        <table>
                            <thead>
                            <tr class="tableRow colTitles">
                                <th>Όνομα</th>
                                <th>Επίθετο</th>
                                <th>Email</th>
                                <th>Τμήμα</th>
                                <th>Ιδιοτητα</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entities as $entity)
                                <tr class="tableRow">
                                    <td class="col-md-2">
                                        <p class="name paragraph">{{$entity->name}}</p>
                                    </td>
                                    <td class="col-md-2">
                                        <p class="paragraph">{{$entity->surname}}</p>
                                    </td>
                                    <td class="col-md-2">
                                        <p class="paragraph">{{$entity->email}}</p>
                                    </td>
                                    <td class="col-md-2">
                                        <p class="paragraph">{{$entity->domain->name}}</p>
                                    </td>
                                    <td class="col-md-2">
                                        <p class="paragraph">{{$entity->job_role->name}}</p>
                                    </td>
                                    <td>
                                        <a href="{{route('teacher.process' , $entity)}}"><i
                                                class="fa-regular fa-envelope"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('teacher.invite.show' , $entity)}}"><i
                                                class="fa-regular fa-pencil"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{route('teacher.invite.delete' , $entity)}}"><i
                                                class="fa-regular fa-trash-can"></i></a>
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
    </div>
@endsection
