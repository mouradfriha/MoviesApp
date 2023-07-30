<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajout des films') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">           
        </h2>

    </x-slot>

            <main class="container mx-auto px-4 py-8">
                <h1 class="text-3xl font-semibold mb-4">Add New Movie</h1>

                <form action="{{ route('bo.movies.store') }}" method="POST" class="max-w-md mx-auto">
                    @csrf
        
                    <div class="mb-4">
                        <label for="adult" class="block font-semibold mb-1">Adult</label>
                        <input type="checkbox" name="adult" value="1" id="adult" class="form-checkbox" >
                    </div>
        
                    <div class="mb-4">
                        <label for="backdrop_path" class="block font-semibold mb-1">Backdrop Path</label>
                        <input type="text" name="backdrop_path" id="backdrop_path" class="form-input w-full"  required>
                    </div>        
                    
                    <div class="mb-4">
                        <label for="title" class="block font-semibold mb-1">Title</label>
                        <input type="text" name="title" id="title" class="form-input w-full" >
                    </div>
        
                    <div class="mb-4">
                        <label for="original_language" class="block font-semibold mb-1">Original Language</label>
                        <input type="text" name="original_language" id="original_language" class="form-input w-full"  required>
                    </div>
        
                    <div class="mb-4">
                        <label for="original_title" class="block font-semibold mb-1">Original Title</label>
                        <input type="text" name="original_title" id="original_title" class="form-input w-full" >
                    </div>
        
                    <div class="mb-4">
                        <label for="overview" class="block font-semibold mb-1">Overview</label>
                        <textarea name="overview" id="overview" class="form-textarea w-full" rows="4" required></textarea>
                    </div>
        
                    <div class="mb-4">
                        <label for="poster_path" class="block font-semibold mb-1">Poster Path</label>
                        <input type="text" name="poster_path" id="poster_path" class="form-input w-full"  required>
                    </div>
        
                    <div class="mb-4">
                        <label for="media_type" class="block font-semibold mb-1">Media Type</label>
                        <input type="text" name="media_type" id="media_type" class="form-input w-full"  required>
                    </div>
        
                    <div class="mb-4">
                        <label for="popularity" class="block font-semibold mb-1">Popularity</label>
                        <input type="number" name="popularity" id="popularity" step="0.01" min="0" class="form-input w-full" required>
                    </div>
        
                    <div class="mb-4">
                        <label for="video" class="block font-semibold mb-1">Video</label>
                        <input type="checkbox" name="video" value="1" id="video" class="form-checkbox">
                    </div>
        
                    <div class="mb-4">
                        <label for="vote_average" class="block font-semibold mb-1">Vote Average</label>
                        <input type="number" name="vote_average" id="vote_average" step="0.1" min="0" max="10" class="form-input w-full"  required>
                    </div>
        
                    <div class="mb-4">
                        <label for="vote_count" class="block font-semibold mb-1">Vote Count</label>
                        <input type="number" name="vote_count" id="vote_count" step="1" min="0" class="form-input w-full" required>
                    </div>  
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ajouter</button>
                    </div>
                </form>
            </main>

</x-app-layout>
