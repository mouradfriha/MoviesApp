<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Movie;
use App\Http\Requests\MovieRequest;

class MoviesManagementController extends Controller
{
    

    public function index() {
        $movies = Film::paginate(10);
        return view('bo/movies', compact('movies'));
    }

    //Créer un nouvel  Film 
    public function create()
    {
        return view('bo/addMovies');
    }
    public function store(MovieRequest $request)
    {
        // Les données ont déjà été validées grâce à la classe MovieRequest
        // Vous pouvez accéder aux données validées via l'objet $request
        $data = $request->validated();
    
        // Vérifier si le champ 'adult' est présent dans la requête
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
/*  //ajouter un film sans utilise la validation request
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            //'film_id' => 'required|integer',
            'adult' => 'boolean',
            'backdrop_path' => 'required|string',
            'title' => 'required|string|max:255',
            'original_language' => 'required|string',
            'original_title' => 'string|max:255',
            'overview' => 'required|string',
            'poster_path' => 'required|string',
            'media_type' => 'required|string',
            'popularity' => 'required|numeric|min:0',
            'video' => 'boolean',
            'vote_average' => 'required|numeric|min:0|max:10',
            'vote_count' => 'required|integer|min:0',
            'trending_today' => 'boolean',              
            'trending_in_week' => 'boolean',
            // Ajoutez d'autres règles de validation pour les champs supplémentaires
        ]);
        //dd($request);
        // Créer un nouvel objet Film et enregistrer les données dans la base de données
        $newMovie = new Film();
        $newMovie->film_id = 100;
        $newMovie->adult = $request->input('adult', false);
        $newMovie->backdrop_path = $request->input('backdrop_path');
        $newMovie->title = $request->input('title');
        $newMovie->original_language = $request->input('original_language');
        $newMovie->original_title = $request->input('original_title', 'no original title');
        $newMovie->overview = $request->input('overview');
        $newMovie->poster_path = $request->input('poster_path');
        $newMovie->media_type = $request->input('media_type');
        $newMovie->popularity = $request->input('popularity');
        $newMovie->video = $request->input('video', false);
        $newMovie->vote_average = $request->input('vote_average');
        $newMovie->vote_count = $request->input('vote_count');
        $newMovie->trending_today = $request->input('trending_today', false);
        $newMovie->trending_in_week = $request->input('trending_in_week', false);
        
        ///var_dump($newMovie);
        $newMovie->save();

        // Rediriger vers la page de liste des films après l'ajout
        return redirect()->route('bo.movies.store')->with('success', 'Movie added successfully!');
    }*/

    // fonction pour modifier les information un film
    public function edit(Film $movie)
    {
        return view('bo.editMovie', compact('movie'));
    }    



    //update sans request 
    /*public function update(Request $request, Film $movie)
    {
        // Valider les données du formulaire
        $request->validate([
            'film_id' => 'required|integer',
            'adult' => 'boolean',
            'backdrop_path' => 'required|string',
            'title' => 'required|string|max:255',
            'original_language' => 'required|string',
            'original_title' => 'string|max:255',
            'overview' => 'required|string',
            'poster_path' => 'required|string',
            'media_type' => 'required|string',
            'popularity' => 'required|numeric|min:0',
            'video' => 'boolean',
            'vote_average' => 'required|numeric|min:0|max:10',
            'vote_count' => 'required|integer|min:0',
            'trending_today' => 'boolean',              
            'trending_in_week' => 'boolean',
            // Ajoutez les autres règles de validation pour les autres champs du formulaire
        ]);

        // Mettre à jour les propriétés du film avec les valeurs du formulaire
        $movie->film_id = $request->input('film_id');              
        $movie->adult = $request->input('adult', false);
        $movie->backdrop_path = $request->input('backdrop_path');
        $movie->title = $request->input('title');
        $movie->original_language = $request->input('original_language');
        $movie->original_title = $request->input('original_title', 'no original title');
        $movie->overview = $request->input('overview');
        $movie->poster_path = $request->input('poster_path');
        $movie->media_type = $request->input('media_type');
        $movie->popularity = $request->input('popularity');
        $movie->video = $request->input('video', false);
        $movie->vote_average = $request->input('vote_average');
        $movie->vote_count = $request->input('vote_count');
        $movie->trending_today = $request->input('trending_today', false);
        $movie->trending_in_week = $request->input('trending_in_week', false);
        // Mettez à jour les autres propriétés du film avec les valeurs du formulaire

        $movie->save();
        // Rediriger vers la page de liste des films après la modification
        return redirect()->route('bo.movies.store')->with('success', 'Movie updated successfully!');
    }*/

    //fonction update avec la validation request
    public function update(MovieRequest $request, Film $movie)
{
    // Les données ont déjà été validées grâce à la classe MovieRequest
    // Vous pouvez accéder aux données validées via l'objet $request
    $adult = $request->filled('adult') ? true : false;
    $video = $request->filled('video') ? true : false;
    $trending_today = $request->filled('trending_today') ? true : false;
    $trending_in_week = $request->filled('trending_in_week') ? true : false;
    $data = $request->validated();

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

    // la fonctin pour supprime un film
    public function destroy(Film $movie)
    {
        $movie->delete();
        
        // Rediriger vers la page de liste des films après la suppression        
        return redirect()->route('bo.movies.store')->with('success', 'Movie deleted successfully!');
    }
}
