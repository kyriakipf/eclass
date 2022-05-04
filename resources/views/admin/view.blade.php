@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/adminView.css")}}">
@endsection
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="row">
        <div class="mainInfo col-md-12">

            {{--                        Kane sundesh gia na ferneis to onoma tou rolou--}}
            <div class="table-header">
                <p>View {{$entities[0]->user->role_id}}</p>
            </div>
            <div class="table-body">
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th class="name">Όνομα</th>
                        <th class="surname">Επίθετο</th>
                        <th class="email">Email</th>
                        <th class="domain">Τμήμα</th>
                        <th>Κατάσταση</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <p class="name">{{$entity->user->name}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->user->surname}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->user->email}}</p>
                            </td>
                            <td class="col-md-3">
                                <p>{{$entity->domain->name}}</p>
                            </td>
                            <td>
                                <p>Status</p>
                            </td>
                            <td>
                                <a  @if($entity->user->role_id == 2) href="{{route('teacher.show' , $entity)}}" @elseif($entity->user->role_id == 3) href="{{route('student.show' , $entity)}}" @endif>Επεξεργασία</a>
                            </td>
                            <td>
                                <a @if($entity->user->role_id == 2) href="{{route('teacher.delete' , $entity)}}" @elseif($entity->user->role_id == 3) href="{{route('student.delete' , $entity)}}" @endif>Διαγραφή</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
