<?php

namespace Rhodiz\UspsFlat\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Webkul\Product\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Rhodiz\UspsFlat\Helpers\USPSAddress;

class AddressController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ProductRepository $productRepository) {
    }

    /**
     * Handle the adress validation request and retrieve validation result and adress correction
     *
     * @return array
     */
    public function addressValidation()
    {
        $params = request()->input();

        $city = $params['city'] ?? '';
        $state = $params['state'] ?? '';
        $ZIPCode = $params['postcode'] ?? '';
        $streetAddress = $params['address'][0] ?? '';

        $data = [
            'streetAddress' => $streetAddress,
            'city' => $city,
            'state' => $state,
            'ZIPCode' => $ZIPCode,
        ];

        /*$data = [
            'streetAddress' => "3120 m st",
            'city' => "Washington",
            'state' => "DC",
            'ZIPCode' => "20027",
        ];*/

        $uspsHelper = new USPSAddress();

        //Llamar al USPSHelper para obtener los detalles de la dirección
        $response = $uspsHelper->getAddressDetails($data['streetAddress'], $data['city'], $data['state'], $data['ZIPCode']);

        if (isset($response['code']) ) {
            return new JsonResponse($response,$response['code']);
        } else {
            return new JsonResponse([],422);
        }
    }
}
