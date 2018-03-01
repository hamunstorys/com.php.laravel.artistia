<?php

namespace App\Http\Middleware\Star;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SearchRequirement
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
            $this->setDefaultSearchRequirement('song_generes', $this->getSearchRequirement('star_artist_song_genres'));
        $this->setDefaultSearchRequirement('sexes', $this->getSearchRequirement('star_artist_sexes'));
        return $next($request);
    }

    public function getSearchRequirement($table)
    {
        return DB::table($table)->select('value')->get();
    }

    public function setDefaultSearchRequirement($requirement, $data)
    {
        Session::put('search_requirement.' . $requirement, $data);
    }
}
