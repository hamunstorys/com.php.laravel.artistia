<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->session()->put('query', $request->get('query'));
        return $this->showResults();
    }

    public function showResults()
    {
        /*Session query 의 유효성 검사*/
        if (!Session::has('query')) {
            Session::put('query', "");
        }

        /*Session query 값을 변수 $query에 저장한 후 Star_Artist Table의 총 행의 개수, 검색된 개수, $query 변수를 view star.search.show 에 전달하여 view 를 보여줌 */
        $query = Session::get('query');

        $total_data = Star_Artist::count();
        $data = DB::table('star_artists')->orWhere(DB::raw("CONCAT_WS('|',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")->get();
        return view('star.search.show', compact(['data', 'total_data', 'query']));
    }
}
