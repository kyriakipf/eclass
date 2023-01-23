<div class="flex align-items-center gap-[3px]">
    <div
        @if($eventClickEnabled)
            wire:click.stop="onEventClick('{{ $event['id']}}')"
        @endif
        class="col-auto bg-[#70246a] border shadow-md cursor-pointer w-2 h-2 ml-1 rounded-full">

    </div>
    <div class="col-auto">
        <p class="text-xs" title="{{$event['title']}}">{{substr($event['title'],0 ,10)}}...</p>
    </div>
</div>
