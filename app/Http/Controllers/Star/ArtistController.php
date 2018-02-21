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
        return view('star.artist.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'numeric|integer',
            'guarantee_metropolitan' => 'numeric|integer',
            'guarantee_central' => 'numeric|integer',
            'guarantee_south' => 'numeric|integer',
            'manager_name' => 'max:255',
            'manager_phone' => 'numeric',
            'company_name' => 'max:255',
            'company_email' => 'max:255|email',
            'picture_url' => 'max:2083',
            'comment' => 'max:255',
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

    public function edit($id)
    {
        $artist = Star_Artist::find($id);
        return view('star.artist.edit', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'numeric|integer',
            'guarantee_metropolitan' => 'numeric|integer',
            'guarantee_central' => 'numeric|integer',
            'guarantee_south' => 'numeric|integer',
            'manager_name' => 'max:255',
            'manager_phone' => 'numeric',
            'company_name' => 'max:255',
            'company_email' => 'max:255|email',
            'picture_url' => 'max:2083',
            'comment' => 'max:255',
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