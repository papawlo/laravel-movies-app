<div class="mt-8">
    <a href="{{ route('movies.show', $movie['id']) }}">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path']}}" alt="poster"
            class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{ route('movies.show', $movie['id']) }}" class="text-lg mt-2 hover:text-gray-300">
            {{$movie['title']}}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <svg viewBox="0 0 32 40" class="fill-current text-orange-500 w-4">
                <path
                    d="M30.62 12.62a1 1 0 00-.81-.68l-8.92-1.3-4-8.08a1 1 0 00-1.8 0l-4 8.08-8.92 1.3a1 1 0 00-.56 1.71l6.46 6.29-1.5 8.89A1 1 0 008 29.88l8-4.19 8 4.19a1 1 0 001.45-1.05l-1.52-8.89 6.46-6.29a1 1 0 00.23-1.03z" />
            </svg>
            <span class="ml-1">{{ $movie['vote_average'] * 10 . "%"}}</span>
            <span class="mx-2">|</span>
            <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format("M d, Y")}}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach ($movie['genre_ids'] as $genre)
            {{$genres->get($genre)}}@if (!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div> <!-- end card -->
