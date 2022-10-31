<?php

namespace App\Http\Controllers;

use App\Imports\ImportCars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Car;

class DashboardController extends Controller
{


    public function index ()
    {
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        $session = Session::get('key');
        return view('dashboard.dashboard')->with(compact('cars','session'));
    }

    public function carsAdd(Request $request)
    {
        Excel::import(new ImportCars, $request->file('file')->store('files'));
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        return response()->json( [
            'message' => '',
            'status' => 'success',
            'cars' => $cars
        ]);
    }
}
