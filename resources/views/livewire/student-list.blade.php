<div class="col-md-12" wire:key='students'>
    <table>
        @if(count($users) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort" wire:click="sortBy('name')">Όνομα</th>
                <th class="sort" wire:click="sortBy('surname')">Επίθετο</th>
                <th class="sort" wire:click="sortBy('email')">Email</th>
                <th class="sort" wire:click="sortBy('am')">Μητρώο</th>
                <th>Τμήμα</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="tableRow">
                    <td>
                        <p class="paragraph">{{$user->name}}</p>
                    </td>
                    <td >
                        <p class="paragraph">{{$user->surname}}</p>
                    </td>
                    <td >
                        <p class="paragraph">{{$user->email}}</p>
                    </td>
                    <td >
                        <p class="paragraph">{{$user->student->am}}</p>
                    </td>
                    <td >
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
    {{ $users->links() }}
</div>
