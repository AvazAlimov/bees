<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realization;
use App\User;

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
    public function store(Request $request, $user_id)
    {
        $request->validate([
            'family_count' => 'required|numeric',
            'annual_prog' => 'required|numeric',
            'produced_honey' => 'required|numeric',
            'reserve' => 'required|numeric',
            'realized_quantity' => 'required|numeric',
            'realized_price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'stock_price' => 'required|numeric',
            'user_id' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer'
        ]);

        $realization = new Realization;
        $realization->family_count = $request->family_count;
        $realization->annual_prog = $request->annual_prog;
        $realization->produced_honey = $request->produced_honey;
        $realization->reserve = $request->reserve;
        $realization->realized_quantity = $request->realized_quantity;
        $realization->realized_price = $request->realized_price;
        $realization->stock_quantity = $request->stock_quantity;
        $realization->stock_price = $request->stock_price;
        $realization->user_id = $user_id;
        $realization->month = $request->month;
        $realization->year = $request->year;

        $realization->save();
        $realization->family()->sync($request->family_type, false);
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
        $request->validate([
            'family_count' => 'required|numeric',
            'annual_prog' => 'required|numeric',
            'produced_honey' => 'required|numeric',
            'reserve' => 'required|numeric',
            'realized_quantity' => 'required|numeric',
            'realized_price' => 'required|numeric',
            'stock_quantity' => 'required|numeric',
            'stock_price' => 'required|numeric',
            'user_id' => 'required|integer',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer'
        ]);
        $realization = Auth::user()->realizations()->where('id', $id);
        $realization->family_count = $request->family_count;
        $realization->annual_prog = $request->annual_prog;
        $realization->produced_honey = $request->produced_honey;
        $realization->reserve = $request->reserve;
        $realization->realized_quantity = $request->realized_quantity;
        $realization->realized_price = $request->realized_price;
        $realization->stock_quantity = $request->stock_quantity;
        $realization->stock_price = $request->stock_price;

        $realization->save();
        $realization->family()->sync($request->family_type, true);
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Узгартирилди');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $month, $year)
    {
        $realization = Realization::all()->where('user_id', $id)->where('month', $month)->where('year', $year);
        $realization->family()->detach();
        $realization->delete();
        return redirect()->back()->with('message', 'Хисобот Муваффакиятли Учирилди');
    }
}
