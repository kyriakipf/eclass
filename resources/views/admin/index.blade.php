@extends('layouts.admin')
@section('header')
    admin dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="card-container row">
            <div class="top-section row col-md-12">
                <div style="background-image: url({{ asset('assets/img/building.svg') }})" class="banner col-md-6">
                </div>
                <div class="stats col-md-6">
                    <div class="titles row">
                        <p class="subtitle col-md-6">Προσκεκλημένοι</p>
                        <p class="subtitle col-md-6">Εγγεγραμμένοι</p>
                    </div>
                    <div class="numbers row">
                        <div class="invited row col-md-6">
                            <p class="paragraph col-md-6">{{count($invitedTeachers)}}</p>
                            <p class="paragraph col-md-6">{{count($invitedStudents)}}</p>
                        </div>
                        <div class="registered row col-md-6">
                            <p class="paragraph col-md-6">{{count($teachers)}}</p>
                            <p class="paragraph col-md-6">{{count($students)}}</p>
                        </div>
                    </div>
                    <div class="categories row">
                        <div class="invited row col-md-6">
                            <p class="subtitle col-md-6">Καθηγητές</p>
                            <p class="subtitle col-md-6">Φοιτητές</p>
                        </div>
                        <div class="registered row col-md-6">
                            <p class="subtitle col-md-6">Καθηγητές</p>
                            <p class="subtitle col-md-6">Φοιτητές</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-section col-md-12 row">
                <div class="courses col-md-6">
                    <p class="title">Μαθήματα Εξαμήνου</p>
                    <table>
                        <thead>
                        <tr class="tableRow colTitles">
                            <th class="name title">ΤΙΤΛΟΣ</th>
                            <th class="email title">ΚΑΘΗΓΗΤΗΣ</th>
                            <th class="domain title">ΕΓΓΕΓΡΑΜΜΕΝΟΙ ΦΟΙΤΗΤΕΣ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="tableRow">
                                <td class="col-md-3">
                                    <p class="name paragraph">Λογικός Προγραμματισμός</p>
                                </td>
                                <td class="col-md-3">
                                    <p class="paragraph">Κωνσταντίνος Αλεύρης</p>
                                </td>
                                <td class="col-md-3">
                                    <p class="paragraph">1023</p>
                                </td>
                            </tr>
                        <tr>
                            <td class="col-md-3">
                                <p class="name paragraph">Μαθηματική Ανάλυση & Στοιχεία Γραμμικής Άλγεβρας</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">Κωνσταντίνος Αλεύρης</p>
                            </td>
                            <td class="col-md-3">
                                <p class="paragraph">520</p>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="courses-chart col-md-6">
                    <p class="title">Φοιτητές ανα Μάθημα</p>
                </div>
            </div>
        </div>
    </div>
@endsection
