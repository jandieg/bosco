<?php

namespace App\Http\Controllers;

use App\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller {

    public function index() {
        $reports['lost'] = Report::getDataReports(['status' => 'lost', 'userid' => Auth::id()], FALSE);
        $reports['found'] = Report::getDataReports(['status' => 'found', 'userid' => Auth::id()], FALSE);
        return view('reports.page-reports-index', [
            'reports' => $reports,
            'user' => Auth::user()
                ]
        );
    }
    public function delete_report(Request $request)
    {
        $report_id = $request->get('report_id');
        $report = DB::table('reports')->where('id', $report_id)->delete();
        if($report) 
            return response()->json(TRUE);
        else
            return response()->json(FALSE);
    }

    public function getReportsDetailLost(Request $request) {
        if ($request->isMethod('get')) {
            $id = $request->get('reportid');
            $report = Report::getDataReport($id, 'lost');
            return response()->json([
                        'result' => TRUE,
                        'path' => url(''),
                        'report' => $report
            ]);
        }
    }

    public function getReportsDetailFound(Request $request) {
        if ($request->isMethod('get')) {
            $id = $request->get('reportid');
            $report = Report::getDataReport($id, 'found');
            return response()->json([
                        'result' => TRUE,
                        'path' => url(''),
                        'pet' => $report
            ]);
        }
    }

    public function sendReport(Request $request) {        
        $report_id= $request->get('report_id');
        $status = $request->get('pet_status');
        $name = $request->get('lost_pet_name');
        $race = $request->get('lost_pet_race');
        $gender = $request->get('lost_pet_gender');
        $description = $request->get('lost_pet_description');
        $report_description = $request->get('lost_pet_report_description');
        $last_seen = $request->get('lost_pet_last_seen');
        $department = $request->get('lost_pet_department');
        $city = $request->get('lost_pet_city');
        $district = $request->get('lost_pet_district');
        $latitude = $request->get('lost_pet_latitude');
        $longitude = $request->get('lost_pet_longitude');
        $postal_code= $request->get('lost_pet_postal_code');
        $reward = $request->get('lost_pet_reward');
        $contact_name = $request->get('lost_pet_contact_name');
        $contact_email = $request->get('lost_pet_contact_email');
        $date = $request->get('lost_pet_date');
        $time = $request->get('lost_pet_time');
        $url = $request->get('filename');
        $img = $request->get('pngimageData');
        $user_id = Auth::user()->id;
        if(!$report_id)
        {
            $pet_data = [
                'owner_id' => $user_id,
                'name' => $name,
                'race' => $race,
                'gender' => $gender,
                'description' => $description,
                'created_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Pet::insert($pet_data);
            $file_name= basename($url);
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            file_put_contents("images/pets/".$file_name, $data);
            $pet_id=DB::table('pets')->max('id');
            $photo_data = [
                'pet_id' => $pet_id,
                'url' => $file_name,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Photo::insert($photo_data);
            $ubigeos = \App\Ubigeo::where('department',$department)->where('city',$city)->where('district',$district)->get()->count();
            if(!$ubigeos)
            {
                $ubigeo_data = [
                    'department' =>$department,
                    'city' => $city,
                    'district' => $district,
                    'ubigeo_code' => $postal_code,
                    'created_at' =>Date('Y-m-d H:i:s'),
                    'updated_at' =>Date('Y-m-d H:i:s')
                ];        
                $result = \App\Ubigeo::insert($ubigeo_data);
            }
            $ubigeo_id=DB::table('ubigeos')->max('id');
            $location_data = [
                'address' =>$last_seen,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'ubigeo_id' => $ubigeo_id,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' =>Date('Y-m-d H:i:s')
            ];        
            $result = \App\Location::insert($location_data);
            $location_id=DB::table('locations')->max('id');
            $report_data = [
                'pet_id' => $pet_id,
                'date' =>$date." ".$time,
                'last_location_id' => $location_id,
                'reward' => $reward,
                'description' => $report_description,
                'status' => $status,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Report::insert($report_data);
        }
        else
        {        
            $report = \App\Report::where('id',$report_id)->first();
            $pet_data = [
                'name' => $name,
                'race' => $race,
                'gender' => $gender,
                'description' => $description,
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Pet::where('id',$report->pet_id)->update($pet_data);
            if($img)
            {
                $file_name= basename($url);
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                file_put_contents("images/pets/".$file_name, $data);
                $photo_data = [
                    'url' => $file_name,
                    'updated_at' =>Date('Y-m-d H:i:s')
                ];
                $result = \App\Photo::where('pet_id',$report->pet_id)->update($photo_data);
            }
            $ubigeos = \App\Ubigeo::where('department',$department)->where('city',$city)->where('district',$district)->get()->count();
            if(!$ubigeos)
            {
                $ubigeo_data = [
                    'department' =>$department,
                    'city' => $city,
                    'district' => $district,
                    'ubigeo_code' => $postal_code,
                    'created_at' =>Date('Y-m-d H:i:s'),
                    'updated_at' =>Date('Y-m-d H:i:s')
                ];        
                $result = \App\Ubigeo::insert($ubigeo_data);
            }
            $ubigeo_id=DB::table('ubigeos')->max('id');    
            $location_data = [
                'address' =>$last_seen,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'ubigeo_id' => $ubigeo_id,
                'updated_at' =>Date('Y-m-d H:i:s')
            ];        
            $result = \App\Location::where('id',$report->last_location_id)->update($location_data);
            $report_data = [
                'date' =>$date." ".$time,
//                'last_location_id' => $location_id,
                'reward' => $reward,
                'description' => $report_description,
                'status' => $status,
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Report::where('id',$report_id)->update($report_data);
        }
        //$response=['result'=>true];
        return json_encode(true);
    }

    public function getDownloadReport($status, Request $request) {
        if ($status == 'perdido') {
            $statusQ = 'lost';
        }
        if ($status == 'encontrado') {
            $statusQ = 'found';
        }
        $id = $request->get('reportid');
        $report = Report::getDataReport($id, $statusQ);

        $pdf = PDF::loadView('pdf/download-report-' . $statusQ, ['report' => $report]);
        return $pdf->download($status . '.pdf');
    }

}
