<?php

namespace App\Service;
use Illuminate\Support\Facades\Http;

use App\Models\Film;

class MoviesService {

    const TRENDING_FIELDS_MAP = [
        'day' => 'trending_today',
        'week' => 'trending_in_week'
    ];


    public function importMoviesPerTrend($trend) {

        try {
            $result = Http::withHeaders([
                'Authorization' => "Bearer " . env("TMDB_API_TOKEN")
            ])->get("https://api.themoviedb.org/3/trending/all/{$trend}");
            

            $movies = json_decode($result->body(), true)['results'];

            foreach ($movies as $movie) {
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

    private function createMovie($movie) {
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
}