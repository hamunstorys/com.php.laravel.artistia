<?php

namespace App\Http\Controllers\Star;

use App\Models\Star\Star_Artist;
use App\Models\Star\Star_Artist_Sex;
use App\Models\Star\Star_Artist_Song_Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use App\Http\Controllers\Controller;

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
            'group_type_number' => $request->group_type_number,
            'group_type_sex' => $request->group_type_sex,
            'group_type_song_genres' => $request->group_type_song_genres,
            'comment' => $request->comment
        ));

        $artist = new Star_Artist();

        if (isset($post_data->picture_url) != null) {
            $manager = new ImageManager();
            $image = $request->file('picture_url');
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
        Star_Artist_Sex::find($request->group_type_sex)->artist()->save($artist);
        $artist->song_genres()->sync($request->group_type_song_genres);
    }

    public function edit($id)
    {
        $artist = Star_Artist::findOrFail($id);

        $this->setGrouptypeNumberInEdit($artist);
        $this->setGrouptypeSexInEdit($artist);
        $this->setGrouptypeSongGenresInEdit($artist);

        return view('star.artist.edit', compact(['artist']));
    }

    public function setGrouptypeNumberInEdit($artist)
    {
        if ($artist->group_type_number == 1) {
            $artist->group_type_number = array('<option selected="selected" value="1">솔로</option>', '<option value="2">그룹</option>');
        } else {
            $artist->group_type_number = array('<option value="1">솔로</option>', '<option selected="selected" value="2">그룹</option>');
        }
    }

    public function setGrouptypeSexInEdit($artist)
    {
        $sex = Star_Artist_Sex::all();
        $artist_sex_temp = array();
        for ($i = 1; $i <= $sex->count(); $i++) {
            if ($i == $artist->group_type_sex) {
                array_push($artist_sex_temp, '<option selected="selected" value="' . $i . '">' . $sex->find($i)->value . '</option>');
                continue;
            } else {
                array_push($artist_sex_temp, '<option value="' . $i . '">' . $sex->find($i)->value . '</option>');
            }
        }
        $artist->group_type_sex = $artist_sex_temp;
        unset($artist_sex_temp);
    }

    public function setGrouptypeSongGenresInEdit($artist)
    {
        $song_genres = Star_Artist_Song_Genre::all();
        $artist_song_genres = Star_Artist::find($artist->id)->song_genres()->first()->pivot;
        $artist_song_genres_temp = array();
        for ($i = 1; $i <= $song_genres->count(); $i++) {
            if ($i == $artist_song_genres->song_genre_id) {
                array_push($artist_song_genres_temp, '<option selected="selected" value="' . $i . '">' . $song_genres->find($i)->value . '</option>');
                continue;
            } else {
                array_push($artist_song_genres_temp, '<option value="' . $i . '">' . $song_genres->find($i)->value . '</option>');
            }
        }
        $artist->group_type_song_genres = $artist_song_genres_temp;
        unset($artist_sex_temp);
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
            'group_type_number' => $request->group_type_number,
            'group_type_sex' => $request->group_type_sex,
            'group_type_song_genres' => $request->group_type_song_genres,
            'picture_url' => $request->picture_url,
            'comment' => $request->comment
        ));

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
        Star_Artist_Sex::find($request->group_type_sex)->artist()->save($artist);
        $artist->song_genres()->sync($request->group_type_song_genres);
    }

    public
    function destroy(Request $request, $id)
    {
        $artist = Star_Artist::findOrFail($id);
        $path = $this->getPath($artist->picture_url);
        if (file_exists($path) && public_path($path) != public_path('assets/star/img/icon_singer.svg')) {
            File::delete(public_path($path));
        }
        $artist->delete();
        return redirect()->back();
    }

    public
    function getPath($url)
    {
        return str_replace(url('/') . '/', "", $url);
    }
}