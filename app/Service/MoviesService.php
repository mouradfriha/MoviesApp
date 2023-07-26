<?php

namespace App\Service;
use Illuminate\Support\Facades\Http;

use App\Models\Film;


class MoviesService {

    const TRENDING_FIELDS_MAP = [
        'day' => 'trending_today',
        'week' => 'trending_in_week'
    ];

    
    public function importMoviesPerTrend(string $trend): void
    {
        $apiBaseUrl = env('TMDB_API_BASE_URL');
        try {
            $result = Http::withHeaders([
                'Authorization' => "Bearer " . env("TMDB_API_TOKEN")
            ])->get("{$apiBaseUrl}/trending/all/{$trend}");
            

            $movies = json_decode($result->body(), true)['results'];

            foreach ($movies as $movie) {
                //$movieId = $movie['id'];

                // Utiliser le scope pour rechercher un film existant par son ID
                // $existingMovie = Film::existingMovie($movieId);
                $existingMovie = Film::where('film_id', '=', $movie['id'])->first();
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
           //dd($e);
        }
    }

    private function createMovie(array $movie): Film
    {
        $newMovie = new Film();
        $newMovie->film_id = $movie['id'];
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




















    ////////////////////////////// **************///////////////////////////
   /* public function someControllerMethod($trend)
{
    // Votre code pour récupérer les données de l'API ici...
    $apiBaseUrl = env('TMDB_API_BASE_URL');

    $result = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('TMDB_API_TOKEN'),
    ])->get("{$apiBaseUrl}/trending/all/{$trend}");

    $moviesData = json_decode($result->body(), true)['results'];

    // Transformer les données de chaque film en instance de la classe Movie
    $movies = collect($moviesData)->map(function ($movieData) {
        return new Movie($movieData);
    });

    // Maintenant, $movies contiendra une collection d'objets Movie, chacun représentant un film avec ses propriétés
    // Vous pouvez utiliser les méthodes et propriétés de la classe Movie pour travailler avec les données de manière plus organisée
    // Par exemple : $movies[0]->title, $movies[0]->overview, etc.
}*/









}