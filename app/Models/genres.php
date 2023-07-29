<?php

namespace App\Models;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genres extends Model
{

    //relatin entre film et film avec la table pivot film_genre
    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_genre');
    }
    use HasFactory;
}
