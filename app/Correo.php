<?php 

namespace App;

require_once __DIR__ . "/../vendor/sendgrid/sendgrid/lib/SendGrid.php";
require_once __DIR__ . "/../vendor/sendgrid/php-http-client/lib/SendGrid/Client.php";
require_once __DIR__ . "/../vendor/sendgrid/sendgrid/lib/helpers/mail/Mail.php";
/*
* Clase para enviar 
* correos usando SendGrid
*/
class Correo {
    function enviarCorreo($nombre, $email) {
        $from = new \SendGrid\Email('Bosco', "info@bosco.pe");
        $subject = "Bienvenido a Bosco";
        $to = new \SendGrid\Email($nombre, $email);
        $content = new \SendGrid\Content("text/plain", "Estimado ".$nombre.", gracias por registrarte en Bosco.");
        $mail = new \SendGrid\Mail($from, $subject, $to, $content);
        //$apiKey = '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';
        $apiKey = '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';
        //$apiKey = 'xxx';
        $sg = new \SendGrid($apiKey);
        $response = $sg->client->mail()->send()->post($mail);        
    }
}