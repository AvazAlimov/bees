<?php

namespace App\Http\Controllers\Web;

use App\Bank;
use App\Family;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;
use App\Region;
use App\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class WebController extends Controller
{
    public function showForm($type = null)
    {
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();
        $banks = Bank::select('mfo','name')->get();
        $families = Family::all();
        
        return view('main')->withRegions($regions)->withCities($cities)
            ->withActivities($activities)->withBanks($banks)->withType($type)->withFamilies($families);
    }


    public function submitForm(Request $request, $type)
    {
            $validator = Validator::make($request->all(), [
                'region_id' => 'required|exists:regions,id',
                'city_id' => 'required|exists:cities,id',
                'neighborhood' => 'required|max:255',
                'subject' => $type < 4 ?  'required|max:255' : '',
                'reg_date' => $type < 4 ? 'required' : '',
                'inn' => $type < 4 ? 'required|digits:9' : '',
                'mfo' => $type < 4 ? 'required|digits:5' : '',
                'address' => 'required|max:255',
                'phone' => 'required|max:19|min:12',
                'email' => 'nullable|email',
                'families.*' =>'exists:families,id',
                'fullName' => 'required|max:255',
                'labors' => $type < 3 ? 'required|numeric|min:0' : '',
                'bees_count' =>'required|numeric|min:0',
                'activities.*' =>'exists:activities,id',
            ]);

        if ($validator->fails()) {
            return redirect()->route('web.show.form',$type)
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User($request->except('phone'));
        $user->phone = preg_replace('/\D/', '', $request->phone);
        $user->type = $type;
        $user->save();

        $user->activities()->sync($request->activities, false);
        $user->families()->sync($request->families, false);

        return redirect()->back()->with('message',"Sizning ro'yhatdan o'tish so'rovingiz qabul qilindi. Sizni qabul qilishganidan so'ng, telefon raqamingizga yoki pochtangizga login, parol yuboriladi");
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
        $user->update($request->all());
        if($tab=='activities'){
            $user->activities()->sync($request->activities, true);
            $user->families()->sync($request->families, true);
        }
        return redirect()->back()->with('message',"Sizning o'zgartirishlaringiz qabul qilindi. tez orada o'zgartirishlaringiz admin tomonidan tasdiqlanadi");
    }
}
