<div class="col-md-12" wire:key='group'>
    <table>
        @if(count($groups) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                <th class="sort" wire:click="sortBy('subject_id')">Μάθημα</th>
                <th class="sort" wire:click="sortBy('time')">Ώρα</th>
                <th class="sort">Μέγιστος Αριθμός Εγγραφών</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($groups as $group)
                <tr class="tableRow ">
                    <td class="col-md-2">
                        <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}"><p class="paragraph">{{$group->title}}</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}"><p class="paragraph">{{substr($group->summary, 0,130)}}...</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}"><p class="paragraph">{{$group->subject->title}}</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}"><p class="paragraph">{{$group->time}}</p></a>
                    </td>
                    <td class="col-md-auto">
                        <a href="{{route('group.show', ['group' => $group, 'subject' => $group->subject])}}"><p class="paragraph">{{count($group->student)}}/{{$group->capacity}}</p></a>
                    </td>
                    <td class="col-auto">
                        <a href="{{route('group.edit', ['group' => $group, 'subject' => $group->subject])}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td class="col-auto">
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
    {{ $groups->links() }}
</div>
