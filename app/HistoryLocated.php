<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLocated extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
    ];

    public function historyLocation()
    {
        return $this->belongsTo('App\HistoryLocation');
    }

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

}
