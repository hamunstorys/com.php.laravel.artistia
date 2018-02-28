<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
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
        $query = Input::get('query');
        if($query){
            $request->session()->put('query', $query);
            return 'success';
        }
    }

    public function showResults()
    {
        /*Session query 의 유효성 검사*/
        if (!Session::has('query')) {
            Session::put('query', "");
        }

        /*Session query 값을 변수 $query에 저장한 후 Star_Artist Table의 총 행의 개수, 검색된 개수, $query 변수를 view star.search.show 에 전달하여 view 를 보여줌 */
        $helper = $this->getHelper();
        $this->setData();
        $this->setMessage();
        return view('star.search.show', ['data' => $this->data, 'helper' => $helper, 'message' => $this->message]);
    }

    public function getHelper()
    {
        if (!class_exists('Helper', false)) {
            return $this->helper = new Helper();
        } else {
            return $this->helper;
        }
    }

    public function setMessage()
    {
        if (Session::get('query') == "") {
            $this->message = "<div class=\"search_result_title\">검색어를 입력해 주십시오.</div>";
        } else {
            $this->message = '<div class="search_result_title"><span class="total">"' . Session::get('query') . '"</span>에 대해 <span>' . $this->data->count() . '</span>건이 검색되었습니다."</div>';
        }
    }

    public function setData()
    {
        $this->data = DB::table('star_artists')->orWhere(DB::raw("CONCAT_WS('|',artist_name,manager_name,manager_phone,company_name,company_email,comment)"), 'LIKE', "%" . Session::get('query') . "%")->get();
    }

    public function getMesage()
    {

        return $this->message;
    }
}
