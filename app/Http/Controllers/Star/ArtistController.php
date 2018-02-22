<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        $serverUrl = url('/');

        if ($request->hasFile('picture_url')) {
            $manager = new ImageManager();
            $image = $request->picture_url;
            $path = 'assets/star/uploads/artist/thumbnails/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $manager->make($image)->save($path . $filename, 60);

            $artist->fill([
                'picture_url' => $serverUrl . '/' . $path . $filename
            ]);
        } else {
            $artist->fill([
                'picture_url' => $serverUrl . '/assets/star/img/singer.svg'
            ]);
        }

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
            'comment' => $request->get('comment'),
        ]);

        $artist->save();

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

        $artist = Star_Artist::findOrFail($id);

        $serverUrl = url('/');

        if ($request->hasFile('picture_url')) {
            $manager = new ImageManager();
            $image = $request->picture_url;
            $path = 'assets/star/uploads/artist/thumbnails/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $manager->make($image)->save($path . $filename, 60);

            $artist->fill([
                'picture_url' => $serverUrl . '/' . $path . $filename
            ]);
        } else {
            $artist->fill([
                'picture_url' => $serverUrl . '/assets/star/img/singer.svg'
            ]);
        }

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
            'comment' => $request->get('comment'),
        ]);
        
        $artist->update();

        return redirect(route('star.index'));
    }

    public function destroy($id)
    {
        $artist = Star_Artist::findOrFail($id);
        $artist->delete();
        return redirect(route('star.index'));
    }
}