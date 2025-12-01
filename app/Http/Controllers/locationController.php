<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('region')->orderBy('province')->get();
        return view('location.location', compact('locations'));
    }
}