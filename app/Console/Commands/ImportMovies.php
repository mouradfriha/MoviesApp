<?php

namespace App\Console\Commands;

use App\Service\GenresService;
use App\Service\MoviesService;
use Illuminate\Console\Command;

class ImportMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports movies from TMDB API';

    /**
     * Execute the console command.
     */
    public function handle(MoviesService $moviesService, GenresService $genresService)
    {

        $moviesService->importMoviesPerTrend('day');
        $moviesService->importMoviesPerTrend('week');
        $genresService->importGenres();
        echo "detail imported successfully\n";
        echo "Movies imported successfully\n";
        
    }

   /* public function handle(GenresService $genresService)
    {        
        $genresService->importGenres();
        echo "detail imported successfully\n";
        
    }*/
}
