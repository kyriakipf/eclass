<div class="flex">
    <div
        @if($eventClickEnabled)
            wire:click.stop="onEventClick('{{ $event['id']}}')"
        @endif
        class="col-auto bg-[#70246a] border shadow-md cursor-pointer w-4 h-4 ml-1 rounded-full">
        <div class="col-auto">
            <p class="text-xs">{{substr($event['title'], 10)}}...</p>
        </div>
    </div>
</div>
