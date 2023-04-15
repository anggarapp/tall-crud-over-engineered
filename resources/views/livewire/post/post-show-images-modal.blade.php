<div>
    <x-modal wire:model="show" @mousedown.outside="$wire.clearVariable()" x-cloak>
        <div class="block rounded-lg shadow-lg bg-white min-w-full">
            <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
                <div class="flex flex-col justify-items-center">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                @if (count($images))
                                <div class="grid sm:grid-rows-1 lg:grid-cols-2 gap-4">
                                    @foreach ($images as $image)
                                    <div class="flex-row align-center">
                                        <p class="truncate ">{{ $image->name }}</p>
                                        <img src="{{ url('storage/images/' . $image->url) }}" alt="">
                                        <div class="flex justify-center">
                                            <button x-data="{}"
                                                x-on:click="window.livewire.emitTo('image.image-delete-modal', 'showDelete', '{{ $image->id }}')"
                                                class="mx-1 my-1 px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-700 hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                </div>
                                <span>No Data Found</span>
                                @endif
                            </div>
                        </div>
                        <div class="grid-cols-1 justify-center">
                            <div class="flex justify-center">
                                <label for="new_images">Add New Images</label>
                            </div>
                            <input multiple id="{{ $clearId }}" type="file" class=" form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out mb-4
    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="new_images">
                            @if ($errors->has('new_images'))
                            <div class="bg-red-100 rounded-sm py-2 px-2 mb-1 text-base text-red-700 inline-flex items-center w-full"
                                role="alert">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
                                    class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <path fill="currentColor"
                                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
                                    </path>
                                </svg>
                                {{ $errors->first('new_images') }}
                            </div>
                            @endif
                            <div class="flex justify-center py-2">
                                <button wire:click="addNewImages" data-mdb-ripple="true" data-mdb-ripple-color="light"
                                    class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-modal>
</div>