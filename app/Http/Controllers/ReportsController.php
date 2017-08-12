<?php

namespace App\Http\Controllers;

//use App;
use App\Report;
use App\Ubigeo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use Imagick;
use ImagickPixel;
use ImagickDraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use facebook\graph_sdk;

class ReportsController extends Controller {

    public function index() {
        $reports['lost'] = Report::getDataReports(['status' => 'lost', 'found' => '0', 'userid' => Auth::id()], FALSE);
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

    public function postEncontrado(Request $request) {
        $report_id = $request->get('id');
        $img = $request->get('pngimageData');
        $report = \App\Report::where('id',$report_id)->first();
        $report_data = [
            'found' => '1',
            'updated_at' =>Date('Y-m-d H:i:s')
        ];
        $result = \App\Report::where('id',$report_id)->update($report_data);
        /*if ($img) {
            //$file_name= basename($url);
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            file_put_contents("images/pets/".$report->pet_id.".jpg", $data);
            $photo_data = [
                'url' => $report->pet_id.".jpg",
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Photo::where('pet_id',$report->pet_id)->update($photo_data);
        }*/
        return json_encode(true);
    }
    

    public function sendReport(Request $request) {        
        $report_id= $request->get('report_id');
        $status = $request->get('pet_status');
        $name = $request->get('lost_pet_name');
        if (strlen($name) == 0) {
            $name = '';
        }
        $race = $request->get('lost_pet_race');
        if (strlen($race) == 0) {
            $race = '';
        }
        $gender = $request->get('lost_pet_gender');
        
        $description = $request->get('lost_pet_description');
        $report_description = $request->get('lost_pet_report_description');
        if (strlen($report_description) == 0) {
            $report_description = '';
        }
        $street = $request->get('pet-lost-calle');
        $department = $request->get('department');
        $city = $request->get('city');
        $district = $request->get('district');
        $address = $district . " " . $street;
        $latitude = $request->get('pet-lost-lat');
        $longitude = $request->get('pet-lost-lng');
        $postal_code= "15001";//$request->get('lost_pet_postal_code');
        $reward = $request->get('lost_pet_reward');
        $contact_phone = $request->get('lost_pet_contact_name');
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
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            file_put_contents("images/pets/".$pet_id.".jpg", $data);

            //logica del lienzo del flyer
            $im = new Imagick("images/pets/".$pet_id.".jpg");
            $lienzo = new Imagick();
            $lienzo->newImage(800, 1136, "none");
            $headerLienzo = new Imagick();
            $headerLienzo->newImage(800, 168, new ImagickPixel('red'));
            $headerLienzo->setImageFormat("jpg");
            $textoPerdido = new \ImagickDraw();
            $textoPerdido->setFontSize(84);
            $textoPerdido->setStrokeWidth(3);
            $textoPerdido->setFillColor(new ImagickPixel('white'));
            $textoPerdido->annotation(200, 90, 'PERDIDO');
            $headerLienzo->drawImage($textoPerdido);
            $textoNombre = new \ImagickDraw();
            $textoNombre->setFontSize(22);
            $textoNombre->setStrokeWidth(2);
            $textoNombre->setFillColor(new ImagickPixel('white'));
            $textoNombre->annotation(15, 155, 'Nombre:');                                                                   
            $headerLienzo->drawImage($textoNombre);
            $valorNombre = new \ImagickDraw();
            $valorNombre->setFontSize(24);
            $valorNombre->setStrokeWidth(2);
            $valorNombre->setFillColor(new ImagickPixel('white'));
            $valorNombre->annotation(98, 155, ucfirst($name));                                                                   
            $headerLienzo->drawImage($valorNombre);  
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(363, 135, 363, 155);
            $headerLienzo->drawImage($draw);
            $textoRaza = new \ImagickDraw();
            $textoRaza->setFontSize(22);
            $textoRaza->setStrokeWidth(2);
            $textoRaza->setFillColor(new ImagickPixel('white'));
            $textoRaza->annotation(365, 155, 'Raza:');  
            $headerLienzo->drawImage($textoRaza);    
            $valorRaza = new \ImagickDraw();
            $valorRaza->setFontSize(24);
            $valorRaza->setStrokeWidth(2);
            $valorRaza->setFillColor(new ImagickPixel('white'));
            $valorRaza->annotation(423, 155, ucfirst($race));  
            $headerLienzo->drawImage($valorRaza);    
            $textoGenero = new \ImagickDraw();
            $textoGenero->setFontSize(22);
            $textoGenero->setStrokeWidth(2);
            $textoGenero->setFillColor(new ImagickPixel('white'));
            $textoGenero->annotation(693, 155, 'Género:');                                                                               
            $headerLienzo->drawImage($textoGenero);  
            $valorGenero = new \ImagickDraw();
            $valorGenero->setFontSize(24);
            $valorGenero->setStrokeWidth(2);
            $valorGenero->setFillColor(new ImagickPixel('white'));
            if (strlen($gender) == 5) {
                $valorGenero->annotation(773, 155, "M");                                                                               
            } else {
                $valorGenero->annotation(773, 155, "F");                                                                               
            }            
            $headerLienzo->drawImage($valorGenero);      
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(690, 135, 690, 155);
            $headerLienzo->drawImage($draw);            
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(30, 125, 770, 125);
            $headerLienzo->drawImage($draw);
            $footerLienzo = new Imagick();
            $footerLienzo->newImage(800, 168, new ImagickPixel('white'));
            $calendarImg = new Imagick("img/calendar.png");
            $footerLienzo->compositeimage($calendarImg->getimage(), Imagick::COMPOSITE_DEFAULT, 80, 30);
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
            $dia = date("d", strtotime($date));        
            $anho = date("Y", strtotime($date));        
            $mesnum = date("m", strtotime($date));        
            $mes = $meses[$mesnum];

            $valorFecha = new \ImagickDraw();
            $valorFecha->setFontSize(24);
            $valorFecha->setFillColor(new ImagickPixel('gray'));
            $valorFecha->annotation(90, 45, ucfirst($dia . ' ' . $mes . ' ' . $anho));  
            $footerLienzo->drawImage($valorFecha);
            $locationImg = new Imagick("img/location.png");
            $footerLienzo->compositeimage($locationImg->getimage(), Imagick::COMPOSITE_DEFAULT, 400, 30);
            $valorDireccion = new \ImagickDraw();
            $valorDireccion->setFontSize(24);
            $valorDireccion->setFillColor(new ImagickPixel('gray'));
            $valorDireccion->annotation(435, 45, ucfirst($address));  
            $footerLienzo->drawImage($valorDireccion);
            $logoImg = new Imagick("img/logo_2.png");            
            $footerLienzo->compositeimage($logoImg->getimage(), Imagick::COMPOSITE_DEFAULT, 680, 108);
            $reportaTexto = new \ImagickDraw();
            $reportaTexto->setFontSize(20);
            $reportaTexto->setFillColor(new ImagickPixel('gray'));
            $reportaTexto->annotation(15, 130, "Reporta mascotas perdidas o encontradas entrando a www.bosco.pe.");  
            $footerLienzo->drawImage($reportaTexto);
            $draw2 = new \ImagickDraw();
            $draw2->setStrokeColor(new ImagickPixel('gray'));
            $draw2->setFillColor(new ImagickPixel('gray'));
            $draw2->setStrokeWidth(2);
            $draw2->setFontSize(72);
            $draw2->line(30, 100, 770, 100);
            $footerLienzo->drawImage($draw2);
            /*$rewardLienzo = new Imagick("recompensa_capa.png");
            $rewardLienzo->newImage(300, 50, new ImagickPixel('white'));*/
            $rewardLienzo = new ImagickDraw();
            $rewardLienzo->setFillColor("rgb(0,0,0)");
            $rewardLienzo->setFillOpacity(0.7);
            $rewardLienzo->rectangle(500, 0, 800, 50);

            $phoneLienzo = new ImagickDraw();
            $phoneLienzo->setFillColor("rgb(0,0,0)");
            $phoneLienzo->setFillOpacity(0.8);
            $phoneLienzo->rectangle(0,700,800,800);

            /*$rewardLienzo2 = new Imagick();
            $rewardLienzo2->newImage(300,50, 'red');
            $rewardLienzo2->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE); // make sure it has an alpha channel
            $box=$rewardLienzo2->getImageRegion(0,0,300,50);
            $box->setImageAlphaChannel(Imagick::ALPHACHANNEL_TRANSPARENT);
            $rewardLienzo2->compositeImage($box,Imagick::COMPOSITE_REPLACE,300,50);*/
            $im->drawImage($rewardLienzo);
            $im->drawImage($phoneLienzo);
            $phoneImg = new Imagick("img/phone.png");            
            $im->compositeimage($phoneImg->getimage(), Imagick::COMPOSITE_DEFAULT, 180, 735);
            $phoneTexto = new \ImagickDraw();
            $phoneTexto->setFontSize(38);
            $phoneTexto->setFillColor(new ImagickPixel('white'));
            $phoneTexto->annotation(300, 760, $contact_phone);  
            $im->drawImage($phoneTexto);    
            $im->setImageFormat("png");
            $rewardTexto = new \ImagickDraw();
            $rewardTexto->setFontSize(24);
            $rewardTexto->setFillColor(new ImagickPixel('white'));
            $rewardTexto->annotation(535, 35, "Recompensa: S/. ");  
            $im->drawImage($rewardTexto);    
            $rewardTextoValor = new \ImagickDraw();
            $rewardTextoValor->setFontSize(28);
            $rewardTextoValor->setFillColor(new ImagickPixel('white'));
            $rewardTextoValor->annotation(720, 35, $reward);  
            $im->drawImage($rewardTextoValor);    
            $lienzo->compositeimage($headerLienzo->getimage(), Imagick::COMPOSITE_COPY, 0, 0);
            $lienzo->compositeimage($im->getimage(), Imagick::COMPOSITE_COPY, 0, 168);
            $lienzo->compositeimage($footerLienzo->getimage(), Imagick::COMPOSITE_COPY, 0, 968);
            $lienzo->writeimage("images/pets/report_".$pet_id.".png");
            $lienzo->destroy();

            //fin logica del lienzo


            $photo_data = [
                'pet_id' => $pet_id,
                'url' => $pet_id.".jpg",
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' =>Date('Y-m-d H:i:s')
            ];
            $result = \App\Photo::insert($photo_data);
            $ubigeo = \App\Ubigeo::where('department',$department)->where('city',$city)->where('district',$district)->first();
            /*if(!$ubigeos)
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
            }*/
            if (! is_object($ubigeo)) {
                $ubigeo_id=DB::table('ubigeos')->max('id');
            } else {
                $ubigeo_id=$ubigeo->id;
            }
            
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
                'date' =>date_format(\DateTime::createFromFormat("Y-m-d H:i a", $date." ".$time), "Y-m-d H:i"),
                'last_location_id' => $location_id,
                'reward' => $reward,
                'description' => $report_description,
                'status' => $status,
                'created_at' =>Date('Y-m-d H:i:s'),
                'updated_at' =>Date('Y-m-d H:i:s'),
                'phone' => $contact_phone
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
                $img = str_replace('data:image/jpeg;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                file_put_contents("images/pets/".$report->pet_id.".jpg", $data);
                $photo_data = [
                    'url' => $report->pet_id.".jpg",
                    'updated_at' =>Date('Y-m-d H:i:s')
                ];
                $result = \App\Photo::where('pet_id',$report->pet_id)->update($photo_data);
            }

            //logica del lienzo del flyer
            $im = new Imagick("images/pets/".$report->pet_id.".jpg");
            $lienzo = new Imagick();
            $lienzo->newImage(800, 1136, "none");
            $headerLienzo = new Imagick();
            $headerLienzo->newImage(800, 168, new ImagickPixel('red'));
            $headerLienzo->setImageFormat("jpg");
            $textoPerdido = new \ImagickDraw();
            $textoPerdido->setFontSize(84);
            $textoPerdido->setStrokeWidth(3);
            $textoPerdido->setFillColor(new ImagickPixel('white'));
            $textoPerdido->annotation(200, 90, 'PERDIDO');
            $headerLienzo->drawImage($textoPerdido);
            $textoNombre = new \ImagickDraw();
            $textoNombre->setFontSize(22);
            $textoNombre->setStrokeWidth(2);
            $textoNombre->setFillColor(new ImagickPixel('white'));
            $textoNombre->annotation(15, 155, 'Nombre:');                                                                   
            $headerLienzo->drawImage($textoNombre);
            $valorNombre = new \ImagickDraw();
            $valorNombre->setFontSize(24);
            $valorNombre->setStrokeWidth(2);
            $valorNombre->setFillColor(new ImagickPixel('white'));
            $valorNombre->annotation(98, 155, ucfirst($name));                                                                   
            $headerLienzo->drawImage($valorNombre);  
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(363, 135, 363, 155);
            $headerLienzo->drawImage($draw);
            $textoRaza = new \ImagickDraw();
            $textoRaza->setFontSize(22);
            $textoRaza->setStrokeWidth(2);
            $textoRaza->setFillColor(new ImagickPixel('white'));
            $textoRaza->annotation(365, 155, 'Raza:');  
            $headerLienzo->drawImage($textoRaza);    
            $valorRaza = new \ImagickDraw();
            $valorRaza->setFontSize(24);
            $valorRaza->setStrokeWidth(2);
            $valorRaza->setFillColor(new ImagickPixel('white'));
            $valorRaza->annotation(423, 155, ucfirst($race));  
            $headerLienzo->drawImage($valorRaza);    
            $textoGenero = new \ImagickDraw();
            $textoGenero->setFontSize(22);
            $textoGenero->setStrokeWidth(2);
            $textoGenero->setFillColor(new ImagickPixel('white'));
            $textoGenero->annotation(693, 155, 'Género:');                                                                               
            $headerLienzo->drawImage($textoGenero);  
            $valorGenero = new \ImagickDraw();
            $valorGenero->setFontSize(24);
            $valorGenero->setStrokeWidth(2);
            $valorGenero->setFillColor(new ImagickPixel('white'));
            if (strlen($gender) == 5) {
                $valorGenero->annotation(773, 155, "M");                                                                               
            } else {
                $valorGenero->annotation(773, 155, "F");                                                                               
            }            
            $headerLienzo->drawImage($valorGenero);      
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(690, 135, 690, 155);
            $headerLienzo->drawImage($draw);            
            $draw = new \ImagickDraw();
            $draw->setStrokeColor(new ImagickPixel('white'));
            $draw->setFillColor(new ImagickPixel('white'));
            $draw->setStrokeWidth(2);
            $draw->setFontSize(72);
            $draw->line(30, 125, 770, 125);
            $headerLienzo->drawImage($draw);
            $footerLienzo = new Imagick();
            $footerLienzo->newImage(800, 168, new ImagickPixel('white'));
            $calendarImg = new Imagick("img/calendar.png");
            $footerLienzo->compositeimage($calendarImg->getimage(), Imagick::COMPOSITE_DEFAULT, 80, 30);
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
            $dia = date("d", strtotime($date));        
            $anho = date("Y", strtotime($date));        
            $mesnum = date("m", strtotime($date));        
            $mes = $meses[$mesnum];

            $valorFecha = new \ImagickDraw();
            $valorFecha->setFontSize(24);
            $valorFecha->setFillColor(new ImagickPixel('gray'));
            $valorFecha->annotation(90, 45, ucfirst($dia . ' ' . $mes . ' ' . $anho));  
            $footerLienzo->drawImage($valorFecha);
            $locationImg = new Imagick("img/location.png");
            $footerLienzo->compositeimage($locationImg->getimage(), Imagick::COMPOSITE_DEFAULT, 400, 30);
            $valorDireccion = new \ImagickDraw();
            $valorDireccion->setFontSize(24);
            $valorDireccion->setFillColor(new ImagickPixel('gray'));
            $valorDireccion->annotation(435, 45, ucfirst($address));  
            $footerLienzo->drawImage($valorDireccion);
            $logoImg = new Imagick("img/logo_2.png");            
            $footerLienzo->compositeimage($logoImg->getimage(), Imagick::COMPOSITE_DEFAULT, 680, 108);
            $reportaTexto = new \ImagickDraw();
            $reportaTexto->setFontSize(20);
            $reportaTexto->setFillColor(new ImagickPixel('gray'));
            $reportaTexto->annotation(15, 130, "Reporta mascotas perdidas o encontradas entrando a www.bosco.pe.");  
            $footerLienzo->drawImage($reportaTexto);
            $draw2 = new \ImagickDraw();
            $draw2->setStrokeColor(new ImagickPixel('gray'));
            $draw2->setFillColor(new ImagickPixel('gray'));
            $draw2->setStrokeWidth(2);
            $draw2->setFontSize(72);
            $draw2->line(30, 100, 770, 100);
            $footerLienzo->drawImage($draw2);
            /*$rewardLienzo = new Imagick("recompensa_capa.png");
            $rewardLienzo->newImage(300, 50, new ImagickPixel('white'));*/
            $rewardLienzo = new ImagickDraw();
            $rewardLienzo->setFillColor("rgb(0,0,0)");
            $rewardLienzo->setFillOpacity(0.7);
            $rewardLienzo->rectangle(500, 0, 800, 50);

            $phoneLienzo = new ImagickDraw();
            $phoneLienzo->setFillColor("rgb(0,0,0)");
            $phoneLienzo->setFillOpacity(0.8);
            $phoneLienzo->rectangle(0,700,800,800);

            /*$rewardLienzo2 = new Imagick();
            $rewardLienzo2->newImage(300,50, 'red');
            $rewardLienzo2->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE); // make sure it has an alpha channel
            $box=$rewardLienzo2->getImageRegion(0,0,300,50);
            $box->setImageAlphaChannel(Imagick::ALPHACHANNEL_TRANSPARENT);
            $rewardLienzo2->compositeImage($box,Imagick::COMPOSITE_REPLACE,300,50);*/
            $im->drawImage($rewardLienzo);
            $im->drawImage($phoneLienzo);
            $phoneImg = new Imagick("img/phone.png");            
            $im->compositeimage($phoneImg->getimage(), Imagick::COMPOSITE_DEFAULT, 180, 735);
            $phoneTexto = new \ImagickDraw();
            $phoneTexto->setFontSize(38);
            $phoneTexto->setFillColor(new ImagickPixel('white'));
            $phoneTexto->annotation(300, 760, $contact_phone);  
            $im->drawImage($phoneTexto);    
            $im->setImageFormat("png");
            $rewardTexto = new \ImagickDraw();
            $rewardTexto->setFontSize(24);
            $rewardTexto->setFillColor(new ImagickPixel('white'));
            $rewardTexto->annotation(535, 35, "Recompensa: S/. ");  
            $im->drawImage($rewardTexto);    
            $rewardTextoValor = new \ImagickDraw();
            $rewardTextoValor->setFontSize(28);
            $rewardTextoValor->setFillColor(new ImagickPixel('white'));
            $rewardTextoValor->annotation(720, 35, $reward);  
            $im->drawImage($rewardTextoValor);    
            $lienzo->compositeimage($headerLienzo->getimage(), Imagick::COMPOSITE_COPY, 0, 0);
            $lienzo->compositeimage($im->getimage(), Imagick::COMPOSITE_COPY, 0, 168);
            $lienzo->compositeimage($footerLienzo->getimage(), Imagick::COMPOSITE_COPY, 0, 968);
            $lienzo->writeimage("images/pets/report_".$pet_id.".png");
            $lienzo->destroy();

            //fin logica del lienzo

            $ubigeo = \App\Ubigeo::where('department',$department)->where('city',$city)->where('district',$district)->first();

            if (! is_object($ubigeo)) {
                $ubigeo_id=DB::table('ubigeos')->max('id');    
            } else {
                $ubigeo_id=$ubigeo->id;    
            }
            $location_data = [
                'address' =>$address,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'ubigeo_id' => $ubigeo_id,
                'updated_at' =>Date('Y-m-d H:i:s')
            ];        
            $result = \App\Location::where('id',$report->last_location_id)->update($location_data);
            $report_data = [
                'date' =>date_format(\DateTime::createFromFormat("Y-m-d H:i a", $date." ".$time), "Y-m-d H:i"),
//                'last_location_id' => $location_id,
                'reward' => $reward,
                'description' => $report_description,
                'status' => $status,
                'updated_at' =>Date('Y-m-d H:i:s'),
                'phone' => $contact_phone
            ];
            $result = \App\Report::where('id',$report_id)->update($report_data);
        }
        return json_encode(true);
    }

    public function getDownloadReport($status, Request $request) {
        $id = $request->get('reportid');
        $report = Report::getDataReport($id);
        
        $png_file = public_path().'/images/pets/report_' . $report['pet_id'] . ".png";
        if(file_exists($png_file)) {
            return response()->download($png_file);
        }
       /* $view = \Illuminate\Support\Facades\View::make('pdf/download-report-lost', ['report' => $report]);
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
        }*/
    }
    public function postFacebook(Request $request) {
        $id = $request->get('report_id');
        $user_id = $request->get('user_id');
        $access_token = $request->get('access_token ');
        $report = Report::getDataReport($id);
        /*$view = \Illuminate\Support\Facades\View::make('pdf/download-report-lost', ['report' => $report]);
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
        $imagick->writeImages($jpg_file, false); **/
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
        return response()->json($report['pet_id']);
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
