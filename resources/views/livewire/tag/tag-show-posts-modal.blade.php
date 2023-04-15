<div>
    <x-modal wire:model="show" @mousedown.outside="$wire.clearVariable()" x-cloak>
        <div class="block rounded-lg shadow-lg bg-white min-w-full">
            <div class="mt-8 overflow-hidden shadow sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full">
                                    <thead class="bg-white border-b">
                                        <tr>
                                            @foreach ($headers as $header => $value)
                                            <th scope="col"
                                                class="text-sm font-medium text-gray-900 px-6 py-4 text-left cursor-pointer"
                                                {{-- wire:click="sort('{{$header}}')"> --}}
                                                >
                                                {{-- @if ($sortColumn == $header)
                                                <span>{!!$sortDirection == 'asc' ? '&#8659;':'&#8657;'!!}</span>
                                                @endif --}}
                                                {{is_array($value) ? $value['label']: $value}}
                                            </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($posts))
                                        @foreach ($posts as $post)
                                        <tr
                                            class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                            @foreach ($headers as $key => $value)
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                {!! is_array($value) ? $value['parse']($post->$key): $post->$key !!}
                                            </td>
                                            @endforeach

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
                                    {{-- {{ $posts->links() }} --}}
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