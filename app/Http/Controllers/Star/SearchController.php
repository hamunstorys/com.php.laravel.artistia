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
    public $helper;
    public $message;
    public $data;
    public $alert;

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
        }
        return redirect(route('star.search.show', ['query' => $query, 'group_type_number' => $group_type_number, 'group_type_sex' => $group_type_sex, 'group_type_song_genre' => $group_type_song_genre]));
    }

    public function show(Request $request)
    {
        $this->setData($request->get('query'));
        $this->setMessage($request->get('query'));
        $group_type_number = $this->setGrouptypeNumbers((int)$request->get('group_type_number'));
        $group_type_sex = $this->setGrouptypeSexes((int)$request->get('group_type_sex'));
        $group_type_song_genre = $this->setGrouptypeSongGenres((int)$request->get('group_type_song_genre'));
        return view('star.search.show', ['data' => $this->data, 'message' => $this->message, 'query' => $request->get('query'), 'group_type_number' => $group_type_number, 'group_type_sex' => $group_type_sex, 'group_type_song_genre' => $group_type_song_genre]);
    }

    public function setMessage($query)
    {
        if ($query === null) {
            $this->message = "<div class=\"search_result_title\">검색어를 입력 해주십시오.</div></div>";
        } else {
            if ($this->data->count() == null) {
                $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 <span> 검색된 것이 없습니다."</div>';
            } else {
                $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 ' . $this->data->count() . '건이 <span> 검색 되었습니다."</div>';
            }
        }
    }

    public function setData($query)
    {
        if ($query == null) {
            $this->data = Star_Artist::orWhere(DB::raw("CONCAT_WS('|',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%%")->get();
        } else {
            $this->data = Star_Artist::orWhere(DB::raw("CONCAT_WS('|',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")->get();
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
                    '<option selected="selected" value="0">전체</option>',
                    '<option value="1">솔로</option>',
                    '<option value="2">그룹</option>'
                );
            case 1:
                return array(
                    '<option value="0">전체</option>',
                    '<option selected="selected" value="1">솔로</option>',
                    '<option value="2">그룹</option>'
                );
                break;
            case 2:
                return array(
                    '<option value="0">전체</option>',
                    '<option value="1">솔로</option>',
                    '<option selected="selected" value="2">그룹</option>'
                );
        }
    }

    public function setGrouptypeSexes($sex)
    {
        $group_type_sex = Star_Artist_Sex::all();
        $group_type_sex_temp = array();
        if ($sex == 0) {
            array_push($group_type_sex_temp, '<option selected="selected" value="0">전체</option>');
        } else {
            array_push($group_type_sex_temp, '<option value="0">전체</option>');
        }
        for ($i = 1; $i <= $group_type_sex->count(); $i++) {
            if ($i == $sex) {
                array_push($group_type_sex_temp, '<option selected="selected" value="' . $i . '">' . $group_type_sex->find($i)->value . '</option>');
                continue;
            } else {
                array_push($group_type_sex_temp, '<option value="' . $i . '">' . $group_type_sex->find($i)->value . '</option>');
            }
        }
        return $group_type_sex_temp;
    }

    public function setGrouptypeSongGenres($song_genre)
    {
        $group_type_song_genres = Star_Artist_Song_Genre::all();
        $group_type_song_genres_temp = array();
        if ($song_genre == 0) {
            array_push($group_type_song_genres_temp, '<option selected="selected" value="0">전체</option>');
        } else {
            array_push($group_type_song_genres_temp, '<option value="0">전체</option>');
        }
        for ($i = 1; $i <= $group_type_song_genres->count(); $i++) {
            if ($i == $song_genre) {
                array_push($group_type_song_genres_temp, '<option selected="selected" value="' . $i . '">' . $group_type_song_genres->find($i)->value . '</option>');
                continue;
            } else {
                array_push($group_type_song_genres_temp, '<option value="' . $i . '">' . $group_type_song_genres->find($i)->value . '</option>');
            }
        }
        return $group_type_song_genres_temp;
    }

    public function getMesage()
    {
        return $this->message;
    }
}
