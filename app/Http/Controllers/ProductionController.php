<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Export;
use App\Production;
use Auth;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Validator;
class ProductionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

     public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'month' => 'required|integer|min:1|max:12',
            'equipments.*' => 'nullable|numeric|min:0',
            'year' => ['required',Rule::unique('productions')->where(function($query) use($request){
                $query->where('month',$request->month)->where('user_id',Auth::user()->id);
            })]
        ],[
            'unique'=>'Бу санага маълумот олдин киритилган',
        ]);
        if($validator->fails()){
             return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $production = new Production;
        $production->user_id = Auth::user()->id;
        $production->month = $request->month;
        $production->year = $request->year;

        $production->save();
        foreach ($request->equipments as $key => $value) {
        	if($value != null)
        		$production->equipments()->attach($key, ['volume'=>$value]);
        }

        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Кушилди');
    }
    public function update(Request $request, $id){
		$validator = Validator::make($request->all(),[
            'month' => 'required|integer|min:1|max:12',
            'equipments.*' => 'nullable|numeric|min:0',
            'year' => ['required',Rule::unique('productions')->ignore($id,'id')->where(function($query) use($request){
                $query->where('month',$request->month)->where('user_id',Auth::user()->id);
            })]
        ],['unique'=>'Бу санага маълумот олдин киритилган']);
        if($validator->fails()){
             return redirect()->back()
                        ->withErrors($validator, 'edit')->with('id', $id)
                        ->withInput();
        }
        $production = Auth::user()->productions()->findOrFail($id);
        $production->user_id = Auth::user()->id;
        $production->month = $request->month;
        $production->year = $request->year;

        if($production->state == -1)
            $production->state = -2;
        $production->save();

        $production->equipments()->detach();
        foreach ($request->equipments as $key => $value) {
            if($value != null)
                $production->equipments()->attach($key, ['volume'=>$value]);
        }
       
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Узгартирилди');   
    
    }
}
