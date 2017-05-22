<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ubigeo_code', 'department', 'province', 'district',
    ];

    protected $table = 'ubigeos';

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public static function getDataDepartments()
    {
        $result = Ubigeo::groupBy('department')->select('department')->get();
        return $result;
    }

    public static function getDataCities($val)
    {
        if($val)
        {
            $result = Ubigeo::where('department','=',$val)->groupBy('city')->select('city')->get();
        }
        else
        {
            $result = Ubigeo::groupBy('city')->select('city')->get();
        }
        return $result;
    }

    public static function getDataDistricts($val)
    {
        if($val)
        {
            $result = Ubigeo::where('city','=',$val)->groupBy('district')->select('district')->get();
        }
        else
        {
            $result = Ubigeo::groupBy('district')->select('district')->get();
        }
        return $result;
    }
}
