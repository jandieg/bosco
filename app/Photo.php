<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'width', 'heihgt',
    ];

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }
}
