<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'latitude', 'longitude', 'level',
    ];

    public function historyLocations()
    {
        return $this->hasMany('App\HistoryLocation');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function ubigeo()
    {
        return $this->belongsTo('App\Ubigeo');
    }
}
