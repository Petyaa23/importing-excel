<?php

namespace App\Http\Controllers;

use App\Models\Car;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;


class DashboardController extends Controller
{
    public function index ()
    {

        $cars = Car::all();
        return view('dashboard.dashboard')->with(compact('cars'));

    }

    public function getCars(Request $request)
    {

        return response()->json(['cars' => $cars]);
    }



}
