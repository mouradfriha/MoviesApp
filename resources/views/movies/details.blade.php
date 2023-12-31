@component('layouts.guest')
    <div class="container mx-auto py-8">
        <a href="{{url()->previous()}}"> Go Back </a>
    <div class="flex flex-col">
        <!-- Movie poster -->
        <div class="h-fit overflow-hidden rounded-xl" >
            <!-- Movie poster image -->
            <a href="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" target="_blank">
                <img class="bg-cover h-[450px] w-[500px] m-auto" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="w-full">
            </a>           
        </div>

        <!-- Movie details -->
        <div class="w-full md:w-3/4 md:pl-8">
            <h1 class="text-3xl font-semibold">{{$movie->title}}</h1>
            <div class="flex items-center my-4">
                <span class="text-yellow-400 mr-2">⭐</span>
                <span class="text-lg">Rating: {{$movie->vote_average}}/10</span>
            </div>
            <!-- Add more movie details here -->

            <!-- Movie overview -->
            <div class="my-8">
                <h2 class="text-xl font-semibold">Overview</h2>
                <p class="text-gray-600">
                    {{$movie->overview}}
                </p>
            </div>

             <!-- Movie genres -->
             <div class="my-8">
                <h2 class="text-xl font-semibold">Genres</h2>
                <ul class="list-disc list-inside">
                    @foreach ($genres as $genre)
                        <li>{{$genre->name}}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</main>
@endcomponent