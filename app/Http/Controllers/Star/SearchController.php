<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use App\Models\Star\Star_Artist_Sex;
use App\Models\Star\Star_Artist_Song_Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

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
        $query = null;
        if ($request->has('query')) {
            $query = $request->get('query');

            $group_type_number = $request->get('group_type_number');
            $group_type_sex = $request->get('group_type_sex');
            $group_type_song_genre = $request->get('group_type_song_genre');

            $guarantee_min = $request->get('guarantee_min');
            $guarantee_max = $request->get('guarantee_max');
        }
        return redirect()->route('star.search.show', [
            'query' => $query,
            'group_type_number' => $group_type_number,
            'group_type_sex' => $group_type_sex,
            'group_type_song_genre' => $group_type_song_genre,
            'guarantee_min' => $guarantee_min,
            'guarantee_max' => $guarantee_max,
        ]);
    }

    public function show(Request $request)
    {
        $this->setData($request->get('query'), $request->get('group_type_number'), $request->get('group_type_sex'), $request->get('group_type_song_genre'), $request->get('guarantee_min'), $request->get('guarantee_min'));
        $this->setMessage($request->get('query'), true);

        $group_type_number = $this->setGrouptypeNumbers($request->group_type_number);
        $group_type_sex = $this->setGrouptypeSexes($request->group_type_sex);
        $group_type_song_genre = $this->setGrouptypeSongGenres($request->group_type_song_genre);

        $guarantee_min = $request->get('guarantee_min');
        $guarantee_max = $request->get('guarantee_max');

        return view('star.search.show',
            ['data' => $this->data,
                'message' => $this->message,
                'query' => $request->get('query'),
                'requirement_group_type_number' => $group_type_number,
                'requirement_group_type_sex' => $group_type_sex,
                'requirement_group_type_song_genre' => $group_type_song_genre,
                'requirement_guarantee_min' => $guarantee_min,
                'requirement_guarantee_max' => $guarantee_max,
            ]
        );
    }

    public function showAll(Request $request)
    {

    }

    public function setMessage($query, $message)
    {
        if ($query === null && $message === true) {
            $this->message = "<div class=\"search_result_title\">검색어를 입력 해주십시오.</div></div>";
        } else {
            if ($this->data->count() == null && $message === true) {
                $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 <span> 검색된 것이 없습니다."</div>';
            } else {
                $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 ' . $this->data->count() . '건이 <span> 검색 되었습니다."</div>';
            }
        }
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
            $guarantee_max = 0;
        }

        if ($guarantee_min >= $guarantee_max) {
            $guarantee_min = $guarantee_max;
        }


        if ($query == null) {

            return $this->data = Star_Artist::orWhere(DB::raw("CONCAT_WS(' | ',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%%")
                ->whereRaw($query_grouptypeNumber)
                ->whereRaw($query_grouptypeSex)
                ->join('star_artists_item_song_genres', 'star_artists.id', '=', 'star_artists_item_song_genres.artist_id')
                ->whereRaw($query_grouptypeSongGenre)
                ->whereRaw('guarantee_concert||guarantee_metropolitan||guarantee_central||guarantee_south BETWEEN ' . $guarantee_min . ' AND ' . $guarantee_max)
                ->get();
        } else {
            return $this->data = Star_Artist::where(DB::raw("CONCAT_WS(' | ',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")->
            where('group_type_number', "=", $group_type_number)
                ->whereRaw($query_grouptypeNumber)
                ->whereRaw($query_grouptypeSex)
                ->join('star_artists_item_song_genres', 'star_artists.id', '=', 'star_artists_item_song_genres.artist_id')
                ->whereRaw($query_grouptypeSongGenre)
                ->whereRaw('guarantee_concert||guarantee_metropolitan||guarantee_central||guarantee_south BETWEEN ' . $guarantee_min . ' AND ' . $guarantee_max)
                ->get();
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function setGrouptypeNumbers($group_type_number)
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

    public function setGrouptypeSexes($sex)
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

    public function getMesage()
    {
        return $this->message;
    }
}
