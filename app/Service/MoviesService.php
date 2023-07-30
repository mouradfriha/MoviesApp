<?php

namespace App\Service;
use App\Models\FilmGenre;
use Illuminate\Support\Facades\Http;

use App\Models\Film;
use App\Models\Genre;


class MoviesService {

    const TRENDING_FIELDS_MAP = [
        'day' => 'trending_today',
        'week' => 'trending_in_week'
    ];


    public function importMoviesPerTrend($trend) {
        $apiBaseUrl = env('TMDB_API_BASE_URL');
        try {
            $result = Http::withHeaders([
                'Authorization' => "Bearer " . env("TMDB_API_TOKEN")
            ])->get("{$apiBaseUrl}/trending/all/{$trend}");
            

            $movies = json_decode($result->body(), true)['results'];

            foreach ($movies as $movie) {
               // $movieId = $movie['id'];

                // Utiliser le scope pour rechercher un film existant par son ID
                 //$existingMovie = Film::existingMovie($movieId);
                $existingMovie = Film::where('id', '=', $movie['id'])->first();
                if (!$existingMovie) {
                    $newMovie = $this->createMovie($movie);
                    
                    $newMovie->{self::TRENDING_FIELDS_MAP[$trend]} = true;

                    
                   

                    $newMovie->save();
                    continue;
                }

                $existingMovie->{self::TRENDING_FIELDS_MAP[$trend]} = true;
                $existingMovie->save();

            }
        } catch(\Exception $e) {
           dd($e);
        }
    }

  

    private function createMovie($movie) {
        $newMovie = new Film();
        $newMovie->id = $movie['id'];
        $newMovie->adult = $movie['adult'];
        $newMovie->backdrop_path = $movie['backdrop_path'];
        $newMovie->title = $movie['title'] ?? 'no title';
        $newMovie->original_language = $movie['original_language'];
        $newMovie->original_title = $movie['original_title'] ?? 'no original title';
        $newMovie->overview = $movie['overview'];
        $newMovie->poster_path = $movie['poster_path'];
        $newMovie->media_type = $movie['media_type'];
        $newMovie->popularity = $movie['popularity'];
        $newMovie->video = $movie['video'] ?? false;
        $newMovie->vote_average = $movie['vote_average'];
        $newMovie->vote_count = $movie['vote_count'];
        $newMovie->trending_today =  false;
        $newMovie->trending_in_week =  false;
        return $newMovie;
    }


}