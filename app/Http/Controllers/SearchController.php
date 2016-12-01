<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use App\Services\SearchService;
use Carbon\Carbon;


class SearchController extends Controller
{
    public function receive(Request $input, SearchService $searchService)
    {
        $events = $searchService->search($input);
        $city = title_case($input['city']);
        $genre = title_case($input['genre']);
        $date = Carbon::parse($input['date'])->format('l M\\, jS Y');

        if(isset($events)){

            return view('events', compact('events','city','genre','date'));

        }else{

            Flash::error('Sorry, there were no results for that, please try again');

            return view('welcome');

        }

    }


}
