<?php
/**
 * Created by PhpStorm.
 * User: maplater
 * Date: 11/16/2016
 * Time: 8:31 PM
 */

namespace App\Repositories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ArtistRepository {

    public function getGenresforArtists($events)
    {
        $client = new Client();
        $genreEvents = Null;

        foreach($events as $event) {


            $response = $client->request(
                'GET',
                'http://ws.audioscrobbler.com/2.0/',
                [
                    'query' =>
                        [
                            'method' => 'artist.gettoptags',
                            'api_key' => env('LASTFM_API_KEY'),
                            'format' => 'json',
                            'artist' => $event['artist_name']
                        ]
                ]
            );

            $body = json_decode($response->getbody());

            if(isset($body->toptags)){
                $tag = array();
                foreach($body->toptags->tag as $t){
                    $tag[] = $t->name;

                }
                $event['genres'] = $tag;

            }else{
                $event['genres'] = NULL;
            }

            $genreEvents[] = $event;

        }
        /*if(empty($genreEvents)){

            $genreEvents = $this->getGenresfromSoundCloud($events);

        }*/

        return $genreEvents;

    }

    public function getGenresfromSoundCloud($events)
    {



        return $genreEvents;
    }

    public function getYoutubeLinksforArtists($events)
    {

        $client = new Client();
        $linkedEvents = NULL;

        foreach($events as $event) {


            $response = $client->request(
                'GET',
                'https://www.googleapis.com/youtube/v3/search',
                [
                    'query' =>
                        [
                            'part' => 'snippet',
                            'key' => env('YOUTUBE_API_KEY'),
                            'order' => 'relevance',
                            'q' => $event['artist_name'],
                            'topicId' => '/m/04rlf',
                            'maxResults' => 1,
                            'type' => 'video'
                        ]
                ]
            );

            $body = json_decode($response->getbody());

            $youtube_link = 'https://www.youtube.com/watch?v=' . $body->items[0]->id->videoId;

            $event['youtube_link'] = $youtube_link;

            $linkedEvents[] = $event;

        }

        return $linkedEvents;
    }

} 