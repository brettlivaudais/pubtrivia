<?php

namespace App\Helpers;
use GuzzleHttp\Client;

class PositionStackHelper
{
    public static function getLocationByLatLong($latitude,$longitude) 
    {
        /*
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
        */

        $apiKey = env('POSITIONSTACK_API_KEY');
        $url = "http://api.positionstack.com/v1/reverse?access_key=$apiKey&query=$latitude,$longitude";
        $client = new Client();
        $response = $client->get($url);
        $locationInfo = json_decode($response->getBody(), true);
        return $locationInfo['data'][0];
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