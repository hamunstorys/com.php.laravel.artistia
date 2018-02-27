<?php

namespace App\Models\Star;

use Illuminate\Database\Eloquent\Model;

class Star_Artist_Sex extends Model
{
    protected $table = 'star_artist_sexes';
    protected $fillable = [
        'sex',
    ];

    /* Eloquent Relation */
    public function artists()
    {
        return $this->belongsToMany(Star_Artist::class);
    }
}
