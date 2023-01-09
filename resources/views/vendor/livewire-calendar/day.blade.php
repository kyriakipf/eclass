<div
    ondragenter="onLivewireCalendarEventDragEnter(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragleave="onLivewireCalendarEventDragLeave(event, '{{ $componentId }}', '{{ $day }}', '{{ $dragAndDropClasses }}');"
    ondragover="onLivewireCalendarEventDragOver(event);"
    ondrop="onLivewireCalendarEventDrop(event, '{{ $componentId }}', '{{ $day }}', {{ $day->year }}, {{ $day->month }}, {{ $day->day }}, '{{ $dragAndDropClasses }}');"
    class="flex-1 border border-gray-200 -mt-px -ml-px"
    style="">

    {{-- Wrapper for Drag and Drop --}}
    <div
        class=" h-100px"
        id="{{ $componentId }}-{{ $day }}">

        <div
            @if($dayClickEnabled)
                wire:click="onDayClick({{ $day->year }}, {{ $day->month }}, {{ $day->day }})"
            @endif
            class=" {{ $dayInMonth ? $isToday ? 'bg-yellow-100' : ' bg-white ' : 'bg-gray-100' }}">

            {{-- Number of Day --}}
            <div class="flex items-center ml-1 mb-1">
                <p class="text-sm {{ $dayInMonth ? ' font-medium ' : '' }}">
                    {{ $day->format('j') }}
                </p>
                {{--                <p class="text-xs text-gray-600 ml-4">--}}
                {{--                    @if($events->isNotEmpty())--}}
                {{--                        {{ $events->count() }} {{ Str::plural('homework', $events->count()) }}--}}
                {{--                    @endif--}}
                {{--                </p>--}}
            </div>

            {{-- Events --}}
            <div class="overflow-y-auto">
                <div class="w-4 h-14 mt-1 ml-2">
                    @if($dayInMonth)
                    @foreach($events as $event)
                        <div
                            ondragstart="onLivewireCalendarEventDragStart(event, '{{ $event['id'] }}')">

                            <a @if(auth()->user()->role_id == 2) href="{{route('homework.show', ['homework' => $event['id']])}}"
                               @elseif(auth()->user()->role_id == 3) href="{{route('student.homework.show', ['homework' => $event['id']])}}" @endif>
                                @include($eventView, [
                                    'event' => $event,
                                ])
                            </a>
                        </div>
                    @endforeach
                        @endif
                </div>
            </div>

        </div>
    </div>
</div>
