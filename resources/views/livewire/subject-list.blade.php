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
                @foreach($subjects as $subject)
                    <tr class="tableRow">
                        <td class="col-md-3">
                            <a href="{{route('subject.show' , ['subject' => $subject])}}"><p class="paragraph">{{$subject->title}}</p></a>
                        </td>
                        <td class="col-md-5">
                            <a href="{{route('subject.show' , ['subject' => $subject])}}"><p class="paragraph">{{substr($subject->summary, 0,130)}}...</p></a>
                        </td>
                        <td class="col-md-3">
                            <a href="{{route('subject.show' , ['subject' => $subject])}}"><p class="paragraph">{{$subject->semester}}</p></a>
                        </td>
                        <td>
                            <a href="{{route('subject.edit' , ['subject' => $subject])}}" class="edit"><i
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
