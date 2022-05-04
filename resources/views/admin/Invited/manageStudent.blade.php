@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminAdd.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <h2>Προσθήκη Μαθητή</h2>
        <div class="row">
            <div class="col-md-6">
                <form action="{{route('student.import')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row addForm">
                        <div class="col-md-12">
                            <div class="input-container focused">
                                <label for="file" class="label-text">Επιλέξτε Αρχείο</label>
                                <input type="file" name="students" id="file" class="file"/>
                            </div>
                        </div>
                        <div class="col-md-3 btn-container">
                            <button type="submit" class="save-btn">ΠΡΟΣΘΗΚΗ</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{route('student.invite.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row addForm">
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="name" class="label-text">Όνομα</label>
                                <input type="text" name="name" id="name"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="surname" class="label-text">Επίθετο</label>
                                <input type="text" name="surname" id="surname"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="email" class="label-text">E-mail</label>
                                <input type="text" name="email" id="email"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-container focused">
                                <label for="email" class="label-text">Αριθμός Μητρώου</label>
                                <input type="text" name="am" id="am"
                                       placeholder="Γράψτε εδώ..." required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="select-container focused">
                                <label class="label-text" for="unit_id">Τμήμα:</label>
                                <select class="my-select" name="domain" id="domain" required>
                                    <option value="" selected disabled>Επιλέξτε Τμήμα</option>
                                    @foreach($domains as $domain)
                                        <option value="{{$domain->id}}">{{$domain->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 btn-container">
                            <button type="submit" class="save-btn">
                                <span>ΠΡΟΣΘΗΚΗ</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th class="name">Όνομα</th>
                        <th class="surname">Επίθετο</th>
                        <th class="email">Email</th>
                        <th class="domain">Τμήμα</th>
                        <th class="domain">Αριθμός Μητρώου</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <p class="name">{{$entity->name}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->surname}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->email}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->domain->name}}</p>
                            </td>
                            <td class="col-md-2">
                                <p>{{$entity->am}}</p>
                            </td>
                            <td>
                                <a href="{{route('student.process' , $entity)}}"><i class="fa-regular fa-envelope"></i></a>
                            </td>
                            <td>
                                <a href="{{route('student.invite.show' , $entity)}}"><i class="fa-regular fa-pencil"></i></a>
                            </td>
                            <td>
                                <a href="{{route('student.invite.delete' , $entity)}}"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{route('student.mass.process')}}"><i class="fa-regular fa-envelope">Mass Invite</i></a>
            </div>
        </div>

    </div>
@endsection
