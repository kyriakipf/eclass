<div class="col-md-12" wire:key='subjects'>
    @if(count($subjects) == 0)
        <div class="tableRow">
            <a href="{{route('subject.create')}}" class="paragraph">Δεν υπάρχουν διαθέσιμα μαθήματα. Πατήστε εδώ για να
                δημιουργήσετε ένα μάθημα.</a>
        </div>
    @else
        <table>
            <thead>
            <tr class="tableRow colTitles">
                <th class="sort col-md-2" wire:click="sortBy('title')">Τιτλος</th>
                <th class="sort col-md-2" wire:click="sortBy('summary')">Περιγραφη</th>
                <th class="subtitle col-md-2">Καθηγητής</th>
                <th class="subtitle col-md-2" wire:click="sortBy('semester_id')">Εξάμηνο</th>
                <th class="subtitle col-md-2">Εγγεγραμμενοι Φοιτητές</th>
                <th class="col-md-1"></th>
                <th class="col-md-1"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                <tr class="tableRow">
                    <td class="col-md-2">
                        <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                class="paragraph">{{$subject->title}}</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                class="paragraph">{{substr($subject->summary, 0,60)}}...</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                class="paragraph">{{$subject->teacher[0]->user->name}} {{$subject->teacher[0]->user->surname}}</p>
                        </a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('subject.show' , ['subject' => $subject])}}"><p
                                class="paragraph">{{$subject->semester->number}}<small>ο</small> Εξάμηνο</p></a>
                    </td>
                    <td class="col-md-2">
                        <a href="{{route('subject.show' , ['subject' => $subject])}}">
                            <p class="paragraph">{{count($subject->student)}}</p></a>
                    </td>
                    <td class="col-md-1">
                        <a href="{{route('subject.edit' , ['subject' => $subject])}}" class="edit"><i
                                class="fa-regular fa-pencil"></i></a>
                    </td>
                    <td class="col-md-1">
                        <a href="{{route('subject.delete', ['subject' => $subject])}}" class="delete"><i
                                class="fa-regular fa-trash-can"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    {{ $subjects->links() }}
</div>
