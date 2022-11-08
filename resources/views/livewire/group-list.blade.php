<div class="col-md-12" wire:key='groups'>
    <table>
        @if(count($groups) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                <th class="sort" wire:click="sortBy('subject_id')">Μάθημα</th>
                <th class="sort" wire:click="sortBy('capacity')">Μέγιστος Αριθμός Εγγραφών</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr class="tableRow ">
                    <td class="col-md-3">
                        <a href="{{route('group.show', $group)}}"><p class="paragraph">{{$group->title}}</p></a>
                    </td>
                    <td class="col-md-5">
                        <a href="{{route('group.show', $group)}}"><p class="paragraph">{{substr($group->summary, 0,130)}}...</p></a>
                    </td>
                    <td class="col-md-5">
                        <a href="{{route('group.show', $group)}}"><p class="paragraph">{{$group->subject->title}}</p></a>
                    </td>
                    <td class="col-md-3">
                        <a href="{{route('group.show', $group)}}"><p class="paragraph">{{$group->capacity}}</p></a>
                    </td>
                    <td>
                        <a href="{{route('group.edit', $group)}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td>
                        <a href="{{route('group.delete', $group)}}" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμες ομάδες.</p>
            @endif
            </tbody>
    </table>
    {{ $groups->links('livewire.pagination-links') }}
</div>
