<?php

namespace App\Console\Commands;

use App\Service\GenresService;
use Illuminate\Console\Command;

class ImportDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:detail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command imports details movies from TMDB API';

    /**
     * Execute the console command.
     */
    public function handle(GenresService $genresService)
    {        
        $genresService->importGenres();
        echo "detail imported successfully\n";
        
    }
}
