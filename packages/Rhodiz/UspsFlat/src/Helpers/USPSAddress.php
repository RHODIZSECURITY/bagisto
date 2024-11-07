<?php

namespace Rhodiz\UspsFlat\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class USPSAddress
{
    private $base_url = "https://api.usps.com/addresses/v3/address";
    private $client_id;
    private $client_secret;
    private $token;
    private $cache_version = "v1.25";

    public function __construct()
    {
        /*$this->client_id = config('services.usps.client_id');
        $this->client_secret = config('services.usps.client_secret');*/
    }

    public function getAddressDetails($streetAddress, $city, $state, $ZIPCode, $clearCache = false)
    {
        $params = [
            'streetAddress' => $streetAddress,
            //'secondaryAddress' => "", //$secondaryAddress,
            'city' =>  $city,
            'state' => $state,
            'ZIPCode' => $ZIPCode,
            //'ZIPPlus4' => "" //$ZIPPlus4
        ];

        //Buscar primero en cache
        $cacheKey = "usps_address_{$params['streetAddress']}_{$params['city']}_{$params['state']}_{$params['ZIPCode']}";
        if ($clearCache) Cache::forget($cacheKey);
        $cachedAddress = Cache::get($cacheKey);
        if ($cachedAddress) {
            return $cachedAddress;
        }

        $response = $this->makeRequestWithRetry($this->base_url, $params);

        if ($response=="error") {
            return $finalResponse = [
                'code' => 550,
                'message' => 'Unexpexted Error!!!'
            ];
        }

        $responseArr = $response->json();

        $finalResponse = [];

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {

            //Correcciones
            $finalResponse["code"] = 200;
            $finalResponse["data"]["city"] = $responseArr["address"]["city"];
            $finalResponse["data"]["state"] = $responseArr["address"]["state"];
            $finalResponse["data"]["postcode"] = $responseArr["address"]["ZIPCode"];
            $finalResponse["data"]["address"] = $responseArr["address"]["streetAddress"];

            Cache::put($cacheKey, $finalResponse, 1440); // Almacena la direccion en caché por 1 día
            return $finalResponse;
        }

        //400 - There are errors in the received request
        if ($response->status() == 400) {

            $errorMsg = $responseArr['error']['message'];

            // "Multiple addresses were found"
            // "Address Not Found"

            $finalResponse = [
                'code' => 400,
                'message' => $errorMsg
            ];

            Cache::put($cacheKey, $finalResponse, 1440); // Almacena la direccion en caché por 1 día
            return $finalResponse;
        }

        if ($response->status() == 401) {
            $finalResponse = [
                'code' => 401,
                'message' => 'Unauthorized Request'
            ];
        } else if ($response->status() == 403) {
            $finalResponse = [
                'code' => 403,
                'message' => 'Access is Denied'
            ];
        } else if ($response->status() == 429) {
            $finalResponse = [
                'code' => 429,
                'message' => 'Too Many Requests'
            ];
        } else if ($response->status() == 503) {
            $finalResponse = [
                'code' => 503,
                'message' => 'Service is Unavailable'
            ];
        } else if ($response->serverError()) {
            $finalResponse = [
                'code' => $response->status(),
                'message' => 'Unexpexted Server Error'
            ];
        } else {
            $finalResponse = [
                'code' => $response->status(),
                'message' => 'Unexpexted Error'
            ];
        }

        return $finalResponse;
    }

    private function makeRequestWithRetry($url, $data, $maxRetries = 2)
    {
        try {

            $this->token = $this->makeTokenRequestWithRetry();
            if ($this->token == "error") return "error";

            $attempt = 0;
            $response = null;

            while ($attempt < $maxRetries) {

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $this->token,
                ])->timeout(30)->get($url, $data);

                if ($response->successful()) {
                    return $response;
                }

                if ($response->status() == 401) {
                    // Refrescar el token si es necesario
                    $this->token = $this->makeTokenRequestWithRetry();
                    if ($this->token == "error") return "error";
                }

                $attempt++;
            }

            return $response;

        } catch (Exception $ex) {
            // Manejar error
            return "error";
        }
    }

    private function makeTokenRequestWithRetry($maxRetries = 2)
    {
        $attempt = 0;
        $token = "";

        //Intentar obtener el token
        while ($attempt < $maxRetries) {
            $token = $this->getToken();
            if ($this->token != "error") break;
            $attempt++;
        }

        return $token;
    }

    private function getToken()
    {
        $cacheKey = 'usps_OAuth_token';//El token es compartido con PriceRates //'usps_token_'.$this->cache_version;

        // Intenta obtener el token del caché
        $token = Cache::get($cacheKey);

        if (!$token) {
            // Si el token no está en el caché, solicita uno nuevo
            $tokenData = $this->getOAuthToken();
            if (isset($tokenData['access_token'])) {
                $token = $tokenData['access_token'];
                Cache::put($cacheKey, $token, 300 ); // Almacena el token en caché
            } else {
                $token = "error";
            }
        }

        return $token;
    }

    public function getOAuthToken()
    {
        try {

            $this->client_id     = core()->getConfigData('sales.carriers.usps_flat.USPS_CLIENT_ID');
            $this->client_secret = core()->getConfigData('sales.carriers.usps_flat.USPS_CLIENT_SECRET');

            $url = 'https://api.usps.com/oauth2/v3/token';
            $data = [
                "client_id" => $this->client_id,
                "client_secret" => $this->client_secret,
                "grant_type" => "client_credentials"
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, $data);

            // Verifica si la solicitud fue exitosa
            if ($response->successful()) {
                return $response->json();
            }

            // Manejar error
            return [
                'error' => $response->status(),
                'message' => $response->body(),
            ];

        } catch (Exception $ex) {

            // Manejar error
            return [
                'error' => 500,
                'message' => $ex->getMessage()
            ];
        }
    }
}
