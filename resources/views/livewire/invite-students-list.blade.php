<div class="col-md-12">
    <table>
        @if(count($users) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort title">Όνομα</th>
                <th class="sort title">Επίθετο</th>
                <th class="sort title">Email</th>
                <th class="sort title">Μητρώο</th>
                <th class="title">Τμήμα</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="tableRow">
                    <td class="col-md-3">
                        <p class="paragraph">{{$user->name}}</p>
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">{{$user->surname}}</p>
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">{{$user->email}}</p>
                    </td>
                    <td class="col-md-2">
                        <p class="paragraph">{{$user->am}}</p>
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">{{$user->domain->name}}</p>
                    </td>
                    <td>
                        <a href="{{route('student.show' , $user)}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td>
                        <a href="{{route('student.delete' , $user)}}" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμοι φοιτητές.</p>
            @endif
            </tbody>
    </table>
</div>
