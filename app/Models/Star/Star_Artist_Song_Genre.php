<?php

namespace App\Models\Star;

use Illuminate\Database\Eloquent\Model;

class Star_Artist_Song_Genre extends Model
{
    protected $table = 'star_artists_song_genres';

    protected $primaryKey = 'id';

    protected $fillable = [
        'value',
    ];


    /* Eloquent Relation */
    public function artists()
    {
        return $this->belongsToMany(Star_Artist::class, 'star_artists_star_artists_song_genres', 'song_genre_id', 'artist_id');
    }
}
