<div>
    <x-modal wire:model="show" @mousedown.outside="$wire.clearVariable()" x-cloak>
        <div class="block rounded-lg shadow-lg bg-white min-w-full">
            <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                @if (count($images))
                                <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-4">
                                    @foreach ($images as $image)
                                    <div>
                                        <img src="{{ url('storage/images/' . $image->url) }}" alt="">
                                        <p class="truncate ">{{ $image->name }}</p>
                                    </div>
                                    @endforeach
                                    @else
                                </div>
                                No Data Found
                                @endif

                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 px-10 mt-2">
                                    {{-- {{ $images->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @else --}}
        {{-- There is no Posts --}}
        {{-- @endif --}}
    </x-modal>
</div>