<div class="col-md-12" wire:key='invite-teachers'>
    <table class="table-body">
        @if(count($users) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort title">Όνομα</th>
                <th class="sort title">Επίθετο</th>
                <th class="sort title">Email</th>
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
                    <td class="col-md-3">
                        <p class="paragraph">{{$user->domain->name}}</p>
                    </td>
                    <td>
                        <a href="{{route('teacher.invite.show' , $user)}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td>
                        <a href="{{route('teacher.invite.delete' , $user)}}" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμοι καθηγητές.</p>
            @endif
            </tbody>
    </table>
</div>
