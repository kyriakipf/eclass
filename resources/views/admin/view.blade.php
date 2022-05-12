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
            <div class="table-header">
                <p class="header">Προβολή</p>
                <hr>
            </div>
            <div class="table-body">
                <table>
                    <thead>
                    <tr class="tableRow colTitles">
                        <th class="name title">Όνομα</th>
                        <th class="surname title">Επίθετο</th>
                        <th class="email title">Email</th>
                        <th class="domain title">Τμήμα</th>
                        <th> </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr class="tableRow">
                            <td class="col-md-3">
                                <p class="name paragraph">{{$entity->user->name}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->user->surname}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->user->email}}</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">{{$entity->domain->name}}</p>
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
