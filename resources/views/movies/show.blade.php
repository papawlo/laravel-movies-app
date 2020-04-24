@extends('layouts.main')

@section('content')
<div class="movie-info border-b border-indigo-800">
    <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
        <div class="flex-none">
            <img src="{{ $movie['poster_path'] }}" alt="poster" class="w-64 lg:w-96">
        </div>

        <div class="md:ml-24">
            <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
            <div class="flex flex-wrap items-center text-indigo-300 text-sm">
                <svg viewBox="0 0 32 40" class="fill-current text-orange-500 w-4">
                    <path
                        d="M30.62 12.62a1 1 0 00-.81-.68l-8.92-1.3-4-8.08a1 1 0 00-1.8 0l-4 8.08-8.92 1.3a1 1 0 00-.56 1.71l6.46 6.29-1.5 8.89A1 1 0 008 29.88l8-4.19 8 4.19a1 1 0 001.45-1.05l-1.52-8.89 6.46-6.29a1 1 0 00.23-1.03z" />
                </svg>
                <span class="ml-1">{{ $movie['vote_average'] }}</span>
                <span class="mx-2">|</span>
                <span>{{ $movie['release_date']}}</span>
                <span class="mx-2">|</span>
                <span>
                    {{$movie['genres']}}
                </span>
            </div>

            <p class="text-indigo-100 mt-8">
                {{$movie['overview']}}
            </p>

            <div class="mt-12">
                <h4 class="text-white font-semibold">Featured Crew</h4>
                <div class="flex mt-4">
                    @foreach ($movie['crew'] as $crew)
                    <div class="mr-8">
                        <div>
                            {{$crew['name']}}
                        </div>
                        <div class="text-sm text-indigo-400">
                            {{$crew['job']}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> <!-- end featured crew -->

            <div x-data="{isOpen : false}">
                @if (count($movie['videos']['results'])> 0)
                <div class="mt-12">
                    <button @click="isOpen = true"
                        class="flex inline-flex items-center bg-yellow-500 text-indigo-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                        <svg viewBox="0 0 100 100" class="w-6 fill-current">
                            <path
                                d="M50 97.5A47.5 47.5 0 1197.5 50 47.35 47.35 0 0150 97.5m0-86.09A38.59 38.59 0 1088.59 50 38.8 38.8 0 0050 11.41m14.1 42.3L40.35 68.55l-.37.38c-.37 0-.37 0-.74.37h-1.11a4.3 4.3 0 01-4.46-4.46V35.16a4.3 4.3 0 014.46-4.46 5.24 5.24 0 012.59.75L64.1 46.29a4.2 4.2 0 010 7.42" />
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>
                </div> <!-- end div play button  -->

                <div style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show.transition.opacity="isOpen">
                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                        <div class="bg-indigo-900 rounded">
                            <div class="flex justify-end pr-4 pt-2">
                                <button @click="isOpen = false"
                                    class="text-3xl leading-none hover:text-indigo-300">&times;</button>
                            </div>
                            <div class="modal-body px-8 py-8">
                                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                        src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                        style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>
</div><!-- end .movie-info -->

<div class="movie-cast border-b border-indigo-800">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Cast</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($movie['cast'] as $cast)
            <div class="mt-8">
                <a href="{{route('actors.show', $cast['id'])}}">
                    <img src="{{ 'https://image.tmdb.org/t/p/w300/' . $cast['profile_path']}}" alt="{{$cast['name']}}"
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{route('actors.show', $cast['id'])}}" class="text-lg mt-2 hover:text-indigo-300">
                        {{$cast['name']}}
                    </a>

                    <div class="text-indigo-400 text-sm">
                        {{$cast['character']}}
                    </div>
                </div>
            </div> <!-- end card -->
            @endforeach

        </div> <!-- end grid -->
    </div><!-- end container -->
</div><!-- end movie-cast -->

<div class="movie-images" x-data="{isOpen : false, image: ''}">
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-semibold">Images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($movie['images'] as $image)
            <div class="mt-8">
                <a @click.prevent="
                        isOpen = true
                        image = '{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                        " href="#">
                    <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="image1"
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
            </div>
            @endforeach
        </div>
        <div style="background-color: rgba(0, 0, 0, .5);"
            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto" x-show="isOpen">
            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                <div class="bg-indigo-900 rounded">
                    <div class="flex justify-end pr-4 pt-2">
                        <button @click="isOpen = false" @keydown.escape.window="isOpen = false"
                            class="text-3xl leading-none hover:text-indigo-300">&times;
                        </button>
                    </div>
                    <div class="modal-body px-8 py-8">
                        <img :src="image" alt="poster">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end movie-images -->
@endsection
