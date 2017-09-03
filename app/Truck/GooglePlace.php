<?php

namespace App\Truck;

/**
 * Created by PhpStorm.
 * User: tkagnus
 * Date: 03/09/2017
 * Time: 00:20
 */
use Illuminate\Support\Collection;

/**
 * Class GooglePlace
 * @package App\Truck
 */
class GooglePlace
{

    /**
     *
     */
    const KEY = 'AIzaSyB6xNBLX2S-hA-qJ-Vd7M8Pa2xhZmVDP4g';

    /**
     *
     */
    const URL = 'https://maps.googleapis.com/maps/api/place/';

    /**
     *
     */
    const SEARCH_ENDPOINT = 'autocomplete';

    /**
     *
     */
    const DETAILS_ENDPOINT = 'details';

    /**
     *
     */
    const RESPONSE_TYPE = 'json';

    /**
     * @param $key
     * @return Collection
     */
    public function search($key)
    {
        $url = static::URL . static::SEARCH_ENDPOINT . '/' . static::RESPONSE_TYPE;

        $params = [
            'input' => $key,
            'language' => 'ro',
            'types' => '(cities)',
//            'components' => 'country:ro',
            'key' => static::KEY,
        ];

        $resp = $this->request($url, $params);
        $collection = collect($resp->predictions ?? []);


        $results = $collection->map(function ($place) {

            if (!isset($place->place_id)) {
                return null;
            }

            return (object)[
                'google_id' => $place->place_id,
                'display' => $place->description
            ];
        })->reject(null);


        return $results;
    }

    /**
     * @param $placeId
     * @return bool|object
     */
    public function detail($placeId)
    {
        $url = static::URL . static::DETAILS_ENDPOINT . '/' . static::RESPONSE_TYPE;

        $params = [
            'placeid' => $placeId,
            'key' => static::KEY,
        ];

        $resp = $this->request($url, $params);

        if (empty($resp)) {
            return false;
        }

        $result = $resp->result;

        $address = collect($result->address_components);

        $region = $address->first(function ($addr) {
            $types = collect($addr->types);
            return $types->search('administrative_area_level_1') !== false;
        });

        if ($region) {
            $region = $region->short_name ?? null;
        }

        $place = (object)[
            'google_id' => $result->place_id,
            'name' => $result->name,
            'latitude' => $result->geometry->location->lat,
            'longitude' => $result->geometry->location->lng,
            'region' => $region == 'Bucharest' ? 'B' : $region
        ];

        return $place;
    }

    /**
     * @param $url
     * @param $params
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    protected function request($url, $params)
    {
        $client = new \GuzzleHttp\Client();

        $response = null;


        try {
            $response = $client->get($url, [
                'query' => $params,
            ]);

            $response = json_decode($response->getBody()->getContents());

        } catch (\Exception $e) {
//            dump($e->getMessage());
        }

        return $response;
    }

}