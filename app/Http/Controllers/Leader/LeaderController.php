<?php

namespace App\Http\Controllers\Leader;

use App\Notifications\UserConfirmationNotification;
use App\User;
use App\Region;
use App\City;
use App\Activity;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        $password = 'password';
        $user->update(['username' => 'U' . sprintf("%07d", $user->id), 'password' => bcrypt($password), 'state' => 1]);
        $data = ['username' => $user->username, 'password' => $password, 'name' => $user->fullName, 'url' => '/login'];
        $user->notify(new UserConfirmationNotification($data));
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

        return view('user.user-update')->withUser($user)->withRegions($regions)->withCities($cities)->withActivities($activities);
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
            'phone' => 'required|max:13|min:12',
            'email' => 'required|email',
            'fullName' => 'required|max:255',
            'labors' => $request->type < 4 ? 'required|numeric|min:0' : '',
            'activities.*' =>'exists:activities,id',
        ]);

        $user = Auth::user()->users()->findOrFail($id);
        $user->update($request->all());
        $user->activities()->sync($request->activities, true);
        return redirect()->route('leader.index')->with('message','User updated successfully');
    }
}
