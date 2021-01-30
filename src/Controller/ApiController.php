<?php

    namespace App\Controller;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;


    class ApiController extends AbstractController
    {
        public function getRequestAPI(String $url): array{
            $data = false;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            
            $result = curl_exec($curl);
            if(!$result){die("Connection Failure");}
            curl_close($curl);
            
            $response = json_decode($result, true);
            return $response;
         }  

        public function branches(){
            
            $get_data = callAPI('GET', 'https://www.ulozenka.cz/gmap', false);
            $response = json_decode($get_data, true);
            $errors = $response['response']['errors'];
            $data = $response['response']['data'][0];
            
            dd($data);

            return $this->render('user/api.html.twig');
            }
    }