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
        return view('dashboard.dashboard')->with(compact('cars'));
    }

    public function getCars()
    {
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        return response()
            ->json([
                'cars'=> $cars]);
    }

    public function carsAdd(Request $request)
    {
        Excel::import(new ImportCars, $request->file('file')->store('files'));

        $session = Session::get('key');
        Session::forget('key');
        return response()->json( [
            'message' => $session,
            'status' => 'success',
        ]);
    }
}
