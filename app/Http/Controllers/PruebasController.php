<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Carbon\Carbon;

use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Operations\Search;
use ApaiIO\ApaiIO;

use Illuminate\Http\Request;

class PruebasController extends Controller
{
    private $token = "eyJraWQiOiJaZTRhdzZNRWtzVXZxYk1tOXRiK1VHeEJGdk0rcHFFbUY0R1gwZ1FKSGt3PSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiI1aTF0YzhjdDA4cGZjbjQ4NGtkMXZrOXRlaSIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoidXNlclwvYXBwbGljYXRpb24iLCJhdXRoX3RpbWUiOjE2MTUyODE5NTIsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5hcC1zb3V0aGVhc3QtMS5hbWF6b25hd3MuY29tXC9hcC1zb3V0aGVhc3QtMV92TVJ2V0VuV1UiLCJleHAiOjE2MTUzNjgzNTIsImlhdCI6MTYxNTI4MTk1MiwidmVyc2lvbiI6MiwianRpIjoiY2IxOGJmZDAtNTdiMS00MTc0LWE3ODUtOWVhMzE0YmQwM2U3IiwiY2xpZW50X2lkIjoiNWkxdGM4Y3QwOHBmY240ODRrZDF2azl0ZWkifQ.LY2unuw9H9pWcKsXaybxP9Sm5QAU-LjiJX6VKTWH2MYMAQpKvqs7n0ZELhbv89orRoiFDGWW5o4e5wCVwrNglin_RA9xe7VZSLLAapXFW1lILJYr3SL6nTUNqNXL06u88js7mvC1x0-MfzJ2hy4cxi-hNhH-UwLTf7MzNAsL-rBYbzrpAihFqdt8DxwZFTVrLK3nZLZBkRf4lLy7JQbTtX1FwjWUo8ubW-NT-Q5afosegZCoOk3USJepEmiem5VWJBCTf08bXYniJAelloFLepP4-W9ehqm1HG6VZPKQpbWWziVNKaGFywmNqtrPCnY1EiKj4COWvLRuwUtCePPfzA";
    private $groupId = "80deb778a8aa3a1f86c8c9793dba2c700c4725212a5997588a0d03929030a2cd";
    private $connectorId = "51d30a0f-b3b5-4b35-a66d-ff7e924e9cde";
    

    public function index(){
        $client = new Client(); //GuzzleHttp\Client
        
        $url = "https://jondecasa.com/prueba.php";
        $response = $client->request('GET', $url, [
            'data' => 'hola',
        ]);
    }
    
    public function index_b(){
        $client = new Client(); //GuzzleHttp\Client
        //$url = "https://api.unaconnect.io/v1/connector/connectorEvent/?connectorId=".$this->connectorId."&groupId=".$this->groupId."&beginDate=". urlencode(Carbon::createFromFormat('Y-m-d', "2021-02-02")->timestamp)."&endDate=".strtotime("2021-02-03");
        $url = "https://api.unaconnect.io/v1/connector/connectorEvent/?connectorId=".$this->connectorId."&groupId=".$this->groupId.
                "&beginDate=".urlencode("1614249030")."&endDate=".urlencode("1614335430");

        $clientId = "5i1tc8ct08pfcn484kd1vk9tei";
        $clientSecret = "g4pn2oo1cj59bjdgck8s8h1u82d44d0laf908ri6kfecq2r59v0";

        $pagina = $url;
        $credenciales = $clientId.":".$clientSecret;

        $response = $client->request('GET', $pagina, [
            //'verify'  => false,
            'http_errors' => false,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                //'Authorization' => 'Basic ' . ($this->token),
                'Authorization' => ($this->token),
                
            ]
        ]);

        $responseBody = json_decode($response->getBody());
        
        dd($responseBody);
    }
    public function indexConnect(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.unaconnect.io/v1/connector/?connectorId=".$this->connectorId."&groupId=".$this->groupId;
        $clientId = "5i1tc8ct08pfcn484kd1vk9tei";
        $clientSecret = "g4pn2oo1cj59bjdgck8s8h1u82d44d0laf908ri6kfecq2r59v0";

        $pagina = $url;
        $credenciales = $clientId.":".$clientSecret;

        $response = $client->request('GET', $pagina, [
            //'verify'  => false,
            'http_errors' => false,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                //'Authorization' => 'Basic ' . ($this->token),
                'Authorization' => ($this->token),
                
            ]
        ]);

        $responseBody = json_decode($response->getBody());
        
        dd($responseBody);
    }
    public function indexUsuarioNerea(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.unaconnect.io/v1/user?userId=7e69f6e7-d4e5-4246-8eef-978f03f55b4a";
        $clientId = "5i1tc8ct08pfcn484kd1vk9tei";
        $clientSecret = "g4pn2oo1cj59bjdgck8s8h1u82d44d0laf908ri6kfecq2r59v0";

        $pagina = $url;
        $credenciales = $clientId.":".$clientSecret;

        $response = $client->request('GET', $pagina, [
            //'verify'  => false,
            'http_errors' => false,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                //'Authorization' => 'Basic ' . ($this->token),
                'Authorization' => ($this->token),
                
            ]
        ]);

        $responseBody = json_decode($response->getBody());
        
        dd($responseBody);
    }
    
    public function indexDevice(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://api.unaconnect.io/v1/device?deviceId=00EF8D1B";
        $clientId = "5i1tc8ct08pfcn484kd1vk9tei";
        $clientSecret = "g4pn2oo1cj59bjdgck8s8h1u82d44d0laf908ri6kfecq2r59v0";

        $pagina = $url;
        $credenciales = $clientId.":".$clientSecret;

        $response = $client->request('GET', $pagina, [
            //'verify'  => false,
            'http_errors' => false,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                //'Authorization' => 'Basic ' . ($this->token),
                'Authorization' => ($this->token),
                
            ]
        ]);

        $responseBody = json_decode($response->getBody());
        
        dd($responseBody);
    }
    public function obtenerCredenciales(){
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://auth.unaconnect.io";
        $clientId = "5i1tc8ct08pfcn484kd1vk9tei";
        $clientSecret = "g4pn2oo1cj59bjdgck8s8h1u82d44d0laf908ri6kfecq2r59v0";

        $pagina = $url."/oauth2/token?grant_type=client_credentials";
        $credenciales = $clientId.":".$clientSecret;

        $response = $client->request('POST', $pagina, [
            //'verify'  => false,
            'http_errors'=>false,
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                'Authorization' => 'Basic ' . base64_encode($credenciales),
            ]
        ]);

        $responseBody = json_decode($response->getBody());
        
        dd($responseBody);
    }
    
    public function test(Request $request ){
        $ruta = new Client(); //GuzzleHttp\Client
        $AWS_ACCESS_KEY_ID = "AKIAJA3MDDBSZ35SPWVQ";
        $AWS_SECRET_ACCESS_KEY = "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";
        $partner = "jdc157-21";
        
       
        $conf = new GenericConfiguration();
        $client = new \GuzzleHttp\Client();
        $request = new \ApaiIO\Request\GuzzleRequest($client);

        $conf
            ->setCountry('es')
            ->setAccessKey($AWS_ACCESS_KEY_ID)
            ->setSecretKey($AWS_SECRET_ACCESS_KEY)
            ->setAssociateTag($partner)
            ->setRequest($request);
        $apaiIO = new ApaiIO($conf);

        $search = new Search();
        $search->setCategory('DVD');
        $search->setActor('Bruce Willis');
        $search->setKeywords('Die Hard');

        $formattedResponse = $apaiIO->runOperation($search);

        dd($formattedResponse);

    }
}
