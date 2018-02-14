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
                    'date' => date_format(date_create($report->date), 'd M Y'),
                    'address' => $location->address,
                    'image' => $photos[0]->url
                ];
            }
        }
        return response()->json(['data'=>$data]);
    }

    public function searchFoundByLocation(Request $request) {
        $data=[];

        $limitado = false;
        if ($request->get('limitado') != null) {
            $limitado = $request->get('limitado');
        }

        $start = array($request->get('lat'),$request->get('lng'));

        $locations = \App\Location::all();

        if ($start[0] != 0 and $start[1] != 0) {
            $dist = $request->get('dist');

            $latNorth = $this->geoDestination( $start, $dist,0 )[0];
            $latSouth = $this->geoDestination( $start, $dist,180 )[0];
            $lonWest = $this->geoDestination( $start, $dist,270 )[1];
            $lonEast = $this->geoDestination( $start, $dist,90 )[1];

            $locations = $locations->filter (function($location) use($latNorth, $latSouth,$lonWest,$lonEast) {
                $lat=$location->latitude;
                $lng=$location->longitude;
                return $lat < $latNorth AND $lat > $latSouth AND $lng > $lonWest AND $lng < $lonEast;
            });
        }

        foreach ($locations as $location) {
            if (! $limitado) {
                $reports=Report::where('last_location_id', $location->id)->where('found', 0)->where('status', 'found')->get();
            } else {
                $reports=Report::where('last_location_id', $location->id)->where('found', 0)->where('status', 'found')->limit($limitado)->get();
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
                    'date' => date_format(date_create($report->date), 'd M Y'),
                    'address' => $location->address,
                    'image' => $photos[0]->url
                ];
            }
        }
        return response()->json(['data'=>$data]);
    }

    public function searchByLocation(Request $request) {
        $data=[];

        $limitado = false;
        if ($request->get('limitado') != null) {
            $limitado = $request->get('limitado');
        }

        $start = array($request->get('lat'),$request->get('lng'));

        $locations = \App\Location::all();

        if ($start[0] != 0 and $start[1] != 0) {
            $dist = $request->get('dist');

            $latNorth = $this->geoDestination( $start, $dist,0 )[0];
            $latSouth = $this->geoDestination( $start, $dist,180 )[0];
            $lonWest = $this->geoDestination( $start, $dist,270 )[1];
            $lonEast = $this->geoDestination( $start, $dist,90 )[1];

            $locations = $locations->filter (function($location) use($latNorth, $latSouth,$lonWest,$lonEast) {
                $lat=$location->latitude;
                $lng=$location->longitude;
                return $lat < $latNorth AND $lat > $latSouth AND $lng > $lonWest AND $lng < $lonEast;
            });
        }

        foreach ($locations as $location) {
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
                    'date' => date_format(date_create($report->date), 'd M Y'),
                    'address' => $location->address,
                    'image' => $photos[0]->url
                ];
            }
        }
        return response()->json(['data'=>$data]);
    }

    private function geoDestination($start, $dist, $brng) {
        $lat1 = $this->toRad($start[0]);
        $lon1 = $this->toRad($start[1]);
        $dist = ($dist/1000) / 6371.01; //Earth's radius in km
        $brng = $this->toRad($brng);

        $lat2 = asin(sin($lat1) * cos($dist) +
                      cos($lat1) * sin($dist) * cos($brng));
        $lon2 = $lon1 + atan2(sin($brng) * sin($dist) * cos($lat1),
                              cos($dist) - sin($lat1) * sin($lat2));
        $lon2 = fmod(($lon2 + 3 * pi()), (2 * pi())) - pi();

        return array($this->toDeg($lat2), $this->toDeg($lon2));
    }

    private function toRad($deg) {
        return $deg * pi() / 180;
    }

    private function toDeg($rad) {
        return $rad * 180 / pi();
    }
}
