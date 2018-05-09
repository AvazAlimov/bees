<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Bank;
use App\City;
use App\Equipment;
use App\Family;
use App\Region;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function settings(){
        $regions = Region::all();
        $cities = City::all();
        $activities = Activity::all();
        $families = Family::all();
        $banks = Bank::select('mfo','name')->get();
        return view('user.user-settings')->withRegions($regions)->withCities($cities)->withBanks($banks)
            ->withActivities($activities)->withFamilies($families);
    }
    public function realizations(){
        return view('user.realizations')->withFamilies(\App\Family::all());
    }
    public function exports(){
        return view('user.exports')->withFamilies(\App\Family::all());
    }
    public function productions(){
        return view('user.productions')->withEquipments( Equipment::orderBy('id', 'asc')->get());
    }
}
