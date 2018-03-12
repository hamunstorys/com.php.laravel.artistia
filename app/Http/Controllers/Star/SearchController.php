<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use App\Models\Star\Star_Artist_Sex;
use App\Models\Star\Star_Artist_Song_Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public $message;
    public $data;

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $request->replace([
            "query" => $request->get('query'),
            "search_group_type_number" => $request->get('search_group_type_number'),
            "search_group_type_sex" => $request->get('search_group_type_sex'),
            "search_group_type_song_genre" => $request->get('search_group_type_song_genre'),
            "search_guarantee_min" => (int)preg_replace("/[^\d]/", "", $request->get('search_guarantee_min')),
            "search_guarantee_max" => (int)preg_replace("/[^\d]/", "", $request->get('search_guarantee_max'))
        ]);

        $query = null;
        if ($request->has('query')) {
            $query = $request->get('query');
            $group_type_number = $request->get('search_group_type_number');
            $group_type_sex = $request->get('search_group_type_sex');
            $group_type_song_genre = $request->get('search_group_type_song_genre');
            $guarantee_min = $request->get('search_guarantee_min');
            $guarantee_max = $request->get('search_guarantee_max');
        }
        return redirect()->route('star.search.show', [
            'query' => $query,
            'search_group_type_number' => $group_type_number,
            'search_group_type_sex' => $group_type_sex,
            'search_group_type_song_genre' => $group_type_song_genre,
            'search_guarantee_min' => $guarantee_min,
            'search_guarantee_max' => $guarantee_max,
        ]);
    }

    public function show(Request $request)
    {
        $this->setData(
            $request->get('query'),
            $request->get('search_group_type_number'),
            $request->get('search_group_type_sex'),
            $request->get('search_group_type_song_genre'),
            (int)$request->get('search_guarantee_min'),
            (int)$request->get('search_guarantee_max')
        );
        $this->setMessage($request->get('query'), true);
        $group_type_number = $this->setGrouptypeNumbers($request->search_group_type_number);
        $group_type_sex = $this->setGrouptypeSexes($request->search_group_type_sex);
        $group_type_song_genre = $this->setGrouptypeSongGenres($request->search_group_type_song_genre);
        $guarantee_min = $request->get('search_guarantee_min');
        $guarantee_max = $request->get('search_guarantee_max');
        
        return view('star.search.show',
            [
                'data' => $this->data,
                'message' => $this->message,
                'query' => $request->get('query'),
                'search_group_type_number' => $group_type_number,
                'search_group_type_sex' => $group_type_sex,
                'search_group_type_song_genre' => $group_type_song_genre,
                'search_guarantee_min' => $guarantee_min,
                'search_guarantee_max' => $guarantee_max,
            ]
        );
    }

    public function showAll()
    {
        $this->setData(
            null,
            0,
            0,
            0,
            null,
            null
        );

        $group_type_number = $this->setGrouptypeNumbers(0);
        $group_type_sex = $this->setGrouptypeSexes(0);
        $group_type_song_genre = $this->setGrouptypeSongGenres(0);

        return view('star.search.show',
            [
                'data' => $this->data,
                'query' => null,
                'search_group_type_number' => $group_type_number,
                'search_group_type_sex' => $group_type_sex,
                'search_group_type_song_genre' => $group_type_song_genre,
                'search_guarantee_min' => null,
                'search_guarantee_max' => null
            ]
        );
    }


    public function setData($query, $group_type_number, $group_type_sex, $group_type_song_genre, $guarantee_min, $guarantee_max)
    {
        if ($group_type_number == 0) {
            $query_grouptypeNumber = 'group_type_number BETWEEN 1 AND 2';
        } else {
            $query_grouptypeNumber = 'group_type_number = ' . $group_type_number;
        }
        if ($group_type_sex == 0) {
            $query_grouptypeSex = 'group_type_sex BETWEEN 1 AND ' . Star_Artist_Sex::count();
        } else {
            $query_grouptypeSex = 'group_type_sex = ' . $group_type_sex;
        }
        if ($group_type_song_genre == 0) {
            $query_grouptypeSongGenre = 'song_genre_id BETWEEN 1 AND ' . Star_Artist_Song_Genre::count();
        } else {
            $query_grouptypeSongGenre = 'song_genre_id =' . $group_type_song_genre;
        }
        if ($guarantee_min == null) {
            $guarantee_min = 0;
        }
        if ($guarantee_max == null) {
            $guarantee_max = PHP_INT_MAX;
        }
        if ($guarantee_min >= $guarantee_max) {
            $guarantee_max = $guarantee_min;
        }

        if ($query == null) {
            $this->data = Star_Artist::where(DB::raw("CONCAT_WS(' | ',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")
                ->whereRaw($query_grouptypeNumber)
                ->whereRaw($query_grouptypeSex)
                ->join('star_artists_item_song_genres', 'star_artists.id', '=', 'star_artists_item_song_genres.artist_id')
                ->whereRaw($query_grouptypeSongGenre)
                ->whereRaw('guarantee_concert&guarantee_metropolitan&guarantee_central&guarantee_south BETWEEN ' . $guarantee_min . ' AND ' . $guarantee_max)
                ->get();
        } else {
            $this->data = Star_Artist::where(DB::raw("CONCAT_WS(' | ',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")
                ->whereRaw($query_grouptypeNumber)
                ->whereRaw($query_grouptypeSex)
                ->join('star_artists_item_song_genres', 'star_artists.id', '=', 'star_artists_item_song_genres.artist_id')
                ->whereRaw($query_grouptypeSongGenre)
                ->whereRaw('guarantee_concert&guarantee_metropolitan&guarantee_central&guarantee_south BETWEEN ' . $guarantee_min . ' AND ' . $guarantee_max)
                ->get();
        }
    }

    public function setMessage($query, $message)
    {
        if ($this->data->count() == null && $message === true) {
            $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 <span> 검색된 것이 없습니다."</div>';
        } else if ($query != null) {
            $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 ' . $this->data->count() . '건이 <span> 검색 되었습니다."</div>';
        }
    }

    public
    function setGrouptypeNumbers($group_type_number)
    {
        switch ($group_type_number) {
            case 0:
                return array(
                    ' <option selected="selected" value = "0" > 전체</option > ',
                    '<option value="1" >솔로</option>',
                    '<option value= "2" >그룹</option>'
                );
            case 1:
                return array(
                    '<option value = "0" >전체</option >',
                    '<option selected = "selected" value = "1" >솔로</option >',
                    '<option value = "2" >그룹</option >'
                );
                break;
            case 2:
                return array(
                    '<option value = "0" >전체</option >',
                    '<option value = "1" >솔로</option >',
                    '<option selected = "selected" value = "2" >그룹</option >'
                );
        }
    }


    public
    function setGrouptypeSexes($sex)
    {
        $group_type_sex = Star_Artist_Sex::all();
        $group_type_sex_temp = array();
        if ($sex == 0) {
            array_push($group_type_sex_temp, '<option selected = "selected" value = "0" > 전체</option > ');
        } else {
            array_push($group_type_sex_temp, '<option value = "0" > 전체</option > ');
        }
        for ($i = 1; $i <= $group_type_sex->count(); $i++) {
            if ($i == $sex) {
                array_push($group_type_sex_temp, '<option selected = "selected" value = "' . $i . '" > ' . $group_type_sex->find($i)->value . '</option > ');
                continue;
            } else {
                array_push($group_type_sex_temp, '<option value = "' . $i . '" > ' . $group_type_sex->find($i)->value . '</option > ');
            }
        }
        return $group_type_sex_temp;
    }

    public function setGrouptypeSongGenres($song_genre)
    {
        $group_type_song_genres = Star_Artist_Song_Genre::all();
        $group_type_song_genres_temp = array();
        if ($song_genre == 0) {
            array_push($group_type_song_genres_temp, '<option selected = "selected" value = "0" > 전체</option > ');
        } else {
            array_push($group_type_song_genres_temp, '<option value = "0" > 전체</option > ');
        }
        for ($i = 1; $i <= $group_type_song_genres->count(); $i++) {
            if ($i == $song_genre) {
                array_push($group_type_song_genres_temp, '<option selected = "selected" value = "' . $i . '" > ' . $group_type_song_genres->find($i)->value . '</option > ');
                continue;
            } else {
                array_push($group_type_song_genres_temp, '<option value = "' . $i . '" > ' . $group_type_song_genres->find($i)->value . '</option > ');
            }
        }
        return $group_type_song_genres_temp;
    }


    public
    function getData()
    {
        return $this->data;
    }


    public function getMesage()
    {
        return $this->message;
    }
}