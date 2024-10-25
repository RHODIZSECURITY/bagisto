<?php

namespace Rhodiz\UspsFlat\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class USPSPriceRates
{
    private $client_id;
    private $client_secret;
    private $token;
    private $cache_version = "v1.25";

    public function __construct()
    {
        $this->client_id = config('services.usps.client_id');
        $this->client_secret = config('services.usps.client_secret');
    }

    private function getToken()
    {
        $cacheKey = 'usps_token_'.$this->cache_version;

        // Intenta obtener el token del caché
        $token = Cache::get($cacheKey);

        if (!$token) {
            // Si el token no está en el caché, solicita uno nuevo
            $tokenData = $this->getOAuthToken();
            if (isset($tokenData['access_token'])) {
                $token = $tokenData['access_token'];
                Cache::put($cacheKey, $token, 300 ); // Almacena el token en caché
            }
        }

        return $token;
    }

    public function getOAuthToken()
    {
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
    }

    private function makeRequestWithRetry($url, $data, $maxRetries = 2)
    {
        $this->token = $this->getToken();

        $attempt = 0;
        $response = null;

        while ($attempt < $maxRetries) {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ])->timeout(30)->post($url, $data);

            if ($response->successful()) {
                return $response;
            }

            if ($response->status() == 401) {
                // Refrescar el token si es necesario
                $this->token = $this->getToken();
            }

