<div class="w-full text-gray-700 bg-cyan-700/70 dark-mode:text-white-200 dark-mode:bg-gray-800">
    <div x-data="{ open: false }"
        class="flex flex-col max-w-screen-xl mx-auto md:items-center md:justify-between md:flex-row">
        <div class="p-4 flex flex-row items-center justify-between">
            <a href="" class="flex items-center">
                TALL CRUD
            </a>
            <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{ 'flex': open, 'hidden': !open }"
            class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
            <a class="{{ Route::is('landing') ? 'text-gray-900 bg-slate-50/[0.8]' : '' }} px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="{{ route('landing') }}">Home</a>
            <a class="{{ Route::is('posts.index') ? 'text-gray-900 bg-slate-50/[0.8] dark-mode:bg-gray-200/[0.5] ' : '' }} px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="{{ route('posts.index') }}">Post</a>
            <a class="{{ Route::is('tags.index') ? 'text-gray-900 bg-slate-50/[0.8]' : '' }} px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="{{ route('tags.index') }}">Tag</a>
            <a class="{{ Route::is('images.index') ? 'text-gray-900 bg-slate-50/[0.8]' : '' }} px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                href="{{ route('images.index') }}">Image</a>
        </nav>
    </div>
</div>