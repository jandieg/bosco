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
        $data = [];
        
        $result = Ubigeo::groupBy('department')
        ->select('department')
        ->get();

        if (!empty($result)) {
            foreach ($result as $row) {
                $data[$row->department] = $row->department;
            }
        }

        return $data;
    }

    public static function getDataCities($id)
    {
        $data = [];
        
        $result = Ubigeo::where('department','=',$id)
        ->groupBy('city')
        ->select('city')
        ->get();

        if (!empty($result)) {
            foreach ($result as $row) {
                $data[$row->province] = $row->province;
            }
        }

        return $data;
    }

    public static function getDataDistricts($id)
    {
        $data = [];
        
        $result = Ubigeo::where('city','=',$id)
        ->groupBy('district')
        ->select('id', 'district')
        ->get();

        if (!empty($result)) {
            foreach ($result as $row) {
                $data[$row->id] = $row->district;
            }
        }
        
        return $data;
    }
}
