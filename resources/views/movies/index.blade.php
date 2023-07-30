
@component('layouts.guest')

    <div class="container px-4 max-w-5xl mx-auto pb-5">
        <div class="py-3">
            <div class="flex justify-between">
                <h1 class="text-3xl font-extrabold">Trending Movies - {{ ucfirst($trend) }}</h1>
                
                <form name="trend-form" action="{{route('movies.index')}}" method="get">
                    <select name="trend" onchange="this.form.submit()">
                        <option value="day" @if ($trend === 'day') selected  @endif>Today</option>
                        <option value="week"  @if ($trend === 'week') selected  @endif>This Week</option>
                    </select>
                </form>
                
            </div>
        </div>
        
        <div class="grid grid-cols-4 gap-3">
            @foreach($trendingMovies as $movie)
                <a href="{{route('movies.show', $movie->id)}}">
                    
                    <img class="rounded-xl" src="https://image.tmdb.org/t/p/w500{{$movie->poster_path}}" />
                    <h2 class="text-center font-semibold">{{ $movie->title }}</h2>

                </a>
            @endforeach
        </div>        
    </div>

@endcomponent