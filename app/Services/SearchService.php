<?php
/**
 * Created by PhpStorm.
 * User: maplater
 * Date: 11/15/2016
 * Time: 8:54 PM
 */

namespace App\Services;

use Carbon\Carbon;
use App\Services\CityService;
use App\Services\ArtistService;


class SearchService {

    protected $cityService;
    protected $artistService;


    public function __construct(CityService $cityService, ArtistService $artistService)
    {
        $this->cityService = $cityService;
        $this->artistService = $artistService;

    }

    public function search($input)
    {
        //getCity
        //getEventsbyCity
        //filter Events by date
        //get Genres for artists of events
        //filter events by genre of artists
        //get youtube links for artists
        //return list
        $eventFlag = 0;

        $city = $this->cityService->getCity($input['city']);
        $events = $this->cityService->getEventsbyCity($city);

        ((!empty($events)) ? $filteredEvents = $this->filterEventsbyDate($events, $input['date']) : $eventFlag = 1);
        ((!empty($filteredEvents) && $eventFlag == 0) ? $genredEvents = $this->artistService->getGenresforArtists($filteredEvents) : $eventFlag = 1);
        ((!empty($genredEvents) && $eventFlag == 0) ? $filteredGenredEvents = $this->filterEventsbyGenre($genredEvents, $input['genre']) : $eventFlag = 1);
        ((!empty($filteredGenredEvents) && $eventFlag == 0) ? $linkedEvents = $this->artistService->getYoutubeLinksforArtists($filteredGenredEvents) : $eventFlag = 1);



        if($eventFlag == 0){

            $finalEvents = $linkedEvents;

        }else{

            $finalEvents = NULL;
        }

        return $finalEvents;



    }

    public function filterEventsbyGenre($events, $genre)
    {
        $filteredGenreEvents = NULL;
        foreach($events as $event){

            if(!empty($event['genres'])) {

                foreach ($event['genres'] as $eventGenre) {
                    if (strpos(strtolower($eventGenre), strtolower($genre)) !== FALSE) {
                    //if ($eventGenre == $genre) {

                        $filteredGenreEvents[] = $event;
                        break;

                    }
                }
            }

        }

        return $filteredGenreEvents;
    }

    public function filterEventsbyDate($events,$date)
    {
        $filteredEvents = NULL;
        foreach($events as $event){

            $eventDate = new Carbon($event['datetime']);
            $eventDay = $eventDate->format('Y-m-d');

            if($eventDay == $date){

                $filteredEvents[] = $event;
            }

        }

        return $filteredEvents;
    }

} 