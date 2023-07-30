<?php

namespace App\Service;
use App\Models\FilmGenre;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;

use App\Models\Film;



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
        $movieIds = Film::pluck('id')->toArray();
        
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
                        $existingGenre = Genre::where('id', '=', $movieDetail['id'])->first();
                        
                        if (!$existingGenre) {                            
                            $newGenre = $this->createGenre($movieDetail);                        ;
                            
                            $newGenre->save();
                            //continue;
                            
                            //continue;
                        }  
                        // remplir la table film_genre
                        //dd($movieGenre,$movieId);
                        $movieGenre = $movieDetail['id'];
                        $newFilmGenre = $this->createFilmGenre($movieId,$movieGenre);
                        $newFilmGenre->save(); 
                    }
                }

            }
            
        } catch(\Exception $e) {
           //dd($e);
        }  
           
    }

    ////  ////cree table film_genre ////////
    private function createFilmGenre($movieId,$movieGenre) {
        $newFilmGenre = new FilmGenre();
        $newFilmGenre->film_id = $movieId;
        $newFilmGenre->genre_id = $movieGenre;
        return $newFilmGenre;
    }
    ///////////////////*end*////////////

    private function createGenre($genre) {
        $newGenre = new Genre();
        $newGenre->id = $genre['id'];
        $newGenre->name = $genre['name'];
        return $newGenre;
    }


}