<x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des films') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- <a href="{{route('movies.index')}}">  accueil </a> --}}
        </h2>
    </x-slot>

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
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movies as $movie)
                                <tr>
                                    <td class="border px-4 py-2">{{ $movie->title }}</td>
                                    <td class="border px-4 py-2">{{ $movie->overview }}</td>
                                    <td class="border px-4 py-2">{{ $movie->vote_average }}</td>
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
