<?php
namespace App\Repositories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

class CityRepository
{

    public function search($cityquery)
    {
        $client = new Client();

        $response = $client->request(
            'GET',
            'http://api.songkick.com/api/3.0/search/locations.json',
            [
                'query' =>
                    [
                        'query' => $cityquery,
                        'apikey' => env('SONGKICK_API_KEY')
                    ]
            ]
        );

        $body = json_decode($response->getbody());
        $count = 0;
        /*print_r($body);
        die();*/
        if(isset($body->resultsPage->results->location)) {
            foreach ($body->resultsPage->results->location as $place) {

                $cityList[$count]['name'] = $place->city->displayName . ', ' . (isset($place->city->state->displayName) ? $place->city->state->displayName . ', ' : '') . $place->city->country->displayName;

                $cityList[$count]['id'] = $place->metroArea->id;

                $count++;
            }
        }else{
            $cityList = NULL;
        }
        return $cityList;

    }

    public function getEventsbyCity($city)
    {
        $client = new Client();
        $count = 0;
        $events = null;
        $page = 1;

        $url = 'http://api.songkick.com/api/3.0/metro_areas/' . $city['id'] . '/calendar.json';

        do {

            $response = $client->request(
                'GET',
                $url,
                [
                    'query' =>
                        [
                            'apikey' => env('SONGKICK_API_KEY'),
                            'per_page' => 50,
                            'page' => $page
                        ]
                ]
            );

            $body = json_decode($response->getbody());
            $pageCount = 0;
            if(!empty($body->resultsPage->results->event)) {
                foreach ($body->resultsPage->results->event as $event) {

                    foreach ($event->performance as $artist) {


                        if ($event->start->datetime != "") {
                            $events[$count]['event_id'] = $event->id;
                            $events[$count]['venue_id'] = $event->venue->id;
                            $events[$count]['venue_name'] = $event->venue->displayName;
                            $events[$count]['artist_name'] = $artist->displayName;
                            $events[$count]['artist_id'] = $artist->id;
                            $events[$count]['datetime'] = $event->start->datetime;
                            $events[$count]['popularity'] = $event->popularity;
                            $events[$count]['time'] = Carbon::parse($event->start->time)->format('g:i A');;
                            $events[$count]['songkick_url'] = $event->uri;
                            $events[$count]['event_name'] = $event->displayName;
                        }

                        $count++;
                        $pageCount++;
                    }


                }
            }

            $page++;
            //echo $body->resultsPage->perPage . "<br/>";
        }while($pageCount >= $body->resultsPage->perPage && $pageCount != 0);

        return $events;
    }

}