<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'description', 'status', 'reward', 'code_qr',
    ];
    
    public function location()
    {
        return $this->belongsTo('App\Location','last_location_id');
    }

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

    public static function getDataReports($parameters = array(), $paginate = FALSE, $numPerItem = 10, $path = 'mascotas/perdidos')
    {
        $data = [];
        $status = (isset($parameters['status'])) ? $parameters['status'] : FALSE;
        $userId = (isset($parameters['userid'])) ? $parameters['userid'] : FALSE;
        $flagFound = (isset($parameters['found'])) ? $parameters['found'] : FALSE;
        $user= Auth::user();
        if($status) 
            $reports = Report::where('status',$status)->orderBy('id', 'desc')->limit($numPerItem)->get();
        else
            $reports = Report::orderBy('id', 'desc')->limit($numPerItem)->get();            
        if (!empty($reports)) {            
            foreach ($reports as $report) {
                if(is_object($user) && $user && $user->id!=$report->pet->owner_id) continue;
                if (! $flagFound && $report->found == 1) continue;
                $date_time=explode(' ',$report->date);
                $report_date=$date_time[0];
                $report_date=date("d M Y", strtotime($report_date));
                $address=str_replace("Distrito de ","",$report->location->address);
                $address=str_replace("Provincia de ","",$address);
                $data[] = [
                    'id' => $report->id,
                    'status' => $report->status,
                    'pet_id'=>$report->pet->id,
                    'name' => $report->pet->name, 
                    'race' => $report->pet->race, 
                    'gender' => $report->pet->gender, 
                    'date' => $report_date." ".$date_time[1],
                    'address' => $address, 
                    'description' => $report->pet->description, 
                    'image' => $report->pet->photos[0]->url
                ];
            }
        }

        return ['data' => $data, 'paginate' => $paginate];
    }
    

    public static function getPublicReports($parameters = array(), $paginate = FALSE, $numPerItem = 10, $path = 'mascotas/perdidos')
    {
        $data = [];
        $status = (isset($parameters['status'])) ? $parameters['status'] : FALSE;
        $userId = (isset($parameters['userid'])) ? $parameters['userid'] : FALSE;
        $user= Auth::user();
        if($status) 
            $reports = Report::where('status',$status)->where('found', 0)->orderBy('id', 'desc')->limit($numPerItem)->get();
        else
            $reports = Report::where('found', 0)->orderBy('id', 'desc')->limit($numPerItem)->get();            
        if (!empty($reports)) {            
            foreach ($reports as $report) {
                if (is_object($report->location)) {
                    $date_time=explode(' ',$report->date);
                    $report_date=$date_time[0];
                    $report_date=date("d M Y", strtotime($report_date));
                    $address=str_replace("Distrito de ","",$report->location->address);
                    $address=str_replace("Provincia de ","",$address);
                    $data[] = [
                        'id' => $report->id,
                        'status' => $report->status,
                        'pet_id'=>$report->pet->id,
                        'name' => $report->pet->name, 
                        'race' => $report->pet->race, 
                        'gender' => $report->pet->gender, 
                        'date' => $report_date,
                        'address' => $address, 
                        'description' => $report->pet->description, 
                        'image' => $report->pet->photos[0]->url
                    ];
                }
                
            }
        }

        return ['data' => $data, 'paginate' => $paginate];
    }

    public static function getDataReport($id)
    {
        $meses = array(
            "01" => "Enero",
            "02" => "Febrero",
            "03" => "Marzo",
            "04" => "Abril",
            "05" => "Mayo",
            "06" => "Junio",
            "07" => "Julio",
            "08" => "Agosto",
            "09" => "Septiembre",
            "10" => "Octubre",
            "11" => "Noviembre",
            "12" => "Diciembre"
        );
        $data = [];
        $user= Auth::user();
        $report = Report::where('id',$id)->first();
        $user = User::where('id',$report->pet->owner_id)->first();        
        $date_time=explode(' ',$report->date);
        $report_date=$date_time[0];
        $dia = date("d", strtotime($report_date));        
        $anho = date("Y", strtotime($report_date));        
        $mesnum = date("m", strtotime($report_date));        
        $mes = $meses[$mesnum];
        $report_date=date("d M Y", strtotime($report_date));        
        $address=str_replace("Distrito de ","",$report->location->address);
        $address=str_replace("Provincia de ","",$address);
        if (! empty($report->phone)) {
            $data = [
                'id' => $report->id,
                'status' => $report->status,
                'pet_id'=>$report->pet->id,
                'user_phone'=>$report->phone,
                'name' => $report->pet->name, 
                'race' => $report->pet->race, 
                'gender' => $report->pet->gender, 
                'reward' => (! empty($report->reward))?$report->reward:'',
                'date' => $dia . " " . $mes . " " . $anho,
                'address' => $address, 
                'description' => $report->pet->description, 
                'image' => $report->pet->photos[0]->url
            ];
        } else {
            $data = [
                'id' => $report->id,
                'status' => $report->status,
                'pet_id'=>$report->pet->id,
                'user_phone'=>$user->phone,
                'name' => $report->pet->name, 
                'race' => $report->pet->race, 
                'gender' => $report->pet->gender, 
                'reward' => $report->reward,
                'date' => $dia . " " . $mes . " " . $anho,
                'address' => $address, 
                'description' => $report->pet->description, 
                'image' => $report->pet->photos[0]->url
            ];
        }
        
//        var_dump($report);exit;
        return $data;
    }
}
