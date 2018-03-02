<?php

namespace App\Models\Star;

use Illuminate\Database\Eloquent\Model;

class Star_Artist_Sex extends Model
{
    protected $table = 'star_artists_sexes';
    protected $fillable = [
        'value',
    ];

    /* Eloquent Relation */
    public function artist()
    {
        return $this->belongsToMany(Star_Artist::class);
    }
}
