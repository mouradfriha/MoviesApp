<?php

namespace App\Models;

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
        return $query->where('film_id', '=', $movieId)->first();
    }

}
