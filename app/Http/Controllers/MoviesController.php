<?php

namespace App\Http\Controllers;
use App\Http\Requests\MovieRequest;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Movie;


class MoviesController extends Controller
{
    public function index(Request $request)
    {
        $trend = $request->input('trend', 'day'); // Get the trend from the request, default to 'day' if not provided

        //$trendingMovies = Film::where(Film::TRENDING_FIELDS_MAP[$trend], true)->get();
        // utilise le scope pour filtre day/week
        $trendingMovies = Film::trending($trend);

        return view('movies.index', compact('trend', 'trendingMovies'));
    }




    public function show($id)
    {
        // Get the movie details from the database based on the $id
        $movie = Film::findOrFail($id);

        return view('movies.details', compact('movie'));
    }
}
