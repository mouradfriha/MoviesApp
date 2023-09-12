<?php

namespace App\Http\Livewire;
use App\Models\Film;
use Livewire\WithPagination;
use Livewire\Component;

class FilmsList extends Component
{
    use WithPagination;
 
    public $search = '';
 
    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function render()
    {
        return view('livewire.films-list', [
            'movies' => Film::where('title', 'like', '%'.$this->search.'%')->paginate(10),
        ]);
    }
    /*public function render()
    {
        return view('livewire.films-list', [
            'movies' => Film::paginate(10),
        ]);
    }
        */
}
