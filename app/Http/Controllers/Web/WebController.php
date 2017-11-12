<?php

namespace App\Http\Controllers\Web;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;
use App\Region;
use App\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function showForm(){
        $regions = Region::all();
        $cities= City::all();
        $activities = Activity::all();

        return view('main')->withRegions($regions)->withCities($cities)->withActivities($activities);
    }


    public function submitForm(Request $request){

        $validator = Validator::make($request->all(),[
           'region_id' => 'required|exists:regions,id',
           'city_id' => 'required|exists:cities,id',
           'neighborhood' => 'required|max:255',
           'subject' => 'required|max:255',
           'reg_date' => 'required',
           'inn'=> 'required|max:9',
           'mfo' => 'required|max:5',
           'address' => 'required|max:255',
           'phone' => 'required|max:13',
           'email'=> 'required|email',
           'fullName' => 'required|max:255',
           'labors' => 'required|numeric|min:0',
       ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User($request->all());
        $user->type = 0;
        $user->save();

        $user->activities()->sync($request->activities, false);

        return redirect()->back();
    }
}
