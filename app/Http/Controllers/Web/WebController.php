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
    public function showForm($type = null)
    {
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();

        return view('main')->withRegions($regions)->withCities($cities)->withActivities($activities);
    }


    public function submitForm(Request $request, $type)
    {
        if($type == 1) {
            $validator = Validator::make($request->all(), [
                'region_id' => 'required|exists:regions,id',
                'city_id' => 'required|exists:cities,id',
                'neighborhood' => 'required|max:255',
                'subject' => 'required|max:255',
                'reg_date' => 'required',
                'inn' => 'required|digits:9',
                'bank_name' => 'required',
                'mfo' => 'required|digits:5',
                'address' => 'required|max:255',
                'phone' => 'required|max:13|min:12',
                'email' => 'required|email',
                'fullName' => 'required|max:255',
                'labors' => 'required|numeric|min:0',
                'activities.*' =>'exists:activities,id'
            ]);
        }
        if($type == 2){
            $validator = Validator::make($request->all(), [
                'region_id' => 'required|exists:regions,id',
                'city_id' => 'required|exists:cities,id',
                'neighborhood' => 'required|max:255',
                'subject' => 'required|max:255',
                'reg_date' => 'required',
                'inn' => 'required|digits:9',
                'bank_name' => 'required',
                'mfo' => 'required|digits:5',
                'address' => 'required|max:255',
                'phone' => 'required|max:13|min:12',
                'email' => 'required|email',
                'fullName' => 'required|max:255',
                'labors' => 'required|numeric|min:0',
                'activities.*' =>'exists:activities,id'
            ]);
        }
        if($type == 3){
            $validator = Validator::make($request->all(), [
                'region_id' => 'required|exists:regions,id',
                'city_id' => 'required|exists:cities,id',
                'neighborhood' => 'required|max:255',
                'subject' => 'required|max:255',
                'reg_date' => 'required',
                'inn' => 'required|digits:9',
                'bank_name' => 'required',
                'mfo' => 'required|digits:5',
                'address' => 'required|max:255',
                'phone' => 'required|max:13|min:12',
                'email' => 'required|email',
                'fullName' => 'required|max:255',
                'activities.*' =>'exists:activities,id'
            ]);
        }
        if($type == 4){
            $validator = Validator::make($request->all(), [
                'region_id' => 'required|exists:regions,id',
                'city_id' => 'required|exists:cities,id',
                'neighborhood' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|max:13|min:12',
                'email' => 'required|email',
                'fullName' => 'required|max:255',
                'activities.*' =>'exists:activities,id'
            ]);
        }

        if ($validator->fails()) {
            $type ='#user'.$type;
            return redirect()->route('web.show.form',$type)
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User($request->all());
        $user->type = $type;
        $user->save();

        $user->activities()->sync($request->activities, false);

        return redirect()->back()->with('message',"Sizning ro'yhatdan o'tish so'rovingiz qabul qilindi. Sizni qabul qilishganidan so'ng, telefon raqamingizga yoki pochtangizga login, parol yuboriladi");
    }
}
