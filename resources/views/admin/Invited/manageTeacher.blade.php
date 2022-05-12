@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <p class="header">Προσθήκη Καθηγητή</p>
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('teacher.invite.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="title">Προσθήκη Καθηγητή με Προσωπικά Στοιχεία</p>
                    <div class="row addForm bordered">
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="name" class="input-label">Όνομα</label>
                                <input type="text" name="name" id="name" class="text-input"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="surname" class="input-label">Επίθετο</label>
                                <input type="text" name="surname" id="surname" class="text-input"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="email" class="input-label">E-mail</label>
                                <input type="text" name="email" id="email" class="text-input"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-3 btn-container">
                            <button type="submit" class="button light">
                                <span>ΠΡΟΣΘΗΚΗ</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{route('teacher.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="title">Προσθήκη Καθηγητών μέσω Excel</p>
                    <div class="row addForm bordered">
                        <div class="col-md-12">
                            <div class="input-container focused">
                                <label for="file" class="input-label">Επιλέξτε Αρχείο</label>
                                <input type="file" name="teachers" id="file" class="file-input" required/>
                            </div>
                        </div>
                        <div class="col-md-3 btn-container">
                            <button type="submit" class="button light">ΠΡΟΣΘΗΚΗ</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <table class="table-body">
                    <thead>
                    <tr class="tableRow colTitles">
                        <th class="name title">Όνομα</th>
                        <th class="surname title">Επίθετο</th>
                        <th class="email title">Email</th>
                        <th class="domain title">Τμήμα</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <p class="name paragraph">{{$entity->name}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->surname}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->email}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->domain->name}}</p>
                            </td>
                            <td>
                                <a href="{{route('teacher.process' , $entity)}}" class="invite"><i class="fa-regular fa-envelope"></i></a>
                            </td>
                            <td>
                                <a href="{{route('teacher.invite.show' , $entity)}}" class="edit"><i class="fa-regular fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="{{route('teacher.invite.delete' , $entity)}}" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{route('teacher.mass.process')}}"><i class="fa-regular fa-envelope"></i>Mass Invite</a>
            </div>
        </div>
    </div>
@endsection
