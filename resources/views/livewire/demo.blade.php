<div>
    <div>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($this->statuses as $statusValue => $class)
                <label 
                    class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 shadow-sm {{ $class['text-color'] }} cursor-pointer {{ $status === $statusValue ? $class['bg-color'] : 'bg-white' }}"">
                    <input 
                        type="radio" 
                        name="status-choice" 
                        wire:model="status"
                        value="{{ $statusValue }}"
                        class="sr-only" 
                        aria-labelledby="statis-choice-{{ $loop->index }}-label"
                    >
                    <p id="status-choice-{{ $loop->index }}-label"> {{ $statusValue }} </p>
                    <div 
                        class="absolute -inset-px rounded-md pointer-events-none {{ $status === $statusValue ? 'border ' . $class['border-color'] : 'border-2 border-transparent' }}" 
                        aria-hidden="true"
                    >
                    </div>
                </label>
            @endforeach
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 mt-4 gap-4">
            <div>
                <label for="company-website" class="block text-sm font-medium text-gray-700">
                  Title
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input 
                    type="text" 
                    class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                    wire:model.defer="title"
                >
                </div>
            </div>
            <div>
                <label for="configuration.text" class="block text-sm font-medium text-gray-700">
                  Text
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input 
                        type="text" 
                        class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                        wire:model.defer="configuration.text"
                    >
                </div>
            </div>
            <div class="w-full" x-data="{ open: false }">
                <label for="company-website" class="block text-sm font-medium text-gray-700">
                    Position
                </label>
                <div class="relative inline-block text-left mt-1 w-full z-50">
                    <div>
                      <button 
                        type="button" 
                        class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-light-blue-500" 
                        id="menu-button" 
                        aria-expanded="true" 
                        aria-haspopup="true"
                        @click="open = !open"
                    >
                        {{ $configuration['position'] }}
                        <!-- Heroicon name: solid/chevron-down -->
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </div>
                    <div 
                        x-show="open"
                        x-cloak
                        class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                        role="menu" 
                        @mouseleave="open = false"
                        aria-orientation="vertical" 
                        aria-labelledby="menu-button" 
                        tabindex="-1"
                    >
                        @foreach ($this->positions as $position)
                            <div role="none">
                                <a 
                                    href="#" 
                                    class="py-1 text-gray-700 block px-4 py-2 text-sm {{ $position === $configuration['position'] ? 'bg-light-blue-100 text-light-blue-600' : 'text-gray-700 hover:bg-light-blue-100 hover:text-light-blue-600' }}" 
                                    role="menuitem" 
                                    tabindex="-1" 
                                    id="menu-item-{{ $loop->index }}" 
                                    @click="open = false"
                                    wire:click.prevent="setConfiguration('position', '{{ $position }}')" 
                                >
                                    {{ $position }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <label for="configuration.timer" class="block text-sm font-medium text-gray-700">
                  Duration
                </label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <input 
                        type="number" 
                        class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                        wire:model.defer="configuration.timer"
                    >
                </div>
            </div>
            <div class="w-full" x-data="{ open: false }">
                <label for="buttons" class="block text-sm font-medium text-gray-700">
                    Buttons
                </label>
                <div class="relative inline-block text-left mt-1 w-full">
                    <div>
                      <button 
                        type="button" 
                        class="inline-flex justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-light-blue-500" 
                        id="menu-button" 
                        aria-expanded="true" 
                        aria-haspopup="true"
                        @click="open = !open"
                    >
                        {{ $this->selectedButtons }}
                        <!-- Heroicon name: solid/chevron-down -->
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </div>
                    <div 
                        x-show="open"
                        x-cloak
                        @mouseleave="open = false"
                        class="origin-top-right absolute right-0 mt-2 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                        role="menu" 
                        aria-orientation="vertical" 
                        aria-labelledby="menu-button" 
                        tabindex="-1"
                    >
                       <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input 
                                        id="configuration.showConfirmButton" 
                                        name="configuration.showConfirmButton" 
                                        type="checkbox" 
                                        value="{{ $configuration['showConfirmButton'] }}"
                                        wire:model="configuration.showConfirmButton"
                                        class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="configuration.showConfirmButton" class="font-medium text-gray-700">
                                        Show Confirm Button
                                    </label>
                                </div>
                            </div>
                       </div>
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input 
                                        id="configuration.showDenyButton" 
                                        name="configuration.showDenyButton" 
                                        type="checkbox" 
                                        value="{{ $configuration['showDenyButton'] }}"
                                        wire:model="configuration.showDenyButton"
                                        class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="configuration.showDenyButton" class="font-medium text-gray-700">
                                        Show Deny Button
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex items-center h-5">
                                    <input 
                                        id="configuration.showCancelButton" 
                                        name="configuration.showCancelButton" 
                                        type="checkbox" 
                                        value="{{ $configuration['showCancelButton'] }}"
                                        wire:model="configuration.showCancelButton"
                                        class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="configuration.showCancelButton" class="font-medium text-gray-700">
                                        Show Cancel Button
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($configuration['showConfirmButton'])
                <div>
                    <label for="configuration.confirmButtonText" class="block text-sm font-medium text-gray-700">
                        Confirm Button Text
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input 
                            id="configuration.confirmButtonText"
                            type="text" 
                            class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            wire:model.defer="configuration.confirmButtonText"
                        >
                    </div>
                </div>
            @endif
            @if ($configuration['showDenyButton'])
                <div>
                    <label for="configuration.denyButtonText" class="block text-sm font-medium text-gray-700">
                    Deny Button Text
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input 
                            id="configuration.denyButtonText"
                            type="text" 
                            class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            wire:model.defer="configuration.denyButtonText"
                        >
                    </div>
                </div>
            @endif
            @if ($configuration['showCancelButton'])
                <div>
                    <label for="configuration.cancelButtonText" class="block text-sm font-medium text-gray-700">
                    Cancel Button Text
                    </label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <input 
                            id="configuration.cancelButtonText"
                            type="text" 
                            class="focus:ring-light-blue-500 focus:border-light-blue-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                            wire:model.defer="configuration.cancelButtonText"
                        >
                    </div>
                </div>
            @endif
            <div class="col-span-2 flex items-center space-x-6">
                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input 
                            id="configuration.toast" 
                            name="configuration.toast" 
                            type="checkbox" 
                            value="{{ $configuration['toast'] }}"
                            wire:model="configuration.toast"
                            class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="configuration.toast" class="font-medium text-gray-700">
                            Toast
                        </label>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input 
                            id="flash" 
                            name="flash" 
                            type="checkbox" 
                            value="{{ $flash }}"
                            wire:model="flash"
                            class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="flash" class="font-medium text-gray-700">
                            Show as flash
                        </label>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center h-5">
                        <input 
                            id="flash" 
                            name="flash" 
                            type="checkbox" 
                            value="{{ $configuration['timerProgressBar'] }}"
                            wire:model="configuration.timerProgressBar"
                            class="focus:ring-light-blue-500 h-5 w-5 text-light-blue-600 border-gray-300 rounded cursor-pointer"
                        >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="flash" class="font-medium text-gray-700">
                            Show Progress Bar
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-span-2">
                <button 
                    type="button" 
                    class="mt-6 w-full bg-light-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-light-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-light-blue-500"
                    wire:click="showAlert"
                >
                    Show Alert
                </button>
            </div>
        </div>
    </div>
</div>