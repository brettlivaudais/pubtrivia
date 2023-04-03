<?php

namespace App\Helpers;
use GuzzleHttp\Client;

class PositionStackHelper
{
    public static function getLocationByLatLong($lat,$long) 
    {
        $apiKey = env('POSITIONSTACK_API_KEY');
        $client = new Client();
        $response = $client->request('GET', 'http://api.positionstack.com/v1/reverse', [
            'query' => [
                'access_key' => $apiKey,
                'query' => $lat . ',' . $long
            ]
        ]);
        $body = $response->getBody();
        return $body;
    }

    public static function getLatLongbyAddress($address)
    {
        $apiKey = env('POSITIONSTACK_API_KEY');
        $client = new Client();
        $response = $client->request('GET', 'http://api.positionstack.com/v1/forward', [
            'query' => [
                'access_key' => $apiKey,
                'query' => $address
            ]
        ]);
        $body = json_decode($response->getBody(), true);
        return $body['data'][0];
    }
}