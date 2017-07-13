<?php

namespace App\Http\Controllers;

//use App;
use App\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Imagick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller {
    public function search(Request $request) {       
        $data=[];
        $department= $request->get('department');
        $city = $request->get('city');
        $district = $request->get('district');
        
        if($department && $department != "Todos") $ubigeo=\App\Ubigeo::where('department',$department)->first();
        if($city  && $city != "Todos") $ubigeo=\App\Ubigeo::where('city',$city)->first();
        if($district && $district != "Todos") $ubigeo= \App\Ubigeo::where('district',$district)->first();
        if (($department && $department != "Todos") || $district)
            $locations= \App\Location::where('ubigeo_id', $ubigeo->id)->get(); 
        else
            $locations= \App\Location::get();


        foreach ($locations as $location){ 
            $reports=Report::where('last_location_id', $location->id)->get();
            foreach ($reports as $report){
                $pet=\App\Pet::where('id', $report->pet_id)->first();
                $photos= \App\Photo::where('pet_id', $report->pet_id)->get();
                $data[] = [
                    'id' => $report->id,
                    'status' => $report->status,
                    'pet_id'=>$pet->id,
                    'name' => $pet->name, 
                    'race' => $pet->race, 
                    'gender' => $pet->gender, 
                    'description' => $pet->description, 
                    'date' => $report->date,
                    'address' => $location->address, 
                    'image' => $photos[0]->url
                ];
            }
        }
        return response()->json(['data'=>$data]);
    }
}
