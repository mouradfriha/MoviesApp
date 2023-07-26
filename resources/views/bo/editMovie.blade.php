<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajout des films') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- <a href="{{route('movies.index')}}">  accueil </a> --}}
        </h2>
    </x-slot>

    <!-- resources/views/bo/editMovies.blade.php -->

    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-4">Edit Movie: {{ $movie->title }}</h1>

        <form action="{{ route('bo.movies.update', $movie->id) }}" method="POST" class="max-w-md mx-auto">
            @csrf
            @method('PUT')

            <!-- Ajoutez tous les champs du formulaire comme dans le formulaire d'ajout -->
            

            <div class="mb-4">
                <label for="adult" class="block font-semibold mb-1">Adult</label>
                <input type="checkbox" name="adult" id="adult" class="form-checkbox" value='1' @if($movie->adult) checked value='1' @endif>
            </div>


            {{-- <div class="mb-4">
                <label for="film_id" class="block font-semibold mb-1">Film ID</label>
                <input type="text" name="film_id" id="film_id" class="form-input w-full" value="{{ $movie->film_id }}" required>
            </div> --}}

            <div class="mb-4">
                <label for="backdrop_path" class="block font-semibold mb-1">Backdrop Path</label>
                <input type="text" name="backdrop_path" id="backdrop_path" class="form-input w-full" value="{{ $movie->backdrop_path }}" required>
            </div>

            <!-- Ajoutez tous les autres champs de la table "films" ici -->
            <div class="mb-4">
                <label for="title" class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" id="title" class="form-input w-full" value="{{ $movie->title }}" required>
            </div>

            <div class="mb-4">
                <label for="original_language" class="block font-semibold mb-1">Original Language</label>
                <input type="text" name="original_language" id="original_language" class="form-input w-full" value="{{ $movie->original_language }}" required>
            </div>

            <div class="mb-4">
                <label for="original_title" class="block font-semibold mb-1">Original Title</label>
                <input type="text" name="original_title" id="original_title" class="form-input w-full" value="{{ $movie->original_title }}">
            </div>

            <div class="mb-4">
                <label for="overview" class="block font-semibold mb-1">Overview</label>
                <textarea name="overview" id="overview" class="form-textarea w-full" rows="4" required>{{ $movie->overview }}</textarea>
            </div>

            <div class="mb-4">
                <label for="poster_path" class="block font-semibold mb-1">Poster Path</label>
                <input type="text" name="poster_path" id="poster_path" class="form-input w-full" value="{{ $movie->poster_path }}" required>
            </div>

            <div class="mb-4">
                <label for="media_type" class="block font-semibold mb-1">Media Type</label>
                <input type="text" name="media_type" id="media_type" class="form-input w-full" value="{{ $movie->media_type }}" required>
            </div>

            <div class="mb-4">
                <label for="popularity" class="block font-semibold mb-1">Popularity</label>
                <input type="number" name="popularity" id="popularity" step="0.01" min="0" class="form-input w-full" value="{{ $movie->popularity }}" required>
            </div>

            <div class="mb-4">
                <label for="video" class="block font-semibold mb-1">Video</label>
                <input type="checkbox" name="video" id="video" class="form-checkbox" value='1' @if($movie->video) checked value='1' @endif>
            </div>

            <div class="mb-4">
                <label for="vote_average" class="block font-semibold mb-1">Vote Average</label>
                <input type="number" name="vote_average" id="vote_average" step="0.01" min="0" max="10" class="form-input w-full" value="{{ $movie->vote_average }}" required>
            </div>

            <div class="mb-4">
                <label for="vote_count" class="block font-semibold mb-1">Vote Count</label>
                <input type="number" name="vote_count" id="vote_count" step="1" min="0" class="form-input w-full" value="{{ $movie->vote_count }}" required>
            </div>

            <div class="mb-4">
                <label for="trending_today" class="block font-semibold mb-1">tendance Aujourdhui</label>
                <input type="checkbox" name="trending_today" id="trending_today" class="form-checkbox" value='1' @if($movie->trending_today) checked value='1' @endif>
            </div>

            <div class="mb-4">
                <label for="trending_in_week" class="block font-semibold mb-1">tendance du mois</label>
                <input type="checkbox" name="trending_in_week" id="trending_in_week" class="form-checkbox" value='1' @if($movie->trending_in_week) checked value='1' @endif>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Modifie</button>
            </div>
           
        </form>
    </main>

        
            


</x-app-layout>
