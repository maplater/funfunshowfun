<?php
/**
 * Created by PhpStorm.
 * User: maplater
 * Date: 11/16/2016
 * Time: 8:30 PM
 */

namespace App\Services;

use App\Repositories\ArtistRepository;


class ArtistService {

    protected $artistRepository;


    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;

    }


    public function getGenresforArtists($events)
    {
        return $this->artistRepository->getGenresforArtists($events);
    }

    public function getYoutubeLinksforArtists($events)
    {
        return $this->artistRepository->getYoutubeLinksforArtists($events);
    }
} 