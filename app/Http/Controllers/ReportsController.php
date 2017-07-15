<?php

namespace App\Http\Controllers;

//use App;
use App\Report;
use App\Ubigeo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Imagick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use facebook\graph_sdk;

class ReportsController extends Controller {

    public function index() {
        $reports['lost'] = Report::getDataReports(['status' => 'lost', 'userid' => Auth::id()], FALSE);
        $reports['found'] = Report::getDataReports(['status' => 'found', 'userid' => Auth::id()], FALSE);
        $departments = Ubigeo::getDataDepartments();
        return view('reports.page-reports-index', [
            'reports' => $reports,
            'departments' => $departments,
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
        $street = $request->get('street');
        $department = $request->get('department');
        $city = $request->get('city');
        $district = $request->get('district');
        $address = $department + " " + $city + " " + $district + " " + $street;
        $latitude = $request->get('lost_pet_latitude');
        $longitude = $request->get('lost_pet_longitude');
        $postal_code= $request->get('lost_pet_postal_code');
        $reward = $request->get('lost_pet_reward');
        $contact_name = $request->get('lost_pet_contact_name');
        $contact_email = $request->get('lost_pet_contact_email');
        $date = $request->get('lost_pet_date');
        $date=date("Y-m-d", strtotime($date));
        $time = $request->get('lost_pet_time');
//        $url = $request->get('filename');
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
            $pet_id=DB::table('pets')->max('id');
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            file_put_contents("images/pets/".$pet_id.".jpg", $data);
            $photo_data = [
                'pet_id' => $pet_id,
                'url' => $pet_id.".jpg",
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
                    'street' => $street,
                    'ubigeo_code' => $postal_code,
                    'created_at' =>Date('Y-m-d H:i:s'),
                    'updated_at' =>Date('Y-m-d H:i:s')
                ];        
                $result = \App\Ubigeo::insert($ubigeo_data);
            }
            $ubigeo_id=DB::table('ubigeos')->max('id');
            $location_data = [
                'address' =>$address,
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
                //$file_name= basename($url);
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                file_put_contents("images/pets/".$report->pet_id.".png", $data);
                $photo_data = [
                    'url' => $report->pet_id.".png",
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
                'address' =>$address,
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
        return json_encode(true);
    }

    public function getDownloadReport($status, Request $request) {
        $id = $request->get('reportid');
        $report = Report::getDataReport($id);
        $view = \Illuminate\Support\Facades\View::make('pdf/download-report-lost', ['report' => $report]);
        $contents = $view->render();
        $html_file = storage_path() . '/report.html';
        file_put_contents($html_file, $contents);
        $pdf_file = storage_path() . '/report.pdf';
	//PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Segoe UI Black']);
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
        $pdf = PDF::loadView('pdf/download-report-lost', ['report' => $report])->setPaper('a4', 'portrait')->save($pdf_file);
        if($status=='pdf') 
            return response()->download($pdf_file);
        elseif($status=='jpg') 
        {
            $font_file= storage_path() . '/fonts/3b9f85024beb281bbf09edb78103a64d.ttf';
            $imagick = new Imagick();
            //$imagick ->setresolution(150, 150);
            $imagick->readImage($pdf_file);
            $imagick->setImageFormat('jpg');
            $imagick ->setImageCompressionQuality(100);
            $jpg_file = public_path() . '/report.jpg';
            if(file_exists($jpg_file)) unlink($jpg_file);
            $jpg_url = url('report.jpg');
            $imagick->writeImages($jpg_file, false); 
            return response()->download($jpg_file);
        }
    }
    public function postFacebook(Request $request) {
        $id = $request->get('report_id');
        $user_id = $request->get('user_id');
        $access_token = $request->get('access_token ');
        $report = Report::getDataReport($id);
        $view = \Illuminate\Support\Facades\View::make('pdf/download-report-lost', ['report' => $report]);
        $contents = $view->render();
        $html_file = storage_path() . '/report.html';
        file_put_contents($html_file, $contents);
        $pdf_file = storage_path() . '/report.pdf';
	PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Segoe UI Black']);
        $pdf = PDF::loadView('pdf/download-report-lost', ['report' => $report])->setPaper('a4', 'portrait')->save($pdf_file);
        $font_file= storage_path() . '/fonts/3b9f85024beb281bbf09edb78103a64d.ttf';
        $imagick = new Imagick();
        $imagick->readImage($pdf_file);
        $imagick->setImageFormat('jpg');
	$imagick ->setImageCompressionQuality(100);
        $jpg_file = public_path() . '/report.jpg';
        if(file_exists($jpg_file)) unlink($jpg_file);
        $jpg_url = url('report.jpg');
        $imagick->writeImages($jpg_file, false); 
    	/*$fb = new \Facebook\Facebook([
	  'app_id' => env('FACEBOOK_APP_ID'),
	  'app_secret' => env('FACEBOOK_APP_SECRET'),
	  'default_graph_version' => 'v2.9'
	]);
	try {
	  $fb_response = $fb->post('/'.$user_id.'/feed',
	        array(
	            "message" => "I lost a pet",
	            "link" => "http://bosco.pe/",
	            "picture" => $jpg_url,
	            "name" => "Oh my!",
	            "caption" => "www.example.com",
	            "description" => "Description example"
	        ),$access_token);
	} catch(\Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(\Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}*/
        return response()->json(true);
    }
    public function saveReport($received_data, $base64photo) {
        $status = $received_data['pet_status'];
        $name = $received_data['lost_pet_name'];
        $race = $received_data['lost_pet_race'];
        $gender = $received_data['lost_pet_gender'];
        $description = $received_data['lost_pet_description'];
        $report_description = $received_data['lost_pet_report_description'];
        $address = $received_data['address'];
        $department = $received_data['lost_pet_department'];
        $city = $received_data['lost_pet_city'];
        $district = $received_data['lost_pet_district'];
        $latitude = $received_data['lost_pet_latitude'];
        $longitude = $received_data['lost_pet_longitude'];
        $postal_code= $received_data['lost_pet_postal_code'];
        $reward = $received_data['lost_pet_reward'];
        $contact_name = $received_data['lost_pet_contact_name'];
        $contact_email = $received_data['lost_pet_contact_email'];
        $date = $received_data['lost_pet_date'];
        $time = $received_data['lost_pet_time'];
        $img = $base64photo;
        $user_id = Auth::user()->id;
        $pet_data = [
            'owner_id' => $user_id,
            'name' => $name,
            'race' => $race,
            'gender' => $gender,
            'description' => $description,
            'created_at' =>Date('Y-m-d H:i:s')
        ];
        $result = \App\Pet::insert($pet_data);
        $pet_id=DB::table('pets')->max('id');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents("images/pets/".$pet_id.".jpg", $data);
        $photo_data = [
            'pet_id' => $pet_id,
            'url' => $pet_id.".jpg",
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
            'address' =>$address,
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
        return true;
    }
}
