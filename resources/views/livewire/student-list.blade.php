<div class="col-md-12">
    <table>
        <thead>
        <tr class="tableRow colTitles">
            <th class="name" wire:click="sortBy('name')">Όνομα</th>
            <th class="surname" wire:click="sortBy('surname')">Επίθετο</th>
            <th class="email" wire:click="sortBy('email')">Email</th>
            <th class="domain">Τμήμα</th>
            <th class="domain" wire:click="sortBy('am')">Αριθμός Μητρώου</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr class="tableRow">
                <td class="col-md-3">
                    <p class="name">{{$user->name}}</p>
                </td>
                <td class="col-md-3">
                    <p>{{$user->surname}}</p>
                </td>
                <td class="col-md-3">
                    <p>{{$user->email}}</p>
                </td>
                <td class="col-md-3">
                    <p>{{$user->domain->name}}</p>
                </td>
                <td class="col-md-2">
                    <p>{{$user->student->am}}</p>
                </td>
                <td>
                    <a href="{{route('student.show' , $user)}}"><i class="fa-regular fa-pencil"></i></a>
                </td>
                <td>
                    <a href="{{route('student.delete' , $user)}}"><i class="fa-regular fa-trash-can"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links('livewire.pagination-links') }}
</div>
