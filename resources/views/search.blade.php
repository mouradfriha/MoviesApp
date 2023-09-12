<?php
class SearchFilm extends Component
{
    public $search = '';
 
    public function render()
    {
        return view('bo.movies', [
            'movies' => Film::where('searchTerm', $this->search)->get(),
            //$movies = Film::search($searchTerm)->paginate(10);
        ]);



        /*
        $searchTerm = $request->input('search');

        // Utilisez la portée de recherche définie dans le modèle Film
        $movies = Film::search($searchTerm)->paginate(10);

        return view('bo.movies', compact('movies'));*/
    }
}