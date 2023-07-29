<?php

namespace App\Service;
use Illuminate\Support\Facades\Http;

use App\Models\Film;
use App\Models\genres;


class GenresService {

    //recupure les ids des films 
    /*public function getMovieIds(): array
    {
        // Utilisez la méthode pluck() pour récupérer uniquement les IDs de films
        $movieIds = Film::pluck('film_id')->toArray();

        return $movieIds;
    }*/


    public function importGenres() {

        $apiBaseUrl = env('TMDB_API_BASE_URL');
        $movieIds = Film::pluck('film_id')->toArray();
        
        try {
            foreach($movieIds as $movieId){

                $result = Http::withHeaders([
                    'Authorization' => "Bearer " . env("TMDB_API_TOKEN")
                ])->get("{$apiBaseUrl}/movie/{$movieId}");
                
                //dd($result);
                $movies= json_decode($result->body(), true);
                if(isset($movies['genres'])){
                    $moviesDetails = $movies['genres'] ;
                    //dd($moviesDetails);
                    foreach ($moviesDetails as $movieDetail) {
                    // $movieId = $movie['id'];
        
                        // Utiliser le scope pour rechercher un genre existant par son ID
                        //$existingGenre = genres::existingGenre($movieDetail);
                        $existingGenre = genres::where('id', '=', $movieDetail['id'])->first();
                        
                        if (!$existingGenre) {
                            
                            $newGenre = $this->createGenre($movieDetail);
                        // dd($newGenre);  
                            $newGenre->save();
                            continue;
                        }   
                    }
                }

            }
            
        } catch(\Exception $e) {
           //dd($e);
        }  
           
    }

    ////

    private function createGenre($genre) {
        $newGenre = new genres();
        $newGenre->id = $genre['id'];
        $newGenre->name = $genre['name'];
        return $newGenre;
    }


}