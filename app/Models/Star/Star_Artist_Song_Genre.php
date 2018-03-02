<?php

namespace App\Models\Star;

use Illuminate\Database\Eloquent\Model;

class Star_Artist_Song_Genre extends Model
{
    protected $table = 'star_artist_song_genres';
    protected $fillable = [
        'value',
    ];

    /* Eloquent Relation */
    public function artists()
    {
        return $this->belongsToMany(Star_Artist::class);
    }
}
