<div
    @if($eventClickEnabled)
        wire:click.stop="onEventClick('{{ $event['id']}}')"
    @endif
    class="bg-pink-100 border shadow-md cursor-pointer w-4 h-4 ml-1 rounded-full">
</div>
