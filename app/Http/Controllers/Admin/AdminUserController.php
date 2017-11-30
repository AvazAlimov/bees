<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Bank;
use App\City;
use App\Family;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use App\User;
class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $password = str_random(8);
        $user->update(['username' => 'U' . sprintf("%07d", $user->id), 'password' => bcrypt($password), 'state' => 1]);
        $data = ['username' => $user->username, 'password' => $password, 'name' => $user->fullName, 'url' => '/login'];

        $client = new Client();
        $headers = ['Content-Type'=>'text/xml','charset'=>'UTF-8'];
        $content = '
        <bulk-request login="'.config('aloqa.login').'" password="'.config('aloqa.password').'" ref-id="1" delivery-notification-requested="true" version="1.0">
        <message id="1" msisdn="'.$user->phone.'" validity-period="3" priority="1">
        <content type="text/plain">Siz royhatdan o\'tdingiz
Login: '.$data['username'].'
Parol: '. $data['password'].'
        </content>
        </message>
        </bulk-request>';
        $request = new Req('POST', 'http://91.204.239.42:8081/re-smsbroker', $headers, $content);
        $response = $client->send($request);
        $body = $response->getBody();
        echo $body;
        // Cast to a string: { ... }
        $body->seek(0);
        // Rewind the body
        $body->read(1024);
        // Read bytes of the body
//        $user->notify(new UserConfirmationNotification($data));

        return redirect()->route('admin.index')->with('message', 'Accepted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();
        $families = Family::all();
        $banks = Bank::all();

        return view('user.admin-user-update')->withUser($user)->withRegions($regions)->withCities($cities)
            ->withActivities($activities)->withFamilies($families)->withBanks($banks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'region_id' => 'required|exists:regions,id',
            'city_id' => 'required|exists:cities,id',
            'neighborhood' => 'required|max:255',
            'subject' => $request->type < 4 ?  'required|max:255' : '',
            'reg_date' => $request->type < 4 ? 'required' : '',
            'inn' => $request->type < 4 ? 'required|digits:9' : '',
            'bank_name' => $request->type < 4 ?  'required' : '',
            'mfo' => $request->type < 4 ? 'required|digits:5' : '',
            'address' => 'required|max:255',
            'phone' => 'required|max:19|min:12',
            'email' => 'required|email',
            'fullName' => 'required|max:255',
            'labors' => $request->type < 4 ? 'required|numeric|min:0' : '',
            'bees_count' => 'required|numeric|min:0',
            'activities.*' =>'exists:activities,id',
            'families.*' =>'exists:families,id',
        ]);
        $request->phone = preg_replace('/\D/', '', $request->phone);
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->activities()->sync($request->activities, true);
        $user->families()->sync($request->families, true);
        return redirect()->route('admin.index')->with('message','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.index')->with('message', 'Deleted successfully');
    }
    public function retrieve(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update(['state'=>0]);
        return redirect()->route('admin.index')->with('message', 'Retrieved successfully');
    }
    public function refuse(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['state' => -1]);
        return redirect()->route('admin.index')->with('message', 'Refused successfully');
    }
}
