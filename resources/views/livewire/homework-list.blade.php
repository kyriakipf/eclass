<div class="col-md-12" wire:key='homework'>
    <table>
        @if(count($homework) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                <th class="sort" wire:click="sortBy('subject_id')">Μάθημα</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($homework as $single)
                <tr class="tableRow">
                    <td class="col-md-3">
                        <a href="{{route('homework.show', ['homework' => $single])}}">
                            <p class="paragraph">{{$single->title}}</p></a>
                    </td>
                    <td class="col-md-5">
                        <a href="{{route('homework.show', ['homework' => $single])}}"><p
                                class="paragraph">{{substr($single->summary, 0,130)}}...</p></a>
                    </td>
                    <td class="col-md-3">
                        <a href="{{route('homework.show', ['homework' => $single])}}"><p
                                class="paragraph">{{$single->subject->title}}</p></a>
                    </td>
                    <td>
                        <a href="{{route('homework.edit', ['homework' => $single])}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td>
                        <a href="{{route('homework.delete', ['homework' => $single])}}" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμες εργασίες.</p>
            @endif
            </tbody>
    </table>
    {{ $homework->links('livewire.pagination-links') }}
</div>
