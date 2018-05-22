<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Bank;
use App\City;
use App\Equipment;
use App\Family;
use App\Region;
use Illuminate\Http\Request;
use App\User;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function settings(){
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();
        $families = Family::all();
        $banks = Bank::select('mfo','name')->get();
        return view('user.user-settings')->withRegions($regions)->withCities($cities)->withBanks($banks)
            ->withActivities($activities)->withFamilies($families)->withUser($user);
    }
    public function realizations(){
        return view('user.realizations')->withFamilies(\App\Family::all());
    }
    public function exports(){
        return view('user.exports')->withFamilies(\App\Family::all());
    }
    public function productions(){
        return view('user.productions')->withEquipments( Equipment::orderBy('id', 'asc')->get());
    }

    public function updateForm(Request $request, $tab){
        $validator = Validator::make($request->all(), [
                'region_id' => $tab == 'main'? 'required|exists:regions,id' : '',
                'city_id' => $tab == 'main'? 'required|exists:cities,id' : '',
                'neighborhood' => $tab == 'main'? 'required|max:255' : '',
                'subject' => $tab == 'main' ? 'required|max:255' : '',
                'address' => $tab == 'main'? 'required|max:255' : '',
                'username' => $tab == 'main'? 'required|max:255' : '',
                'reg_date' => $tab == 'additional'? 'required' : '',
                'inn' => $tab == 'additional'? 'required|digits:9' : '',
                'mfo' => $tab == 'additional'? 'required|digits:5' : '',               
                'fullName' => $tab == 'additional'? 'required|max:255' : '',
                'labors' => $tab == 'additional'? 'required|numeric|min:0' : '',
                'bees_count' =>$tab == 'additional'? 'required|numeric|min:0' : '',
                'phone' => $tab == 'password'? 'required|max:19|min:12' : '',
                'email' => $tab == 'password'? 'nullable|email' : '',
                'password' => $tab == 'password'? 'required|min:6' : '',
                'families.*' =>$tab == 'activities'? 'exists:families,id' : '',                
                'activities.*' =>$tab == 'activities'? 'exists:activities,id' : '',
            ]);
        $user = Auth::user();
        $user->update($request->except('phone'));
        $user->phone = preg_replace('/\D/', '', $request->phone);
        if($tab == 'password' && $request->new_password == $request->new_password_confirm){
            $user->password = bcrypt($request->new_password);
        }
        $user->save();
        if($tab=='activities'){
            $user->activities()->sync($request->activities, true);
            $user->families()->sync($request->families, true);
        }
        return redirect()->back()->with('message',"Sizning o'zgartirishlaringiz qabul qilindi. tez orada o'zgartirishlaringiz admin tomonidan tasdiqlanadi");
    }
}
