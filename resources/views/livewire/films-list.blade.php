                <div class="overflow-x-auto">

                    <div class="flex justify-between items-center mb-4">  
                        <!-- Add the search form to the right -->
                        <form  class="flex items-center ml-auto">
                            <input wire:model="search" type="text" name="search" placeholder="Rechercher un film" class="form-input rounded-l">
                            {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-700">Rechercher</button> --}}
                        </form>
                    </div>

                    <div class="overflow-x-auto">   
                        <table class="table w-full table-auto">
                            <thead  class="border-b border-neutral-700 bg-neutral-800 text-neutral-50 dark:border-neutral-600 dark:bg-neutral-700"> 
                                <tr>
                                    <th class="px-4 py-2">Titre</th>
                                    <th class="px-4 py-2">Adult</th>
                                    <th class="px-4 py-2">Synopsis</th>
                                    <th class="px-4 py-2">Votes</th>
                                    <th class="px-4 py-2">Genres</th>
                                    <th class="px-4 py-2">Modifie</th>
                                    <th class="px-4 py-2">Supprimer</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $movie->title }}</td>
                                        <td class="border px-4 py-2">  <span style="color: {{ $movie->adult ? 'green' : 'red' }}">{{ $movie->adult ? '✔' : '✘' }}</td>
                                        <td class="border px-4 py-2">{{ $movie->overview }}</td>
                                        <td class="border px-4 py-2">{{ $movie->vote_average }}</td>
                                        <td class="border px-4 py-2">
                                            @foreach ($movie->genres as $genre)
                                                {{ $genre->name }}@if (!$loop->last), @endif
                                            @endforeach
                                        </td>
                                        <td class="border px-4 py-2"> <a href="{{ route('bo.movies.edit', $movie->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"> Modifie</a>
                                        </td> 
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('bo.movies.destroy', $movie->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure?')"  class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                    supprime
                                                </button>
                                            </form>  
                                        </td>                                 
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $movies->links() }}
                        </div>
                    </div>
                </div>
