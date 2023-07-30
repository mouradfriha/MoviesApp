<?php
// app/Models/Movie.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films'; // Nom de la table correspondante dans la base de données

    // Liste des propriétés correspondant aux colonnes de la table films
    protected $fillable = [
        'id',
        'adult',
        'backdrop_path',
        'title',
        'original_language',
        'original_title',
        'overview',
        'poster_path',
        'media_type',
        'popularity',        
        'video',
        'vote_average',
        'vote_count',
        'trending_today',
        'trending_in_week',
    ];

    // Définir d'autres propriétés ou méthodes spécifiques à la classe Film si nécessaire
}