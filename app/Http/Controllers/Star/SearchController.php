<?php

namespace App\Http\Controllers\Star;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class SearchController extends Controller
{
    public $helper;
    public $message;
    public $data;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        return $this->show($query);

    }

    public function show($query)
    {
        $this->setData($query);
        $this->setMessage($query);
        $helper = $this->getHelper();
        return view('star.search.show', ['data' => $this->data, 'helper' => $helper, 'message' => $this->message, 'query' => $query]);
    }

    public function getHelper()
    {
        if (!class_exists('Helper', false)) {
            return $this->helper = new Helper();
        } else {
            return $this->helper;
        }
    }

    public function setMessage($query)
    {
        if ($query == "") {
            $this->message = "<div class=\"search_result_title\">검색어를 입력해 주십시오.</div>";
        } else {
            $this->message = '<div class="search_result_title"><span class="total">"' . $query . '"</span>에 대해 <span>' . $this->data->count() . '</span>건이 검색되었습니다."</div>';
        }
    }

    public function setData($query)
    {
        $this->data = DB::table('star_artists')->orWhere(DB::raw("CONCAT_WS('|',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . $query . "%")->get();
    }

    public function getMesage()
    {

        return $this->message;
    }
}
