<div class="col-md-12">
    <table>
        <thead>
        <tr class="tableRow colTitles">
            <th class="sort title" wire:click="sortBy('name')">Όνομα <i class="fa-light fa-sort"></i></th>
            <th class="sort title" wire:click="sortBy('surname')">Επίθετο <i class="fa-light fa-sort"></i></th>
            <th class="sort title" wire:click="sortBy('email')">Email <i class="fa-light fa-sort"></i></th>
            <th class="sort title" wire:click="sortBy('am')">Αριθμός Μητρώου <i class="fa-light fa-sort"></i></th>
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
                    <p class="paragraph">{{$user->student->am}}</p>
                </td>
                <td class="col-md-3">
                    <p class="paragraph">{{$user->domain->name}}</p>
                </td>
                <td>
                    <a href="{{route('student.show' , $user)}}" class="edit"><i class="fa-regular fa-pencil"></i></a>
                </td>
                <td>
                    <a href="{{route('student.delete' , $user)}}" class="delete"><i class="fa-regular fa-trash-can"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links('livewire.pagination-links') }}
</div>
