<?php

namespace App\Service;
use App\Models\FilmGenre;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use App\Models\Film;
class GenresService {    
    public function importGenres() {

        $apiBaseUrl = env('TMDB_API_BASE_URL');
        $movieIds = Film::pluck('id')->toArray();
        
        try {
            foreach($movieIds as $movieId){                
                $result = Http::withHeaders([
                    'Authorization' => "Bearer " . env("TMDB_API_TOKEN")
                ])->get("{$apiBaseUrl}/movie/{$movieId}");                
                $movies= json_decode($result->body(), true);
                if(isset($movies['genres'])){                  
                    $moviesDetails = $movies['genres'] ;
                    foreach ($moviesDetails as $movieDetail) {
                        // Utiliser le scope pour rechercher un genre existant par son ID
                       // $existingGenre = genre::existingGenre($movieDetail);
                        $existingGenre = Genre::where('id', '=', $movieDetail['id'])->first();
                        
                        if (!$existingGenre) {                            
                            $newGenre = $this->createGenre($movieDetail); 
                            $newGenre->save(); 
                            
                        }        
                        // remplir la table film_genre
                        $genreId = $movieDetail['id'];
                        /*                            
                        $newFilmGenre = $this->createFilmGenre($movieId,$movieGenre);
                        $newFilmGenre->save();     */    
                        $existingFilmGenre = FilmGenre::where('film_id', $movieId)
                        ->where('genre_id', $genreId)
                        ->first();
                    
                        if (!$existingFilmGenre) {                            
                            // Créez une nouvelle relation film_genre
                            $newFilmGenre = $this->createFilmGenre($movieId, $genreId);
                            $newFilmGenre->save(); 
                        } 
                    }
                }
            }            
        } catch(\Exception $e) {
           //dd($e);
        }             
    }
    ////  ////cree nex film_genre ////////
    private function createFilmGenre($movieId,$movieGenre) {
        $newFilmGenre = new FilmGenre();
        $newFilmGenre->film_id = $movieId;
        $newFilmGenre->genre_id = $movieGenre;
        return $newFilmGenre;
    }
    ///////////////////*end*////////////
    ////  ////cree new genre ////////
    private function createGenre($genre) {
        $newGenre = new Genre();
        $newGenre->id = $genre['id'];
        $newGenre->name = $genre['name'];
        return $newGenre;
    }
}