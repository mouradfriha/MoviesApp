<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MoviesManagementControllerTest extends TestCase
{
    use RefreshDatabase; // Reset the database after each test

    /**
     * @Test
     * Test successful addition of a movie.
     */
    public function testStoreMethodSuccess()
    {
        $data = [
        'backdrop_path' => '/path/to/backdrop.jpg',
        'title' => 'Test Movie',
        'original_language' => 'en',
        'overview' => 'This is a test movie.',
        'poster_path' => '/path/to/poster.jpg',
        'media_type' => 'movie',
        'popularity' => 7.5,
        'vote_average' => 8.2,
        'vote_count' => 1000,
        'adult' => true,
        'video' => true,
        'trending_today' => false,
        'trending_in_week' => true,
        ];

        $response = $this->post(route('bo.movies.store'), $data);

        $response->assertRedirect(); // Check if the response is a redirect
        $response->assertSessionHas('success', 'Movie added successfully!');

        $this->assertDatabaseHas('films', ['title' => 'Test Movie']);
    }

    /**
     * Test addition of a movie with validation errors.
     * @Test
     */
    public function testStoreMethodValidationErrors()
    {
        // Send an empty data array to trigger validation errors
        $data = [];

        $response = $this->post(route('bo.movies.store'), $data);

        $response->assertSessionHas('errors');
        $response->assertSessionHasErrors([
            'backdrop_path' => "The backdrop path field is required.",
            'title' => "The title field is required.",
            'original_language' => "The original language field is required.",
            'overview' => "The overview field is required.", 
            'poster_path' => "The poster path field is required.", 
            'media_type' => "The media type field is required.", 
            'popularity' => "The popularity field is required.",
            'vote_average' => "The vote average field is required.", 
            'vote_count' => "The vote count field is required.", 
        ]);
    }
}