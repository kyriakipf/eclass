<div class="flex justify-end flex-row mt-2 mb-2 mr-2 items-center w-full">
    <button class="ml-3" wire:click="goToCurrentMonth"><i class="fa-thin fa-clock-rotate-left fa-lg"></i></button>
    <div class="w-px h-8 bg-black ml-2"></div>
    <button class="ml-2" wire:click="goToPreviousMonth"><i class="fa-thin fa-angle-left fa-lg"></i></button>
    <p class="ml-3 w-[75px]">{{ $this->startsAt->format('M Y') }}</p>
    <button class="ml-1" wire:click="goToNextMonth"><i class="fa-thin fa-angle-right fa-lg"></i></button>
</div>




