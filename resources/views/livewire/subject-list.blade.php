<div class="col-md-12" wire:key='subjects'>
    <table>
        @if(count($subjects) != 0)
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort" wire:click="sortBy('title')">Τιτλος</th>
                <th class="sort" wire:click="sortBy('summary')">Περιγραφη</th>
                <th class="sort" wire:click="sortBy('semester')">Εξάμηνο</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="tableRow">
                    <td class="col-md-3">
                        <p class="paragraph">{{$subject->title}}</p>
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">{{$subject->summary}}</p>
                    </td>
                    <td class="col-md-3">
                        <p class="paragraph">{{$subject->semester}}</p>
                    </td>
                    <td>
                        <a href="{{route('subject.show' , ['subject' => $subject])}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td>
                        <a href="#" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            @else
                <p class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα.</p>
            @endif
            </tbody>
    </table>
    {{ $subjects->links('livewire.pagination-links') }}
</div>
