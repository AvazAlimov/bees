<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realization;
use App\User;
use Illuminate\Validation\Rule;

use Auth;
use Illuminate\Support\Facades\Validator;

class RealizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }

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
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'family_count' => 'required|numeric|min:0',
            'annual_prog' => 'required|numeric|min:0',
            'produced_honey' => 'required|numeric|min:0',
            'reserve' => 'required|numeric|min:0',
            'realized_quantity' => 'required|numeric|min:0',
            'realized_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'stock_price' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => ['required',Rule::unique('realizations')->where(function($query) use($request){
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
        $realization = new Realization;
        $realization->family_count = $request->family_count;
        $realization->annual_prog = $request->annual_prog;
        $realization->produced_honey = $request->produced_honey;
        $realization->reserve = $request->reserve;
        $realization->realized_quantity = $request->realized_quantity;
        $realization->realized_price = $request->realized_price;
        $realization->stock_quantity = $request->stock_quantity;
        $realization->stock_price = $request->stock_price;
        $realization->user_id = Auth::user()->id;
        $realization->month = $request->month;
        $realization->year = $request->year;

        $realization->save();
        $realization->families()->sync($request->honey_types, false);
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Кушилди');
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
        //
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
        $validator = Validator::make($request->all(),[
            'family_count' => 'required|numeric|min:0',
            'annual_prog' => 'required|numeric|min:0',
            'produced_honey' => 'required|numeric|min:0',
            'reserve' => 'required|numeric|min:0',
            'realized_quantity' => 'required|numeric|min:0',
            'realized_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'stock_price' => 'required|numeric|min:0',
            'month' => 'required|integer|min:1|max:12',
            'year' => ['required',Rule::unique('realizations')->ignore($id,'id')->where(function($query) use($request){
                $query->where('month',$request->month)->where('user_id',Auth::user()->id);
            })]
        ],[
            'unique'=>'Бу санага маълумот олдин киритилган',
        ]);
        if($validator->fails()){
             return redirect()->back()
                        ->withErrors($validator, 'edit')->with('id', $id)
                        ->withInput();
        }

        $realization = Auth::user()->realizations()->findOrFail($id);
        $realization->year = $request->year;
        $realization->month = $request->month;
        $realization->family_count = $request->family_count;
        $realization->annual_prog = $request->annual_prog;
        $realization->produced_honey = $request->produced_honey;
        $realization->reserve = $request->reserve;
        $realization->realized_quantity = $request->realized_quantity;
        $realization->realized_price = $request->realized_price;
        $realization->stock_quantity = $request->stock_quantity;
        $realization->stock_price = $request->stock_price;

        if($realization->state == -1)
            $realization->state = -2;

        $realization->save();
        $realization->families()->sync($request->family_type, true);
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Узгартирилди');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $realization = Auth::user()->realizations()->where('id', $id);
        $realization->family()->detach();
        $realization->delete();
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Учирилди');
    }
}
