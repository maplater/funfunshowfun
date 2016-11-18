<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CityService;
use Laracasts\Flash\Flash;

class CityController extends Controller
{
    public function search(Request $input, CityService $cityService)
    {

        $cityList = $cityService->search($input['city']);

        if(isset($cityList)){

            return view('select', compact('cityList'));

        }else{

            Flash::error('Sorry, there were no results for that location, please try again');

            return view('welcome');

        }


    }
}
