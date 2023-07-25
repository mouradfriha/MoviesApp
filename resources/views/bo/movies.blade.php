<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des films') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- <a href="{{route('movies.index')}}">  accueil </a> --}}
        </h2>
    </x-slot>
    @if (session('success'))
    <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
                <div class="overflow-x-auto">
                    <table class="table w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Titre</th>
                                <th class="px-4 py-2">Synopsis</th>
                                <th class="px-4 py-2">Votes</th>
                                <th class="px-4 py-2">Modifie</th>
                                <th class="px-4 py-2">Supprimer</th>
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                                <tr>
                                    <td class="border px-4 py-2">{{ $movie->title }}</td>
                                    <td class="border px-4 py-2">{{ $movie->overview }}</td>
                                    <td class="border px-4 py-2">{{ $movie->vote_average }}</td>
                                    <td class="border px-4 py-2"> <a href="{{ route('bo.movies.edit', $movie->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                        Modifie
                                    </a></td>
                                    {{-- <td class="border px-4 py-2">
                                        <form action="{{ route('bo.movies.destroy', $movie->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                supprime
                                            </button>
                                        </form>  
                                    </td> --}}

                                    <td>
                                        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="document.getElementById('confirmDeleteForm').classList.remove('hidden')">Supprimer</button>

                                        <!-- Modal -->
                                        <div id="confirmDeleteForm" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                                            <div class="bg-white rounded-lg p-4 mx-4 sm:max-w-lg sm:mx-auto">
                                                <p class="text-xl mb-4">Are you sure you want to delete this movie?</p>
                                                <div class="flex justify-end">
                                                    <!-- Cancel button to close the modal -->
                                                    <button class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 mr-2" onclick="document.getElementById('confirmDeleteForm').classList.add('hidden')" > Annuler</button>
                                                    <!-- Form to perform the actual delete action -->
                                                    <form action="{{ route('bo.movies.destroy', $movie->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                            supprime
                                                        </button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>    
                                    </td>
                                     <!-- Add more table data as needed -->
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        
                <div class="mt-4">
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
