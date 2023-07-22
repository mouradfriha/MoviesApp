<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;

class MoviesManagementController extends Controller
{
    

    public function index() {
        $movies = Film::paginate(10);
        return view('bo/movies', compact('movies'));
    }
}
