<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Jenssegers\Date\Date;

class Pet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'race', 'gender', 'description',
    ];

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function historyLocated()
    {
        return $this->hasMany('App\HistoryLocated');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getDataPet($id, $status)
    {
        $data = [];
        $report = Report::where('id',$id)->first();
        $pet = Pet::where('id',$report->pet_id)->first();
        $photo = Photo::where('pet_id',$pet->id)->first();
        $user = User::where('id',$pet->owner_id)->first();
        $location = Location::where('id',$report->last_location_id)->first();
        $ubigeo = Ubigeo::where('id',$location->ubigeo_id)->first();
        $date_time=explode(' ',$report->date);
        $report_date=$date_time[0];
        $report_date=date("d M Y", strtotime($report_date));
        $report_time=$date_time[1];        
        $address=str_replace("Distrito de ","",$location->address);
        $address=str_replace("Provincia de ","",$address);
        $data = [
            'user_name' => $user->name . ' ' . $user->last_name,
            'user_phone' => $user->phone?$user->phone:$report->phone,
            'user_email' => $user->email,
            'is_owner' => $report->is_owner?'Dueño':'Usuario',
            'owner_reward' => $report->reward,
            'pet_name' => $pet->name, 
            'pet_race' => $pet->race,
            'pet_gender' => $pet->gender,
            'pet_image' => $photo->url,
            'pet_description' => $pet->description, 
            'report_date' => $report_date,
            'report_time' => $report_time,
            'report_description' => $report->description,
            'location_address' => $address,
            'location_latitude' => $location->latitude,
            'location_longitude' => $location->longitude,
            'ubigeo_department' => $ubigeo->department,
            'ubigeo_city' => $ubigeo->city,
            'ubigeo_district' => $ubigeo->district,
            'ubigeo_code' => $ubigeo->ubigeo_code,
            'owner_phone' => $report->phone, 
            'label' => $status=='lost'?'Última vez visto por:':'Encontrado en:'
        ];
        
        return $data;
    }
}
