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
        $limitado = false;
        if ($request->get('limitado') != null) {
            $limitado = $request->get('limitado');
        }
        
        if($department && $department != "Todos") $ubigeo=\App\Ubigeo::where('department',$department)->pluck('id')->toArray();
        if($city  && $city != "Todos") $ubigeo=\App\Ubigeo::where('city',$city)->pluck('id')->toArray();
        if($district && $district != "Todos") $ubigeo= \App\Ubigeo::where('district',$district)->pluck('id')->toArray();
        if (($department && $department != "Todos") || $district)
            $locations= \App\Location::whereIn('ubigeo_id', $ubigeo)->get(); 
        else
            $locations= \App\Location::get();


        foreach ($locations as $location){ 
            if (! $limitado) {
                $reports=Report::where('last_location_id', $location->id)->where('found', 0)->get();
            } else {
                $reports=Report::where('last_location_id', $location->id)->where('found', 0)->limit($limitado)->get();
            }
            
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
