<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportingExcelRequest;
use App\Imports\ImportCars;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Car;

class DashboardController extends Controller
{
    /**
     * @return Factory|View|Application
     */

    public function index(): Factory|View|Application
    {
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        return view('dashboard.dashboard')->with(compact('cars'));
    }

    /**
     * @return JsonResponse
     */
    public function getCars(): JsonResponse
    {
        $cars = Car::orderBy('id', 'DESC')->paginate(5);
        return response()
            ->json([
                'cars' => $cars]);
    }

    /**
     * @param ImportingExcelRequest $request
     * @return JsonResponse
     */
    public function carsAdd(ImportingExcelRequest $request): JsonResponse
    {
        $import = new ImportCars;
        Excel::import($import, $request->file('file')->store('files'));
        $session = Session::get('error');
        Session::forget('error');
        return response()->json([
            'message' => $session,
            'status' => 'success',
        ]);
    }
}
