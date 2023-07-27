<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Movie extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          

            'film_id' => 'required|integer',
            'adult' => 'boolean',
            'backdrop_path' => 'required|string',
            'title' => 'required|string|max:255',
            'original_language' => 'required|string',
            'original_title' => 'string|max:255',
            'overview' => 'required|string',
            'poster_path' => 'required|string',
            'media_type' => 'required|string',
            'popularity' => 'required|numeric|min:0',
            'video' => 'boolean',
            'vote_average' => 'required|numeric|min:0|max:10',
            'vote_count' => 'required|integer|min:0',
            'trending_today' => 'boolean',              
            'trending_in_week' => 'boolean',
           
        ];
    }
}
