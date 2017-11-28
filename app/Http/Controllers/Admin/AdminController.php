<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\City;
use App\Family;
use App\Leader;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.index')
            ->withRegions(Region::all())
            ->withLeaders(Leader::all())
            ->withActivities(Activity::all())
            ->withFamilies(Family::all());

    }
}
