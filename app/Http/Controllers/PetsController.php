<?php

namespace App\Http\Controllers;

use App\Pet;
use App\Ubigeo;
use App\Report;
use App\Location;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetsController extends Controller {
    

    public function __construct() {
       $this->middleware('api');
    }
    public function getPetsLost() {
        $parameters = array(
            'status' => 'lost',
            'userid' => FALSE
        );
        $reports = Report::getPublicReports($parameters, TRUE, 10, 'mascotas/perdidos');
        $departments = Ubigeo::getDataDepartments();
        $cities = Ubigeo::getDataCities(null);
        $districts = Ubigeo::getDataDistricts(null);
        return view('pets.page-pets-lost', [
            'reports' => $reports,
            'departments'=>$departments,
            'cities'=>$cities,
            'districts'=>$districts,
            'user' => Auth::check() ? Auth::user() : null
            ]   
        );
    }

    public function getPetsFound(Request $request) {
        $parameters = array(
            'status' => 'found',
            'userid' => FALSE
        );
        $departments = Ubigeo::getDataDepartments();
        $cities = Ubigeo::getDataCities(null);
        $districts = Ubigeo::getDataDistricts(null);
        $reports = Report::getPublicReports($parameters, TRUE, 10, 'mascotas/perdidos');
        return view('pets.page-pets-lost', [
            'reports' => $reports,
            'departments'=>$departments,
            'cities'=>$cities,
            'districts'=>$districts,
                'user' => Auth::check() ? Auth::user() : null
                ]   
        );
    }

    public function getPetsDetail(Request $request) {
        $id = $request->get('report_id');
        $status = $request->get('status');
        $pet = Pet::getDataPet($id, $status);  
        return response()->json([
                    'result' => TRUE,
                    'pet' => $pet
        ]);
    }

    public function postPetsLost(Request $request) {
        $parameters = array(
            'status' => 'lost',
            'userid' => FALSE,
            'department' => $request->get('department', null),
            'province' => $request->get('province', null),
            'district' => $request->get('district', null)
        );

        return response()->json([
                    'status' => TRUE,
                    'reports' => Report::getDataReports($parameters, TRUE, 10, 'mascotas/perdidos')
        ]);
    }
    
    
    public function getPetInfo($id){
        $pet= Pet::where('id',$id)->first();
        $report= Report::where('pet_id',$pet->id)->first();
        $location= Location::where('id',$report->last_location_id)->first();
        $user= User::where('id',$pet->owner_id)->first();
        $data=[];
        if($pet->count() > 0) {
            $data['pet']=['id'=>$pet->id,'name'=>$pet->name,'race'=>$pet->race,'gender'=>$pet->gender,'description'=>$pet->description];
            $data['report']=['id'=>$report->id,'date'=>$report->date,'description'=>$report->description,'reward'=>$report->reward];
            $data['location']=['latitude'=>$location->latitude,'longitude'=>$location->longitude,'address'=>$location->address];
            $data['user']=['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'phone'=>$user->phone];
            return response()->json($data);
        }else{
            return response()->json('false');
        }
    }
    public function foundPet($id){
        $pet= Pet::where('id',$id)->first();
        $report= Report::where('pet_id',$pet->id)->first();
        $location= Location::where('id',$report->last_location_id)->first();
        $user= User::where('id',$pet->owner_id)->first();
        $data=[];
        if($pet->count() > 0) {
            $data['pet']=['id'=>$pet->id,'name'=>$pet->name,'race'=>$pet->race,'gender'=>$pet->gender,'description'=>$pet->description];
            $data['report']=['id'=>$report->id,'date'=>$report->date,'description'=>$report->description,'reward'=>$report->reward];
            $data['location']=['latitude'=>$location->latitude,'longitude'=>$location->longitude,'address'=>$location->address];
            $data['user']=['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'phone'=>$user->phone];
            return response()->json($data);
        }else{
            return response()->json('false');
        }
    }    
    public function getFoundPets($lat,$lon){
        $data=[];
        $locations= Location::where('latitude','like',"%".$lat."%")->where('longitude','like',"%".$lon."%")->get();
        foreach($locations as $location)
        {
            $reports= Report::where('last_location_id',$location->id)->where('status','found')->get();
            foreach($reports as $report)
            {
                $pet= Pet::where('id',$report->pet_id)->first();
                $user= User::where('id',$pet->owner_id)->first();
                $data['pet']=['id'=>$pet->id,'name'=>$pet->name,'race'=>$pet->race,'gender'=>$pet->gender,'description'=>$pet->description];
                $data['report']=['id'=>$report->id,'date'=>$report->date,'description'=>$report->description,'reward'=>$report->reward];
                $data['location']=['latitude'=>$location->latitude,'longitude'=>$location->longitude,'address'=>$location->address];
                $data['user']=['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'phone'=>$user->phone];
            }
        }
        return response()->json($data);
    }
    public function getLostPets($lat,$lon){
        $data=[];
        $locations= Location::where('latitude','like',"%".$lat."%")->where('longitude','like',"%".$lon."%")->get();
        foreach($locations as $location)
        {
            $reports= Report::where('last_location_id',$location->id)->where('status','lost')->get();
            foreach($reports as $report)
            {
                $pet= Pet::where('id',$report->pet_id)->first();
                $user= User::where('id',$pet->owner_id)->first();
                $data['pet']=['id'=>$pet->id,'name'=>$pet->name,'race'=>$pet->race,'gender'=>$pet->gender,'description'=>$pet->description];
                $data['report']=['id'=>$report->id,'date'=>$report->date,'description'=>$report->description,'reward'=>$report->reward];
                $data['location']=['latitude'=>$location->latitude,'longitude'=>$location->longitude,'address'=>$location->address];
                $data['user']=['id'=>$user->id,'name'=>$user->name,'email'=>$user->email,'phone'=>$user->phone];
            }
        }
        return response()->json($data);
    }
}