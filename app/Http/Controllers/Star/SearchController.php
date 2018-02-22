<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        $total_data = Star_Artist::count();
        $data = DB::table('star_artists')->orWhere(DB::raw("CONCAT_WS('|',artist_name,guarantee_concert,guarantee_metropolitan,guarantee_central,guarantee_south,manager_name,manager_phone,company_name,company_email,picture_url,comment)"), 'LIKE', "%" . $query . "%")->get();
        return view('star.search.show', compact(['data', 'total_data', 'query']));
    }
}
