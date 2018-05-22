<?php

namespace App\Http\Controllers\Leader;
use App\Equipment;
use App\User;
use App\Export;
use App\Production;
use Auth;
use App\Realization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaderRequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:leader');
    }

    public function productions(){
     
        $users = Auth::user();
        $waiting_users = $users->waitingUsers()->count();
        $accepted = $users->acceptedUsers()->count();
        $notAccepted = $users->notAcceptedUsers()->count();
        return view('leader.requisition.production')->withEquipments(Equipment::orderBy('id', 'asc')->get())
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted);
    }
    public function exports(){
       	$users = Auth::user();
        $waiting_users = $users->waitingUsers()->count();
        $accepted = $users->acceptedUsers()->count();
        $notAccepted = $users->notAcceptedUsers()->count();
        return view('leader.requisition.export')
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted);
    }
    public function realizations(){
       	$users = Auth::user();
        $waiting_users = $users->waitingUsers()->count();
        $accepted = $users->acceptedUsers()->count();
        $notAccepted = $users->notAcceptedUsers()->count();
        return view('leader.requisition.realization')
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted);
    }

    public function productionAccept(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $production = Production::whereIn('user_id', $users)->findOrFail($id);
        dd($production);
        $production->state = 1;
        $production->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }
    public function exportAccept(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $export = Export::whereIn('user_id', $users)->findOrFail($id);
        $export->state = 1;
        $export->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }
    public function realizationAccept(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $realization = Realization::whereIn('user_id', $users)->findOrFail($id);
        $realization->state = 1;
        $realization->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }

    public function productionDeny(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $production = Production::whereIn('user_id', $users)->findOrFail($id);
        $production->state = -1;
        $production->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
    public function exportDeny(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $export = Export::whereIn('user_id', $users)->findOrFail($id);
        $export->state = -1;
        $export->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
    public function realizationDeny(Request $request,$id){
        $users = Auth::user()->acceptedUsers->pluck('id');
        $realization = Realization::whereIn('user_id', $users)->findOrFail($id);
        $realization->state = -1;
        $realization->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
}
