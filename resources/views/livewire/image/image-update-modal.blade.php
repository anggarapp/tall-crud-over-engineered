<div>
  <x-modal wire:model="show" @mousedown.outside="$wire.clearVariable()" x-cloak>
    <div class="flex items-center justify-between space-x-4 pb-2">
      {{-- Selected: {{ $modelId }} --}}
      <h1 class="text-xl font-medium text-gray-800 ">Create New Tag</h1>

      <button @click="$wire.unshow()" class="text-gray-600 focus:outline-none hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
    </div>
    <label for="name">Name</label>
    <input type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out mb-4
    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="name">
    @if ($errors->has('name'))
    <div class="bg-red-100 rounded-sm py-2 px-2 mb-1 text-base text-red-700 inline-flex items-center w-full"
      role="alert">
      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
        class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path fill="currentColor"
          d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
        </path>
      </svg>
      {{ $errors->first('name') }}
    </div>
    @endif
    <label for="image">Image</label>

    @if ($image)
    <img src="{{ $image->temporaryUrl() }}" alt="previewImage">
    @else
    @if ($oldImage)
    <img src="{{ 'storage/images/'.$oldImage }}" alt="previewImage">
    @endif
    @endif
    <input type="file" id="{{ $clearId }}" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out mb-4
    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" wire:model="image">
    @if ($errors->has('image'))
    <div class="bg-red-100 rounded-sm py-2 px-2 mb-1 text-base text-red-700 inline-flex items-center w-full"
      role="alert">
      <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle"
        class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path fill="currentColor"
          d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z">
        </path>
      </svg>
      {{ $errors->first('image') }}
    </div>
    @endif
    <label for="tag">Tag</label>
    <div x-data @tags-update="console.log('tags updated', $event.detail.tags)" data-tags='[]'>
      <div x-data="tagSelectUpdate()" x-init="init('parentEl')" @click.away="clearSearch()"
        @keydown.escape="clearSearch()">
        <div class="relative" @keydown.enter.prevent="addTag(textInput)">
          <input x-model="textInput" x-ref="textInput" @input="search($event.target.value)" class="form-control block w-full px-3 py-1 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out mb-2
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
            placeholder="Enter some tags">
          <div :class="[open ? 'block' : 'hidden']">
            <div class="absolute z-40 left-0 w-full">
              <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
                <a @click.prevent="addTag(textInput)"
                  class="block py-1 px-2 cursor-pointer hover:bg-indigo-600 hover:text-white">Add tag
                  "<span class="font-semibold" x-text="textInput"></span>"</a>
              </div>
            </div>
          </div>
          <!-- selections -->
          <template x-for="(tag, index) in tags">
            <div class="bg-indigo-100 inline-flex items-center text-sm rounded my-1 mr-1">
              <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs" x-text="tag"></span>
              <button @click.prevent="removeTag(index)"
                class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <path fill-rule="evenodd"
                    d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z" />
                </svg>
              </button>
            </div>
          </template>
        </div>
      </div>
    </div>
    <button wire:click="storeUpdate" data-mdb-ripple="true" data-mdb-ripple-color="light"
      class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
      Submit
    </button>
  </x-modal>
  <script>
    function tagSelectUpdate() {
          return {
            open: false,
            textInput: '',
            tags: @entangle('tags'),
            init() {
              this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags'));
            },
            addTag(tag) {
              tag = tag.trim()
              if (tag != "" && !this.hasTag(tag)) {
                this.tags.push( tag )
              }
              this.clearSearch()
              this.$refs.textInput.focus()
              this.fireTagsUpdateEvent()
            },
            fireTagsUpdateEvent() {
              this.$el.dispatchEvent(new CustomEvent('tags-update', {
                detail: { tags: this.tags },
                bubbles: true,
              }));
            },
            hasTag(tag) {
              var tag = this.tags.find(e => {
                return e.toLowerCase() === tag.toLowerCase()
              })
              return tag != undefined
            },
            removeTag(index) {
              this.tags.splice(index, 1)
              this.fireTagsUpdateEvent()
            },
            search(q) {
              if ( q.includes(",") ) {
                q.split(",").forEach(function(val) {
                  this.addTag(val)
                }, this)
              }
              this.toggleSearch()
            },
            clearSearch() {
              this.textInput = ''
              this.toggleSearch()
            },
            toggleSearch() {
              this.open = this.textInput != ''
            }
          }
        }
  </script>
</div>