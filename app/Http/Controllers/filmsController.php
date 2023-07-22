<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class filmsController extends Controller
{
    public function index(Request $request){
        $token = "eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1Y2ZkYzE2ZTYwM2IxNTJiNzMxNDY3MGJlNWI3NGYwNSIsInN1YiI6IjY0YmMxMDAzZTlkYTY5MDEyZTBkYjcxNiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.2hDOvWPlhc1XrJ8LKVkcbjxgKV2g66b-Voxrgk88bjw";

        //$films = Http::get('https://api.themoviedb.org/3');
        try {
            $films = Http::withHeaders([
                'Authorization' => "Bearer " . $token
            ])->get('https://api.themoviedb.org/3/trending/all/day');
            
        } catch(\Exception $e) {
            dd($e);
        }
        dd(json_decode($films->body()));
        //$films = ['film1','film2','film3'];
        //dd($films);
        $type = 'action';
        return view('films',compact('films','type'));
        
    }
}
