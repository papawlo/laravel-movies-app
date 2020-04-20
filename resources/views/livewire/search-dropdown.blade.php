<div class="relative mt-3 md:mt-0">
    <input type="text" wire:model.debounce.500ms="search"
        class="bg-gray-800 text-sm rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow-outline-none"
        placeholder="Search">
    <div class="absolute top-0">
        <svg viewBox="0 0 24 30" class="fill-current w-4 text-gray-500 mt-2 ml-2">
            <path
                d="M21.707 20.293l-5.395-5.395a8.028 8.028 0 10-1.414 1.414l5.395 5.395a1 1 0 001.414-1.414zM4 10a6 6 0 116 6 6.007 6.007 0 01-6-6z" />
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4">

    </div>
    @if (strlen($search) > 2)
    <div class="absolute text-sm bg-gray-800 rounded w-64 mt-4">
        @if ($searchResults->count() > 0)

        <ul>
            @foreach ($searchResults as $result)
            <li class="border-b border-gray-700">
                <a href="{{route('movies.show', $result['id'])}}"
                    class="block hover:bg-gray-700 transition px-3 py-3 flex items-center">
                    @if ($result['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster" class=w-8>
                    @else
                    <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                    @endif

                    <span class="ml-3">{{$result['title']}}</span>
                </a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="px-3 py-3">No results for "{{$search}}"</div>
        @endif
    </div>
    @endif
</div> <!-- searh-box -->
