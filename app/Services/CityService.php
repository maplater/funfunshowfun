<?php

namespace App\Services;

use App\Repositories\CityRepository;

class CityService
{

    protected $cityRepository;


    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;

    }

    public function search($cityquery)
    {
        return $this->cityRepository->search($cityquery);
    }

    public function getCity($cityquery)
    {
        $citylist = $this->search($cityquery);

        if(isset($citylist)){

            $city['name'] = $citylist[0]['name'];
            $city['id'] = $citylist[0]['id'];

        }else{
            $city = NULL;
        }


        return $city;
    }

    public function getEventsbyCity($city)
    {
        return $this->cityRepository->getEventsbyCity($city);

    }


}