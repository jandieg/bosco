<?php

namespace App;

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
        $department_id = (isset($parameters['department'])) ? $parameters['department'] : FALSE;
        $province_id = (isset($parameters['province'])) ? $parameters['province'] : FALSE;
        $district_id = (isset($parameters['district'])) ? $parameters['district'] : FALSE;

        $result = Report::with(
            [
                'location'=>function($queryLocation){
                    $queryLocation->select('id', 'address');
                },
                'pet'=>function($queryPet) use ($userId){
                    $queryPet->with(
                        [
                            'photos'=>function($queryPhoto){
                                $queryPhoto->select('url', 'pet_id');
                            }, 
                            'user'=>function($queryUser){
                                $queryUser->select('id', 'name');
                            }
                        ]
                    )->select('id', 'user_id', 'name', 'description');
                }
            ]
        );
        if (!empty($userId)){
            $result = $result->whereHas('pet',function ($queryPet) use ($userId){
                $queryPet->where('user_id',$userId);
            });
        }

        $result = $result->select('pet_id', 'id','last_location_id', 'status', 'date');

        if($department_id){
            $ubigeoQuery =  Ubigeo::where('deparment','=',$department_id);
        }
        if($province_id){
            $ubigeoQuery = $ubigeoQuery->where('province','=',$province_id);
        }
        if ($district_id) {
            $ubigeoQuery = $ubigeoQuery->where('district','=',$district_id);
        }

        if($department_id || $province_id || $district_id){
            $ubigeoQuery = $ubigeoQuery->select('id')->get();
            $ubigeos = array_map(function($ubigeoQuery){ return $ubigeoQuery['id']; }, $ubigeoQuery->toArray());

            $result->whereHas('location',function($query) use ($ubigeos){
                $query->whereIn('ubigeo_id',$ubigeos);
            });
        }
        if ($status) $result->where('status', '=', $status);
        if ($paginate) {
            $result = $result->paginate($numPerItem);
            $result->setPath($path);
            $paginate = $result->render();
        }
        else {
            $result = $result->get();
        }

        if (!empty($result)) {
            foreach ($result as $row) {
                $data[] = [
                    'id' => $row->id,
                    'pet_id'=>$row->pet->id,
                    'name' => $row->pet->name, 
                    'date' => new Date($row->date),
                    'address' => $row->location->address, 
                    'description' => $row->pet->description, 
                    'image' => $row->pet->photos[0]->url
                ];
            }
        }

        return ['data' => $data, 'paginate' => $paginate];
    }

    public static function getDataReport($id, $status)
    {
        $data = [];
        
        $result = Report::with(
            [
                'location'=>function($queryLocation){
                    $queryLocation->select('id', 'address');
                },
                'pet'=>function($queryPet){
                    $queryPet->with(
                        [
                            'photos'=>function($queryPhoto){
                                $queryPhoto->select('url', 'pet_id');
                            }, 
                            'user'=>function($queryUser){
                                $queryUser->select('id', 'phone');
                            }
                        ]
                    )->select('id', 'user_id', 'name', 'gender', 'race');
                }
            ]
        )
        ->where('id', '=', $id)
        ->select('id', 'pet_id', 'last_location_id', 'status', 'date')
        ->get();

        if (!empty($result)) {
            $row = $result[0];
            $location = Location::where('id','=',$row->last_location_id)->select('address')->get();
            $user = User::where('id','=',$row->pet->user_id)->select('phone')->get();
            $data = [
                'id' => $row->id,
                'phone' => $user[0]->phone,
                'date' => date('d m Y', strtotime($row->date)), 
                'address' => $location[0]->address, 
                'image' => $row->pet->photos[0]->url
            ];
            if ($status == 'lost') $data['name'] = $row->pet->name;
            if ($status == 'lost') $data['gender'] = trans('bosco.'.$row->pet->gender);
            if ($status == 'lost') $data['race'] = trans('bosco.'.$row->pet->race);
        }

        return $data;
    }
}
