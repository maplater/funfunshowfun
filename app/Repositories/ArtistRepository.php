<?php
/**
 * Created by PhpStorm.
 * User: maplater
 * Date: 11/16/2016
 * Time: 8:31 PM
 */

namespace App\Repositories;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;


class ArtistRepository {

    public function getGenresforArtists($genreEvents)
    {

        $genreEvents = $this->getGenresfromLastFM($genreEvents);

        $genreEvents = $this->getGenresfromSpotify($genreEvents);


        return $genreEvents;

    }

    public function getGenresfromSpotify($events)
    {
        $client = new Client();
        $genreEvents = Null;


        $response = $client->request(
            'POST',
            'https://accounts.spotify.com/api/token',
            [
                'form_params' =>
                    [
                        'grant_type' => 'client_credentials'

                    ],
                'headers' =>
                    [
                        'Authorization' => 'Basic ' . base64_encode(env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET'))

                    ]
            ]
        );

        $body = json_decode($response->getbody());

        $accessToken = $body->access_token;

        foreach($events as $event) {
            try {
                $response = $client->request(
                    'GET',
                    'https://api.spotify.com/v1/search',
                    [
                        'query' =>
                            [
                                'q' => $event['artist_name'],
                                'type' => 'artist',
                                'limit' => 1

                            ],
                        'headers' =>
                            [
                                'Authorization' => 'Bearer ' . $accessToken

                            ]
                    ]
                );

                $body = json_decode($response->getbody());


                if (!empty($body->artists->items[0]->genres)) {
                    $tag = array();
                    foreach ($body->artists->items[0]->genres as $t) {

                        $tag[] = html_entity_decode($t);

                    }

                    if(isset($event['genres'])) {

                        $event['genres'] = array_merge($event['genres'], $tag);

                    }else{

                        $event['genres'] = $tag;
                    }

                    $event['spotify_url'] = $body->artists->items[0]->external_urls->spotify;

                } else {
                    if(!isset($event['genres'])) {
                        $event['genres'] = array();
                    }
                }

                $genreEvents[] = $event;


            } catch(ClientException $e){
                $responseError =  json_decode($e->getResponse()->getBody());


                if($responseError->error->status == 429){

                    $responseHeaderRetry =  $e->getResponse()->getHeader('Retry-After');

                    sleep($responseHeaderRetry[0]);

                    prev($events);

                }


            }


        }


        return $genreEvents;

    }

    public function getGenresfromLastFM($events)
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

            if (isset($body->toptags)) {
                $tag = array();
                $tagCount = 1;
                foreach ($body->toptags->tag as $t) {

                    $tag[] = $t->name;
                    if($tagCount == 10){
                        break;
                    }
                    $tagCount++;

                }
                if(isset($event['genres'])) {

                    $event['genres'] = array_merge($event['genres'], $tag);

                }else{

                    $event['genres'] = $tag;
                }

            } else {
                if(!isset($event['genres'])) {
                    $event['genres'] = array();
                }
            }

            $genreEvents[] = $event;
        }

        return $genreEvents;
    }

    public function getGenresfromSoundCloud($genreEvents)
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