<?php

namespace App\Http\Controllers\Leader;

use App\Bank;
use App\Family;
use App\Notifications\UserConfirmationNotification;
use App\User;
use App\Region;
use App\City;
use App\Activity;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Kozz\Laravel\Facades\Guzzle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Req;
use GuzzleHttp\Psr7\Response;
class LeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:leader');
    }

    public function requestList()
    {
        $users = Auth::user();
        $waiting_users = $users->waitingUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted = $users->acceptedUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'accepted');
        $notAccepted = $users->notAcceptedUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');

        return view('leader.index')->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted);
    }
    public function acceptUser(Request $request, $id)
    {
        $user = $request->user()->users()->findOrFail($id);
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

        return redirect()->route('leader.index')->with('message', 'Accepted successfully');
    }
    public function refuseUser(Request $request, $id)
    {
        $user = $request->user()->users()->findOrFail($id);
        $user->update(['state' => -1]);
        return redirect()->route('leader.index')->with('message', 'Refused successfully');
    }
    public function destroyUser(Request $request, $id)
    {
        $user = $request->user()->users()->findOrFail($id);
        $user->delete();
        return redirect()->route('leader.index')->with('message', 'Deleted successfully');
    }
    public function retrieveUser(Request $request, $id){
        $user = $request->user()->users()->findOrFail($id);
        $user->update(['state'=>0]);
        return redirect()->route('leader.index')->with('message', 'Retrieved successfully');
    }
    public function search(Request $request)
    {
        $users = Auth::user();
        $accepted_users = $users->acceptedUsers();
        if ($request->search != null || $request->search == "") {
            if (substr($request->search, 0, 1) == "#") {
                $accepted_users = $accepted_users->where('id', ltrim($request->search, '#'));
            } else {
                $accepted_users = $accepted_users->where(function ($query) use ($request) {
                    $query
                        ->whereHas('activities', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhereHas('region', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhereHas('city', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhere('username', 'LIKE', "%$request->search%")
                        ->orWhere('email', 'LIKE', "%$request->search%")
                        ->orWhere('neighborhood', 'LIKE', "%$request->search%")
                        ->orWhere('subject', 'LIKE', "%$request->search%")
                        ->orWhere('inn', 'LIKE', "%$request->search%")
                        ->orWhere('bank_name', 'LIKE', "%$request->search%")
                        ->orWhere('mfo', 'LIKE', "%$request->search%")
                        ->orWhere('address', 'LIKE', "%$request->search%")
                        ->orWhere('phone', 'LIKE', "%$request->search%")
                        ->orWhere('fullName', 'LIKE', "%$request->search%")
                        ->orWhere('labors', 'LIKE', "%$request->search%");
                });
            }
        }
        if ($request->filter == "name") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users
                    ->orderBy('fullName', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);
            } else {
                $accepted_users = $accepted_users
                    ->orderBy('fullName', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->filter == "bank_name") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users
                    ->orderBy('bank_name', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);
            } else {
                $accepted_users = $accepted_users
                    ->orderBy('bank_name', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->filter == "id") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users->orderBy('id', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);

            } else {
                $accepted_users = $accepted_users->orderBy('id', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->type) {
            if($request->type < 3)
                $accepted_users = $accepted_users->where('type','<', $request->type);
            else
                $accepted_users = $accepted_users->where('type', $request->type);
        }

        $accepted_users = $accepted_users->paginate(10, ['*'], 'accepted');
        $waiting_users = $users->waitingUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $notAccepted = $users->notAcceptedUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');

        return view('leader.index')->withWaiting($waiting_users)->withAccepted($accepted_users)->withNotAccepted($notAccepted);

    }
    public function searchNotAccepted(Request $request)
    {
        $users = Auth::user();
        $accepted_users = $users->notAcceptedUsers();
        if ($request->search != null || $request->search == "") {
            if (substr($request->search, 0, 1) == "#") {
                $accepted_users = $accepted_users->where('id', ltrim($request->search, '#'));
            } else {
                $accepted_users = $accepted_users->where(function ($query) use ($request) {
                    $query
                        ->whereHas('activities', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhereHas('region', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhereHas('city', function ($query) use ($request) {
                            $query->where('name', 'LIKE', "%$request->search%");
                        })
                        ->orWhere('username', 'LIKE', "%$request->search%")
                        ->orWhere('email', 'LIKE', "%$request->search%")
                        ->orWhere('neighborhood', 'LIKE', "%$request->search%")
                        ->orWhere('subject', 'LIKE', "%$request->search%")
                        ->orWhere('inn', 'LIKE', "%$request->search%")
                        ->orWhere('bank_name', 'LIKE', "%$request->search%")
                        ->orWhere('mfo', 'LIKE', "%$request->search%")
                        ->orWhere('address', 'LIKE', "%$request->search%")
                        ->orWhere('phone', 'LIKE', "%$request->search%")
                        ->orWhere('fullName', 'LIKE', "%$request->search%")
                        ->orWhere('labors', 'LIKE', "%$request->search%");
                });
            }
        }
        if ($request->filter == "name") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users
                    ->orderBy('fullName', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);
            } else {
                $accepted_users = $accepted_users
                    ->orderBy('fullName', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->filter == "bank_name") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users
                    ->orderBy('bank_name', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);
            } else {
                $accepted_users = $accepted_users
                    ->orderBy('bank_name', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->filter == "id") {
            /** @noinspection PhpUndefinedMethodInspection */
            if (Session::get('sort')) {
                $accepted_users = $accepted_users->orderBy('id', 'desc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', false);

            } else {
                $accepted_users = $accepted_users->orderBy('id', 'asc');
                /** @noinspection PhpUndefinedMethodInspection */
                Session::put('sort', true);
            }
        }
        if ($request->type) {
            if($request->type < 3)
                $accepted_users = $accepted_users->where('type','<', $request->type);
            else
                $accepted_users = $accepted_users->where('type', $request->type);
        }

        $notAccepted = $accepted_users->paginate(10, ['*'], 'accepted');
        $waiting_users = $users->waitingUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted_users = $users->acceptedUsers()->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');
        return view('leader.index')->withWaiting($waiting_users)->withAccepted($accepted_users)->withNotAccepted($notAccepted);

    }
    public function editUser($id){
        $user = Auth::user()->users()->findOrFail($id);
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();
        $families = Family::all();
        $banks = Bank::all();

        return view('user.user-update')->withUser($user)->withRegions($regions)->withCities($cities)
            ->withActivities($activities)->withFamilies($families)->withBanks($banks);
    }
    public function updateUser(Request $request, $id){
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
            'email' => 'nullable|email',
            'fullName' => 'required|max:255',
            'labors' => $request->type < 4 ? 'required|numeric|min:0' : '',
            'activities.*' =>'exists:activities,id',
            'families.*' =>'exists:families,id',
        ]);
        $request->phone = preg_replace('/\D/', '', $request->phone);
        $user = Auth::user()->users()->findOrFail($id);
        $user->update($request->all());
        $user->activities()->sync($request->activities, true);
        $user->families()->sync($request->families, true);
        return redirect()->route('leader.index')->with('message','User updated successfully');
    }
}
