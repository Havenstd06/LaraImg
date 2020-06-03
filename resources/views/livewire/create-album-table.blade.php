<div>
    <div class="items-center pt-2 lg:flex">
        <div class="md:flex-1">
            <a wire:click.prevent="sortBy('id')" role="button" href="#" class="px-3 py-2 mx-2 bg-gray-700 rounded-md hover:bg-gray-800 text-gray-50">
                ID
                @include('includes._sort-icon', ['given_field' => 'id'])
            </a>
            <a wire:click.prevent="sortBy('title')" role="button" href="#" class="px-3 py-2 mx-2 bg-gray-700 rounded-md hover:bg-gray-800 text-gray-50">
                Image
                @include('includes._sort-icon', ['given_field' => 'title'])
            </a>
            <a wire:click.prevent="sortBy('created_at')" role="button" href="#" class="px-3 py-2 mx-2 bg-gray-700 rounded-md hover:bg-gray-800 text-gray-50">
                Date
                @include('includes._sort-icon', ['given_field' => 'created_at'])
            </a>
            <button wire:click="resetTable()" class="inline-flex items-center px-3 py-2 mx-2 leading-5 text-white transition duration-150 ease-in-out bg-gray-700 border border-gray-700 rounded-md shadow-sm focus:outline-none focus:shadow-outline hover:bg-gray-800 hover:border-gray-800">
                <i class="relative mr-1 text-sm fas fa-redo" style="top:1px;"></i>
                Reset
            </button>
        </div>
        <div>                                
            <input wire:model="search" class="w-full px-2 py-2 mt-3 leading-normal bg-white border border-gray-300 rounded-lg appearance-none lg:mt-0 focus:outline-none lg:mr-2" type="text" placeholder="Image ID, Title, User, Date...">
        </div>
    </div>
    @if ($images->count() > 0)
    <div class="gap-4 sm:grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5">
        <div class="mt-2 ml-2 text-4xl text-gray-700 dark:text-gray-50" wire:loading wire:target="search, resetTable, gotoPage, previousPage, nextPage">
            <i class="relative fas fa-circle-notch fa-spin"></i>
        </div>
        @foreach ($images as $img)
            <div wire:loading.remove class="mt-2 transition duration-300 ease-out bg-center bg-cover border rounded-lg dark:bg-forest bg-gray-50 hover:border-gray-50 border-midnight">
            <h2 class="h-10 pt-2 mx-4 my-4 font-semibold text-gray-800 truncate md:my-0 dark:text-gray-100" title="{{ $img->title }}">
                {{ $img->title ?? '' }}
            </h2>
            <a href="{{ route('image.show', ['image' => $img->pageName]) }}">
                <div class="w-full h-48 mx-auto overflow-hidden bg-center bg-cover shadow-lg"
                style="background-image: url({{ route('image.show', ['image' => $img->fullname]) }})"></div>
            </a>
            <p class="flex justify-end px-2 py-1 mr-2 text-sm font-medium text-gray-800 dark:text-gray-100">
                {{ $img->created_at->format('d/m/Y') }} 
                by&nbsp;
                <a href="{{ route('user.profile', ['user' => $img->user->username]) }}" class="text-indigo-500 hover:text-indigo-400">
                {{ $img->user->username }}
                </a>
            </p>
            </div>
        @endforeach
        {{-- @foreach ($images as $img)
        <div wire:loading.remove class="w-32 h-32 mx-auto my-1 overflow-hidden transition duration-300 ease-out bg-transparent bg-center bg-cover border rounded-md hover:border-gray-50 border-midnight dark:bg-forest bg-gray-50"
        style="background-image: url({{ $img->path }})" title='{{ $img->title ? '"'.$img->title.'"': '' }} by {{ $img->user->username }}'>
        </div>
        @endforeach --}}
    </div>
    <div class="mt-4">
        {{ $images->links() }}
    </div>
    @elseif ($search != null)
    <p class="mt-2 italic text-gray-800 dark:text-gray-50">Oops! We can't find any image by the name "{{ $search }}"</p>
    @endif
</div>