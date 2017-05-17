<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLocation extends Model
{

    public function historyLocated()
    {
        return $this->hasMany('App\HistoryLocated');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }
}
