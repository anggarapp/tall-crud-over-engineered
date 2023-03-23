<div>
    <x-modal wire:model="show">
        <div class="flex items-center justify-between space-x-4 pb-2">
            <h1 class="text-xl font-medium text-gray-800 ">
                Sure To Delete?
            </h1>

            <button @click="show = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>
        <div class="flex items-center justify-center">
            <button wire:click="delete" data-mdb-ripple="true" data-mdb-ripple-color="light"
                class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                Delete
            </button>
        </div>
    </x-modal>
</div>