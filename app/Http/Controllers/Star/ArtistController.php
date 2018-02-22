<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function __construct()
    {

    }

    public function create()
    {
        return view('star.artist.create',compact('query'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'nullable',
            'guarantee_metropolitan' => 'nullable',
            'guarantee_central' => 'nullable',
            'guarantee_south' => 'nullable',
            'manager_name' => 'max:255|nullable',
            'manager_phone' => 'numeric|nullable',
            'company_name' => 'max:255|nullable',
            'company_email' => 'max:255|nullable',
            'picture_url' => 'max:2083|nullable',
            'comment' => 'max:255|nullable',
        ]);

        $artist = new Star_Artist();
        $artist->fill([
            'artist_name' => $request->get('artist_name'),
            'guarantee_concert' => $request->get('guarantee_concert'),
            'guarantee_metropolitan' => $request->get('guarantee_metropolitan'),
            'guarantee_central' => $request->get('guarantee_central'),
            'guarantee_south' => $request->get('guarantee_south'),
            'manager_name' => $request->get('manager_name'),
            'manager_phone' => $request->get('manager_phone'),
            'company_name' => $request->get('company_name'),
            'company_email' => $request->get('company_email'),
            'picture_url' => $request->get('picture_url'),
            'comment' => $request->get('comment'),
        ]);

        $artist->save();

//        Article::whereSubject($request->get('subject'))->update([
//            'thumbnail' => url('/') . '/storage/photos/' . $request->user()->id . '/articles/thumbnails/' . Article::whereSubject($request->get('subject'))->first()->id . '.jpg'
//        ]);
//        if ($request->hasFile('thumbnail')) {
//            if (!File::isDirectory('storage/app/public/photos/articles/thumbnails/'))
//                Storage::makeDirectory('public/photos/' . $request->user()->id . '/articles/thumbnails/');
//            Image::make($request->thumbnail)->resize(384, 288)->save('storage/photos/' . $request->user()->id . '/articles/thumbnails/' . $article->id . '.jpg');
//        }
//        flash('게시물이 작성되었습니다.');
        return redirect(route('star.index'));
    }

    public function edit(Request $request, $id)
    {
        $query = $request->get('query');
        $artist = Star_Artist::findOrFail($id);
        return view('star.artist.edit', compact(['artist', 'query']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'nullable',
            'guarantee_metropolitan' => 'nullable',
            'guarantee_central' => 'nullable',
            'guarantee_south' => 'nullable',
            'manager_name' => 'max:255|nullable',
            'manager_phone' => 'numeric|nullable',
            'company_name' => 'max:255|nullable',
            'company_email' => 'max:255|nullable',
            'picture_url' => 'max:2083|nullable',
            'comment' => 'max:255|nullable',
        ]);

        $article = Star_Artist::findOrFail($id);
        $article->update($request->all());

        return redirect(route('star.index'));
    }

    public function destroy($id)
    {
        $artist = Star_Artist::findOrFail($id);
        $artist->delete();
        return redirect(route('star.index'));
    }
}