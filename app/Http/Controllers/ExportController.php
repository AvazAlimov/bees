<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Export;
use Auth;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Validator;

class ExportController extends Controller
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
            'annual_power' => 'required|integer',
            'shops_count' => 'required|numeric',
            'shops_address' => 'required|string',
            'packed_honey' => 'required|integer',
            'inside_quantity' => 'required|integer',
            'inside_price' => 'required|integer',
            'outside_quantity' => 'required|integer',
            'outside_price' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => ['required',Rule::unique('exports')->where(function($query) use($request){
                $query->where('month',$request->month)->where('user_id',Auth::user()->id);
            })]
        ],[ 'unique'=>'Бу санага маълумот олдин киритилган']
        );
        if($validator->fails()){
             return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $export = new Export;
        $export->annual_power = $request->annual_power;
        $export->shops_count = $request->shops_count;
        $export->shops_address = $request->shops_address;
        $export->packed_honey = $request->packed_honey;
        $export->inside_quantity = $request->inside_quantity;
        $export->inside_price = $request->inside_price;
        $export->outside_quantity = $request->outside_quantity;
        $export->outside_price = $request->outside_price;
        $export->user_id = Auth::user()->id;
        $export->month = $request->month;
        $export->year = $request->year;

        $export->save();
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
            'annual_power' => 'required|integer',
            'shops_count' => 'required|numeric',
            'shops_address' => 'required|string',
            'packed_honey' => 'required|integer',
            'inside_quantity' => 'required|integer',
            'inside_price' => 'required|integer',
            'outside_quantity' => 'required|integer',
            'outside_price' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => ['required',Rule::unique('exports')->ignore($id,'id')->where(function($query) use($request){
                $query->where('month',$request->month)->where('user_id',Auth::user()->id);
            })]
        ],['unique'=>'Бу санага маълумот олдин киритилган']);
        if($validator->fails()){
             return redirect()->back()
                        ->withErrors($validator, 'edit')->with('id', $id)
                        ->withInput();
        }
        $export = Auth::user()->exports()->findOrFail($id);
        $export->annual_power = $request->annual_power;
        $export->shops_count = $request->shops_count;
        $export->shops_address = $request->shops_address;
        $export->packed_honey = $request->packed_honey;
        $export->inside_quantity = $request->inside_quantity;
        $export->inside_price = $request->inside_price;
        $export->outside_quantity = $request->outside_quantity;
        $export->outside_price = $request->outside_price;

        if($export->state == -1)
            $export->state = -2;

        $export->save();
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
        $export = Auth::user()->exports()->where('id', $id);
        $export->delete();
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Учирилди');
    }
}
