<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Film extends Model
{
    use HasFactory;

    public const TRENDING_FIELDS_MAP = [
        'day' => 'trending_today',
        'week' => 'trending_in_week'
    ];

    // scope pour verifie le tendance day/week
    public function scopeTrending(Builder $query, string $trend): Collection
    {
        // Vérifiez si la clé existe dans le tableau des champs tendances
        if (array_key_exists($trend, self::TRENDING_FIELDS_MAP)) {
            return $query->where(self::TRENDING_FIELDS_MAP[$trend], true)->get();
        } else {
            // Si la clé n'existe pas, retournez une collection vide (ou null si vous préférez)
            return collect([]);
        }
    }

    //teste si le film existe
    public function scopeExistingMovie(Builder $query, int $movieId): ?Film
    {
        return $query->where('id', $movieId)->first();
    }
    // fonction pour cherche un film ds la liste des films
    public function scopeSearch($query, $searchTerm)
    {
        // Appliquez la recherche si un terme de recherche est fourni
        if ($searchTerm) {
            return $query->where('title', 'like', '%' . $searchTerm . '%');
        } else {
            // Si aucun terme de recherche n'est fourni, retournez tous les films
            return $query;
        }
    }
    // relation entre table genre  et film avec la table pivot film_genre
    /**
     * Summary of genres
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'film_genre');
        ///return $this->belongsToMany(genres::class, 'film_genre')->onDelete('cascade');
        
    }

    /**
     * Summary of getMovieGenresAttribute
     * @return mixed
     */
    public function getMovieGenresAttribute()
    {
        return $this->genres->pluck('id')->toArray();
    }

}
