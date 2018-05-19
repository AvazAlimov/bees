<?php

namespace App\Http\Controllers\Admin;

use App\Export;
use App\Production;
use App\Realization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRequisitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function productions(){

        return view('admin.requisition.production')->withEquipments( Equipment::orderBy('id', 'asc')->get());
    }
    public function exports(){
        return view('admin.requisition.export');
    }
    public function realizations(){
        return view('admin.requisition.realization');
    }
    public function productionAccept(Request $request,$id){
        $production = Production::findOrFail($id);
        $production->state = 1;
        $production->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }
    public function exportAccept(Request $request,$id){
        $export = Export::findOrFail($id);
        $export->state = 1;
        $export->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }
    public function realizationAccept(Request $request,$id){
        $realization = Realization::findOrFail($id);
        $realization->state = 1;
        $realization->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинди");
    }

    public function productionDeny(Request $request,$id){
        $production = Production::findOrFail($id);
        $production->state = -1;
        $production->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
    public function exportDeny(Request $request,$id){
        $export = Export::findOrFail($id);
        $export->state = -1;
        $export->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
    public function realizationDeny(Request $request,$id){
        $realization = Realization::findOrFail($id);
        $realization->state = -1;
        $realization->save();
        return redirect()->back()->with('message',"Маълумот қабул қилинмади");
    }
}
