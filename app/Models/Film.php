<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public const TRENDING_FIELDS_MAP = [
        'day' => 'trending_today',
        'week' => 'trending_in_week'
    ];

}
