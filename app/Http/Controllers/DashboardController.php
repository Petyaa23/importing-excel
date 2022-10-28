<?php

namespace App\Http\Controllers;

use App\Imports\ImportCars;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Car;

class DashboardController extends Controller
{

    /**
     * @return Factory|View|Application
     */
    public function index (): Factory|View|Application
    {
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.dashboard')->with(compact('cars'));
    }

    public function getCars(Request $request): RedirectResponse
    {
        Excel::import(new ImportCars, $request->file('file')->store('files'));
        return redirect()->back();
    }
}
