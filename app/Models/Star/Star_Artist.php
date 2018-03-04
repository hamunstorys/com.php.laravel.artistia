<?php

namespace App\Models\Star;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Star_Artist extends Model
{
    protected $table = 'star_artists';

    protected $primaryKey = 'id';

    protected $fillable = [
        'artist_name',
        'guarantee_concert', 'guarantee_metropolitan', 'guarantee_central', 'guarantee_south',
        'manager_name', 'manager_phone', 'company_name', 'company_email', 'picture_url', 'comment', 'created_at', 'updated_at',
        'group_type_number', 'group_type_sex',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    /* Don't get data */
    protected $hidden = [

    ];

    /* Eloquent Relation */

    public function song_genres()
    {
        return $this->belongsToMany(Star_Artist_Song_Genre::class, 'star_artists_star_artists_song_genres', 'artist_id', 'song_genre_id');
    }
}