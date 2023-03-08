<div>
    {{-- @if ($posts) --}}
    @livewire('post.post-create-modal')
    <div class="block rounded-lg shadow-lg bg-white min-w-full">
        <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <div class="flex mx-4 justify-between">
                                <input type="search"
                                    class="my-4 -mr-px block w-[30%] min-w-0  rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-1.5 text-base font-normal text-neutral-700 outline-none transition duration-300 ease-in-out focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none dark:text-neutral-200 dark:placeholder:text-neutral-200"
                                    placeholder="Search" wire:model="searchTerm" />
                                <button x-data="{}"
                                    x-on:click="window.livewire.emitTo('post.post-create-modal', 'show')"
                                    class="flex items-center justify-center mx-1 my-4 px-3 py-2 h-min space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">Create
                                    Post</button>
                            </div>
                            <table class="min-w-full">
                                <thead class="bg-white border-b">
                                    <tr>
                                        @foreach ($headers as $header => $value)
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left cursor-pointer"
                                            wire:click="sort('{{$header}}')">

                                            @if ($sortColumn == $header)
                                            <span>{!!$sortDirection == 'asc' ? '&#8659;':'&#8657;'!!}</span>
                                            @endif
                                            {{is_array($value) ? $value['label']: $value}}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($posts))
                                    @foreach ($posts as $post)
                                    <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                        @foreach ($headers as $key => $value)
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {!! is_array($value) ? $value['parse']($post->$key): $post->$key !!}
                                        </td>
                                        @endforeach
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap block">
                                            <div class="inline-flex">
                                                <button wire:click="select({{ $post->id }},'update')" x-data="{}"
                                                    x-on:click="window.livewire.emitTo('post-form', 'show')"
                                                    class="flex items-center justify-center mx-1 px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-blue-500 rounded-md dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:bg-blue-700 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                                    Update
                                                </button>
                                                <button wire:click="select({{ $post->id }},'delete')" x-data="{}"
                                                    x-on:click="window.livewire.emitTo('post-delete-modal', 'show')"
                                                    class="flex items-center justify-center mx-1 px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-500 rounded-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:bg-red-700 hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
                                                    Delete
                                                </button>
                                                <button wire:click="select({{ $post->id }},'image')" x-data="{}"
                                                    x-on:click="window.livewire.emitTo('post-additional-image', 'show')"
                                                    class="flex items-center justify-center mx-1 px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-cyan-500 rounded-md dark:bg-cyan-600 dark:hover:bg-cyan-700 dark:focus:bg-cyan-700 hover:bg-cyan-600 focus:outline-none focus:bg-cyan-500 focus:ring focus:ring-cyan-300 focus:ring-opacity-50">
                                                    Image
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="{{count($headers)}}">No Data Found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 px-10 mt-2">
                                {{ $posts->links() }}
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
</div>