<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('flush_query');
    }

    public function create()
    {
        return view('star.artist.create');
    }

    public function store(Request $request)
    {
        $post_data = $request->replace(array(
            'artist_name' => $request->artist_name,
            'guarantee_concert' => (int)preg_replace("/[^\d]/", "", $request->guarantee_concert),
            'guarantee_metropolitan' => (int)preg_replace("/[^\d]/", "", $request->guarantee_metropolitan),
            'guarantee_central' => (int)preg_replace("/[^\d]/", "", $request->guarantee_central),
            'guarantee_south' => (int)preg_replace("/[^\d]/", "", $request->guarantee_south),
            'manager_name' => $request->manager_name,
            'manager_phone' => $request->manager_phone,
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'picture_url' => $request->picture_url,
            'comment' => $request->comment
        ));

        $validator = $this->validate($post_data, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'nullable|max:2147483647|Integer',
            'guarantee_metropolitan' => 'nullable|max:2147483647|Integer',
            'guarantee_central' => 'nullable|max:2147483647|Integer',
            'guarantee_south' => 'nullable|max:2147483647|Integer',
            'manager_name' => 'max:255|nullable',
            'manager_phone' => 'nullable',
            'company_name' => 'max:255|nullable',
            'company_email' => 'max:255|nullable',
            'picture_url' => 'image:max:2083|nullable',
            'comment' => 'max:255|nullable',
        ]);

        $artist = new Star_Artist();

        if (isset($post_data->picture_url) != null) {
            $manager = new ImageManager();
            $image = $post_data->picture_url;
            $savePath = 'assets/star/uploads/artist/thumbnails/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $manager->make($image)->save($savePath . $filename, 60);

            $artist->fill([
                'picture_url' => url('/') . '/' . $savePath . $filename
            ]);
            $artist->fill($post_data->except('picture_url'));

        } else {
            $artist->fill([
                'picture_url' => url('/') . '/assets/star/img/icon_singer.svg'
            ]);
            $artist->fill($post_data->except('picture_url'));
        }
        $artist->save();
    }

    public function edit($id)
    {
        $artist = Star_Artist::findOrFail($id);
        return view('star.artist.edit', compact(['artist']));
    }

    public function update(Request $request, $id)
    {
        $post_data = $request->replace(array(
            'artist_name' => $request->artist_name,
            'guarantee_concert' => (int)preg_replace("/[^\d]/", "", $request->guarantee_concert),
            'guarantee_metropolitan' => (int)preg_replace("/[^\d]/", "", $request->guarantee_metropolitan),
            'guarantee_central' => (int)preg_replace("/[^\d]/", "", $request->guarantee_central),
            'guarantee_south' => (int)preg_replace("/[^\d]/", "", $request->guarantee_south),
            'manager_name' => $request->manager_name,
            'manager_phone' => $request->manager_phone,
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'picture_url' => $request->picture_url,
            'comment' => $request->comment
        ));

        $this->validate($post_data, [
            'artist_name' => 'required|max:255',
            'guarantee_concert' => 'nullable|max:2147483647|Integer',
            'guarantee_metropolitan' => 'nullable|max:2147483647|Integer',
            'guarantee_central' => 'nullable|max:2147483647|Integer',
            'guarantee_south' => 'nullable|max:2147483647|Integer',
            'manager_name' => 'max:255|nullable',
            'manager_phone' => 'nullable',
            'company_name' => 'max:255|nullable',
            'company_email' => 'max:255|nullable',
            'picture_url' => 'image:max:2083|nullable',
            'comment' => 'max:255|nullable',
        ]);

        $artist = Star_Artist::findOrFail($id);

        $serverUrl = url('/');

        if ($post_data->hasFile('picture_url')) {
            $path = $this->getPath($artist->picture_url);
            if (file_exists($path) && public_path($path) != public_path('assets/star/img/icon_singer.svg')) {
                File::delete(public_path($path));
            }
            $manager = new ImageManager();
            $image = $post_data->picture_url;
            $path = 'assets/star/uploads/artist/thumbnails/';
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $manager->make($image)->save($path . $filename, 60);
            $artist->fill([
                'picture_url' => $serverUrl . '/' . $path . $filename
            ]);
            $artist->fill($post_data->except('picture_url'));
        }
        $artist->fill($post_data->except('picture_url'));
        $artist->update();
    }

    public function destroy(Request $request, $id)
    {
        $artist = Star_Artist::findOrFail($id);
        $path = $this->getPath($artist->picture_url);
        if (file_exists($path) && public_path($path) != public_path('assets/star/img/icon_singer.svg')) {
            File::delete(public_path($path));
        }
        $artist->delete();
    }

    public function getPath($url)
    {
        return str_replace(url('/') . '/', "", $url);
    }
}