<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MoviesManagementController extends Controller
{
    

    public function index(Request $request): View
    {
        $searchTerm = $request->input('search');

        // Utilisez la portée de recherche définie dans le modèle Film
        $movies = Film::search($searchTerm)->paginate(10);

        return view('bo.movies', compact('movies'));
    }

    //Créer un nouvel  Film 
    public function create(): View
    {
        return view('bo/addMovies');
    }
    public function store(MovieRequest $request): RedirectResponse
    {
        // Les données ont déjà été validées grâce à la classe MovieRequest
        // Vous pouvez accéder aux données validées via l'objet $request
        $data = $request->validated();
    
        // Vérifier si le champ 'adult' 'video' 'trending' est présent dans la requête
        // Si oui, utilisez true, sinon, utilisez false
        $adult = $request->filled('adult') ? true : false;
        $video = $request->filled('video') ? true : false;
        $trending_today = $request->filled('trending_today') ? true : false;
        $trending_in_week = $request->filled('trending_in_week') ? true : false;
        // Créez un nouvel objet Film en utilisant les données validées
        $newMovie = new Film();
        $newMovie->film_id = 100; // Remplacez cette valeur par la valeur que vous souhaitez
        $newMovie->adult = $adult;
        $newMovie->backdrop_path = $data['backdrop_path'];
        $newMovie->title = $data['title'];
        $newMovie->original_language = $data['original_language'];
        $newMovie->original_title = $data['original_title'] ?? 'no original title';
        $newMovie->overview = $data['overview'];
        $newMovie->poster_path = $data['poster_path'];
        $newMovie->media_type = $data['media_type'];
        $newMovie->popularity = $data['popularity'];
        $newMovie->video =$video;
        $newMovie->vote_average = $data['vote_average'];
        $newMovie->vote_count = $data['vote_count'];
        $newMovie->trending_today = $trending_today;
        $newMovie->trending_in_week = $trending_in_week;
    
        $newMovie->save();
    
        // Rediriger vers la page de liste des films après l'ajout
        return redirect()->route('bo.movies.store')->with('success', 'Movie added successfully!');
    }

    // fonction pour modifier les information un film
    public function edit(Film $movie): View
    {
        return view('bo.editMovie', compact('movie'));
    }    
    
    //fonction update avec la validation request
    public function update(MovieRequest $request, Film $movie): RedirectResponse
    {
    // Les données ont déjà été validées grâce à la classe MovieRequest
    // Vous pouvez accéder aux données validées via l'objet $request   
    $data = $request->validated();
     // Vérifier si le champ 'adult' 'video' 'trending' est présent dans la requête
     $adult = $request->filled('adult') ? true : false;
     $video = $request->filled('video') ? true : false;
     $trending_today = $request->filled('trending_today') ? true : false;
     $trending_in_week = $request->filled('trending_in_week') ? true : false;

    // Mettre à jour les propriétés du film avec les valeurs du formulaire
    //$movie->film_id = $data['film_id'];
    $movie->adult = $adult;
    $movie->backdrop_path = $data['backdrop_path'];
    $movie->title = $data['title'];
    $movie->original_language = $data['original_language'];
    $movie->original_title = $data['original_title'] ?? 'no original title';
    $movie->overview = $data['overview'];
    $movie->poster_path = $data['poster_path'];
    $movie->media_type = $data['media_type'];
    $movie->popularity = $data['popularity'];
    $movie->video = $video;
    $movie->vote_average = $data['vote_average'];
    $movie->vote_count = $data['vote_count'];
    $movie->trending_today = $trending_today;
    $movie->trending_in_week = $trending_in_week ;
    // Mettez à jour les autres propriétés du film avec les valeurs du formulaire

    $movie->save();
    // Rediriger vers la page de liste des films après la modification
    return redirect()->route('bo.movies.store')->with('success', 'Movie updated successfully!');
}

    // la fonction pour supprime un film
    public function destroy(Film $movie): RedirectResponse
    {
        $movie->delete();
        
        // Rediriger vers la page de liste des films après la suppression        
        return redirect()->route('bo.movies.store')->with('success', 'Movie deleted successfully!');
    }
}
