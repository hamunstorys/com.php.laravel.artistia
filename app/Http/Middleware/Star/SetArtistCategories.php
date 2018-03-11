<?php

namespace App\Http\Middleware\Star;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SetArtistCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (Session::has('search_requirement')) {
            return $next($request);
        } else
            $this->setDefaultArtistCategory('song_genres', $this->getDefaultArtistCategory('star_artists_song_genres'));
            $this->setDefaultArtistCategory('sexes', $this->getDefaultArtistCategory('star_artists_sexes'));
        return $next($request);
    }

    public function getDefaultArtistCategory($table)
    {
        return DB::table($table)->select('id', 'value')->get();
    }

    public function setDefaultArtistCategory($requirement, $data)
    {
        Session::put('artist.category.' . $requirement, $data);
    }
}
