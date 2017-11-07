<?php

namespace App\Http\Controllers\Web;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;
use App\Region;
use App\City;

class WebController extends Controller
{
    public function showForm(){
        $regions = Region::all();
        $cities= City::all();
        $activities = Activity::all();

        return view('welcome')->withRegions($regions)->withCities($cities)->withActivities($activities);
    }
    public function submitForm(Request $request){
       $request->validate([
           'region_id' => 'required|exists:regions,id',
           'city_id' => 'required|exists:cities,id',
           'neighborhood' => 'required',
           'subject' => 'required',
           'reg_date' => 'required',
           'inn'=> 'required',
           'mfo' => 'required',
           'address' => 'required',
           'phone' => 'required',
           'email'=> 'required|email',
           'fullName' => 'required',
           'labors' => 'required|numeric|min:0|max:0',
       ]);
        $user = new User($request);

       $user->activities()->sync($request->tags, false);

    }
}