            $attempt++;
        }

        return $response;
    }

    //Dimensional rates de PRIORITY_MAIL, PRIORITY_MAIL_EXPRESS y USPS_GROUND_ADVANTAGE
    public function getDimensionalRectangularRates($originZIPCode, $destinationZIPCode, $weight, $dimensions, $mailingDate, $mailClassesEnabled, $clearCache = false)
    {
        $url = 'https://api.usps.com/prices/v3/base-rates/search';
        //$mailClasses = [ "PRIORITY_MAIL", "PRIORITY_MAIL_EXPRESS", "USPS_GROUND_ADVANTAGE" /*"PARCEL_SELECT",*/];
        $mailClasses = $mailClassesEnabled;

        $rates = [];

        foreach ($mailClasses as $mailClass) {

            // Tarifa por peso y dimensiones
            $data = [
                "originZIPCode" => $originZIPCode,
                "destinationZIPCode" => $destinationZIPCode,
                "weight" => $weight,
                "length" => $dimensions['length'],
                "width" => $dimensions['width'],
                "height" => $dimensions['height'],
                "mailClass" => $mailClass,
                "processingCategory" => "MACHINABLE",
                "destinationEntryFacilityType" => "NONE",
                "rateIndicator" => "DR", //"DR",  //Dimensional Rectangular
                "priceType" => "RETAIL",
                "mailingDate" => $mailingDate,
            ];

            dump($data);

            //Buscar primero en cache
            $cacheKey = "usps_dimensional_rate_{$mailClass}_{$destinationZIPCode}_{$weight}_{$dimensions['length']}_{$dimensions['width']}_{$dimensions['height']}_{$mailingDate}_".$this->cache_version;
            if ($clearCache) Cache::forget($cacheKey);
            $cachedRate = Cache::get($cacheKey);
            if ($cachedRate) {
                $rates[$mailClass] = $cachedRate;
                continue;
            }

            $response = $this->makeRequestWithRetry($url, $data);

            dump($response->json()); die;

            if ($response->successful()) {
                $rates[$mailClass] = $dimensionalRate = $response->json();
                Cache::put($cacheKey, $dimensionalRate, 1440); // Almacena las tarifas en caché por 1 día
            } else {
                $rates[$mailClass] = [
                    'error' => $response->status(),
                    'message' => $response,
                ];
            }
        }

        return $rates;
    }

    //Flat rates en cajas de 3 tipos en PRIORITY_MAIL
    public function getPriorityMailFlatRates($originZIPCode, $destinationZIPCode, $weight, $dimensions, $mailingDate, $flatType, $clearCache = false)
    {
        $url = 'https://api.usps.com/prices/v3/base-rates/search';
        $mailClasses = ['PRIORITY_MAIL'];
        $flatRateBoxes = [$flatType]; //['Small', 'Medium', 'Large'];

        foreach ($mailClasses as $mailClass) {
            // Tarifa por peso y dimensiones
            $data = [
                "originZIPCode" => $originZIPCode,
                "destinationZIPCode" => $destinationZIPCode,
                "weight" => $weight,
                "length" => $dimensions['length'],
                "width" => $dimensions['width'],
                "height" => $dimensions['height'],
                "mailClass" => $mailClass,
                "processingCategory" => "MACHINABLE", //"FLATS",
                "destinationEntryFacilityType" => "NONE",
                "rateIndicator" => "FS",  //Flat Rate Small Box
                "priceType" => "RETAIL",
                "mailingDate" => $mailingDate,
            ];

            // Tarifa plana para cajas Small, Medium, Large (aplica solo a PRIORITY y PRIORITY_EXPRESS)

            foreach ($flatRateBoxes as $boxSize) {

                if ( $boxSize == "Small") {
                    $data['rateIndicator'] = "FS";
                } else if ( $boxSize == "Medium") {
                    $data['rateIndicator'] = "FB";
                } else if ( $boxSize == "Large") {
                    $data['rateIndicator'] = "PL";
                }

                //Buscar primero en cache
                $cacheKey = "usps_priority_mail_flat_rate_". $data['rateIndicator']."_".$this->cache_version;
                if ($clearCache) Cache::forget($cacheKey);
                $cachedRate = Cache::get($cacheKey);
                if ($cachedRate) return $cachedRate;

                $response = $this->makeRequestWithRetry($url, $data);

                if ($response->successful()) {
                    $flatRate = $response->json();
                    Cache::put($cacheKey, $flatRate, 1440); // Almacena las tarifas en caché por 1 día
                    return $flatRate;
                } else {
                    $flatRate = [
                        'error' => $response->status(),
                        'message' => $response->body(),
                    ];
                }
            }
        }

        return false; //$rates;
    }

    /**
     * Valida si el paquete es "machinable" según los estándares de USPS.
     *
     * @return bool|string - Retorna true si el paquete es machinable, o una cadena con el motivo del fallo.
     */
    public function isMachinable( $dimensions, $weight )
    {
        // Estándares para paquetes machinables de USPS
        $MAX_LENGTH = 34; // pulgadas
        $MAX_WIDTH = 17;  // pulgadas
        $MAX_HEIGHT = 17; // pulgadas
        $MAX_WEIGHT = 25; // libras

        $MIN_LENGTH = 6;  // pulgadas
        $MIN_WIDTH = 3;   // pulgadas
        $MIN_HEIGHT = 0.25; // pulgadas

        $longitud = $dimensions['length'];
        $ancho = $dimensions['width'];
        $altura = $dimensions['height'];
        $peso = $weight;

        // Verificar restricciones de longitud
        if ($longitud < $MIN_LENGTH || $longitud > $MAX_LENGTH) {
            return false;//"La longitud debe estar entre " . MIN_LENGTH . " y " . MAX_LENGTH . " pulgadas.";
        }

        // Verificar restricciones de ancho
        if ($ancho < $MIN_WIDTH || $ancho > $MAX_WIDTH) {
            return false;//"El ancho debe estar entre " . MIN_WIDTH . " y " . MAX_WIDTH . " pulgadas.";
        }

        // Verificar restricciones de altura
        if ($altura < $MIN_HEIGHT || $altura > $MAX_HEIGHT) {
            return false;//"La altura debe estar entre " . MIN_HEIGHT . " y " . MAX_HEIGHT . " pulgadas.";
        }

        // Verificar restricciones de peso
        if ($peso > $MAX_WEIGHT) {
            return false;//"El peso no debe exceder las " . MAX_WEIGHT . " libras.";
        }

        return true;
    }

    //Primero prueba si se acomoda en el Small Box, despues en el Medium Box y despues en el Large Box
    //Si no se acomoda devolver false.
    public function getAplicableFlatBoxTypeByVolume($volumenTotalCarrito, $maxCartDimensions)
    {
        if ($volumenTotalCarrito<100) {
            $slack_factor = 1.30; // 30% de holgura
        } else if ($volumenTotalCarrito>=100 && $volumenTotalCarrito<200) {
            $slack_factor = 1.25; // 25% de holgura
        } else if ($volumenTotalCarrito>=200 && $volumenTotalCarrito<500) {
            $slack_factor = 1.20; // 15% de holgura
        } else {
            $slack_factor = 1.15; // 10% de holgura
        }

        // Dimensiones para Small Box
        $smallBox = [
            'length' => 8.6875,
            'width' => 5.4375,
            'height' => 1.75
        ];

        // Dimensiones para Medium Box (2 versiones)
        $mediumBox1 = [
            'length' => 11.25,
            'width' => 8.75,
            'height' => 6.0
        ];

        $mediumBox2 = [
            'length' => 14.0,
            'width' => 12.0,
            'height' => 3.5
        ];

        // Dimensiones para Large Box
        $largeBox = [
            'length' => 12.25,
            'width' => 12.25,
            'height' => 6.0
        ];

        $volumenConHolgura = $volumenTotalCarrito * $slack_factor;

        $smallBoxVolume = $smallBox["length"] * $smallBox["width"] * $smallBox["height"];
        //Verificar si cabe volumetricamente
        if ( $volumenConHolgura <= $smallBoxVolume ) {
            // Validar si el paquete puede ser enviado en la Small Box
            if ($maxCartDimensions['length'] <= $smallBox['length'] &&
                $maxCartDimensions['width'] <= $smallBox['width'] &&
                $maxCartDimensions['height'] <= $smallBox['height']) {
                return 'Small';
            }
        }

        $mediumBoxVolume = $mediumBox1["length"] * $mediumBox1["width"] * $mediumBox1["height"];
        //Verificar si cabe volumetricamente
        if ( $volumenConHolgura <= $mediumBoxVolume ) {
            // Validar si el paquete puede ser enviado en la Small Box
            if ($maxCartDimensions['length'] <= $mediumBox1['length'] &&
                $maxCartDimensions['width'] <= $mediumBox1['width'] &&
                $maxCartDimensions['height'] <= $mediumBox1['height']) {
                return 'Medium';
            }
        }

        $mediumBoxVolume = $mediumBox2["length"] * $mediumBox2["width"] * $mediumBox2["height"];
        //Verificar si cabe volumetricamente
        if ( $volumenConHolgura <= $mediumBoxVolume ) {
            // Validar si el paquete puede ser enviado en la Medium Box
            if ($maxCartDimensions['length'] <= $mediumBox2['length'] &&
                $maxCartDimensions['width'] <= $mediumBox2['width'] &&
                $maxCartDimensions['height'] <= $mediumBox2['height']) {
                return 'Medium';
            }
        }

        $largeBoxVolume = $largeBox["length"] * $largeBox["width"] * $largeBox["height"];
        //Verificar si cabe volumetricamente
        if ( $volumenConHolgura <= $largeBoxVolume ) {
            // Validar si el paquete puede ser enviado en la Large Box
            if ($maxCartDimensions['length'] <= $largeBox['length'] &&
                $maxCartDimensions['width'] <= $largeBox['width'] &&
                $maxCartDimensions['height'] <= $largeBox['height']) {
                return 'Large';
            }
        }

        return false;
    }

    public function getAplicableFlatBoxTypeByTotalHeigth( $maxCartDimensions, $totalHeight )
    {
        // Dimensiones para Small Box
        $smallBox = [
            'length' => 8.5,
            'width' => 5.3,
            'height' => 1.7
        ];

        // Dimensiones para Medium Box (2 versiones)
        $mediumBox1 = [
            'length' => 11.1,
            'width' => 8.6,
            'height' => 5.9
        ];

        $mediumBox2 = [
            'length' => 13.9,
            'width' => 13.9,
            'height' => 3.4
        ];

        // Dimensiones para Large Box
        $largeBox = [
            'length' => 12.1,
            'width' => 12.1,
            'height' => 5.9
        ];

        //Verificar si cabe volumetricamente
        if ( $smallBox["height"] >= $totalHeight ) {
            // Validar si el paquete puede ser enviado en la Small Box
            if ($maxCartDimensions['length'] <= $smallBox['length'] &&
                $maxCartDimensions['width'] <= $smallBox['width'] &&
                $maxCartDimensions['height'] <= $smallBox['height']) {
                return [ 'size' => 'Small', 'dimensions' => $smallBox];
            }
        }

        //Verificar si cabe volumetricamente
        if ( $mediumBox1["height"] >= $totalHeight ) {
            // Validar si el paquete puede ser enviado en la Small Box
            if ($maxCartDimensions['length'] <= $mediumBox1['length'] &&
                $maxCartDimensions['width'] <= $mediumBox1['width'] &&
                $maxCartDimensions['height'] <= $mediumBox1['height']) {
                return [ 'size' => 'Medium', 'dimensions' => $mediumBox1];
            }
        }

        //Verificar si cabe volumetricamente
        if ( $mediumBox2["height"] >= $totalHeight ) {
            // Validar si el paquete puede ser enviado en la Medium Box
            if ($maxCartDimensions['length'] <= $mediumBox2['length'] &&
                $maxCartDimensions['width'] <= $mediumBox2['width'] &&
                $maxCartDimensions['height'] <= $mediumBox2['height']) {
                return [ 'size' => 'Medium', 'dimensions' => $mediumBox2];
            }
        }

        //Verificar si cabe volumetricamente
        if ( $largeBox["height"] >= $totalHeight ) {
            // Validar si el paquete puede ser enviado en la Large Box
            if ($maxCartDimensions['length'] <= $largeBox['length'] &&
                $maxCartDimensions['width'] <= $largeBox['width'] &&
                $maxCartDimensions['height'] <= $largeBox['height']) {
                return [ 'size' => 'Large', 'dimensions' => $largeBox];
            }
        }

        return false;
    }

    //Se intenta crear una caja de (length x width x height) de (2 x 1 x 1)
    //Se le obliga a ser Machinable
    public function calcularDimensionesCarritoDimensional($volumenTotalCarrito)
    {
        if ($volumenTotalCarrito<100) {
            $factorHolgura = 1.30; // 34% de holgura
        } else if ($volumenTotalCarrito>=100 && $volumenTotalCarrito<200) {
            $factorHolgura = 1.25; // 25% de holgura
        } else if ($volumenTotalCarrito>=200 && $volumenTotalCarrito<500) {
            $factorHolgura = 1.20; // 15% de holgura
        } else {
            $factorHolgura = 1.15; // 10% de holgura
        }

        $dimensionsModel = [
            'length' => 8,
            'width' => 6,
            'height' => 4
        ];

        $volumenConHolgura = $volumenTotalCarrito * $factorHolgura;

        $dimensionsResult = $this->calculateProportionalDimensions($volumenConHolgura, $dimensionsModel);

        $longitud = $dimensionsResult['length'];
        $ancho = $dimensionsResult['width'];
        $altura = $dimensionsResult['height'];

        $MIN_LENGTH = 6;  // pulgadas
        $MIN_WIDTH = 3;   // pulgadas
        $MIN_HEIGHT = 0.25; // pulgadas

        if ($longitud < $MIN_LENGTH) {
            $longitud = 6.1;
        }

        if ($ancho < $MIN_WIDTH) {
            $ancho = 3.1;
        }

        if ($altura < $MIN_HEIGHT) {
            $altura = 0.9;
        }

        return [
            'length' => round($longitud, 2),
            'width' => round($ancho, 2),
            'height' => round($altura, 2)
        ];
    }

    function calculateProportionalDimensions($desired_volume, $dimensionsModel) {

        $type_length = $dimensionsModel["length"];
        $type_width = $dimensionsModel["width"];
        $type_height = $dimensionsModel["height"];

        // 1. Calculate the volume of the type dimensions
        $type_volume = $type_width * $type_length * $type_height;

        // 2. Calculate the scale factor
        $scale_factor = pow($desired_volume / $type_volume, 1/3);

        // 3. Calculate the new adjusted dimensions
        $new_width = $type_width * $scale_factor;
        $new_length = $type_length * $scale_factor;
        $new_height = $type_height * $scale_factor;

        // 5. Return the new proportional dimensions
        return array(
            'width' => $new_width,
            'length' => $new_length,
            'height' => $new_height
        );
    }
}
