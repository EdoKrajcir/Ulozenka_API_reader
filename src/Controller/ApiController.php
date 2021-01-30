<?php

    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;


    class ApiController extends AbstractController
    {
        public function getRequestAPI(String $url): array{
            $curl = curl_init(); //inicializuj curl
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            
            $result = curl_exec($curl); //posli request
            if(!$result){die("Connection Failure");} //ak sa nepodarilo, vyhod chybu
            curl_close($curl); //ukonci spojenie
            
            $response = json_decode($result, true); //dekoduj json
            return $response;
         }  
    }