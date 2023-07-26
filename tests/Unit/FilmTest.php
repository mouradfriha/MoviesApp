// tests/Feature/FilmTest.php
<?php
// tests/Unit/FilmTest.php

use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmTest extends TestCase
{
    use RefreshDatabase;

    public function testExistingMovieScopeReturnsExistingMovie()
    {
        // Créez un film fictif dans la base de données pour les besoins du test
        $movieData = [
            'film_id' => 123,
            'adult' => false,
            // Ajoutez d'autres données du film ici...
        ];

        Film::create($movieData);

        // Utilisez le scope existingMovie pour récupérer le film fictif
        $movie = Film::existingMovie(123);

        // Vérifiez que le film existe et que les données correspondent
        $this->assertInstanceOf(Film::class, $movie);
        $this->assertEquals($movieData['film_id'], $movie->film_id);
        $this->assertEquals($movieData['adult'], $movie->adult);
        // Vérifiez d'autres données du film ici...
    }

    public function testExistingMovieScopeReturnsNullForNonExistingMovie()
    {
        // Utilisez le scope existingMovie pour rechercher un film qui n'existe pas
        $movie = Film::existingMovie(456);

        // Vérifiez que le film est null car il n'existe pas
        $this->assertNull($movie);
    }
}
