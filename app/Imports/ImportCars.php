<?php

//namespace App\Imports;
//use App\Models\Car;
//use Maatwebsite\Excel\Concerns\ToModel;
namespace App\Imports;

use App\Models\Car;


use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;

//class ImportCars implements ToModel
//{
//
//    public function model(array $row): Car
//    {
//        return new Car([
//            'name' => $row[0],
//            'model' => $row[1],
//            'color' => $row[2],
//            'year' => $row[3],
//            'price' => $row[4],
//        ]);
//    }
//}
class ImportCars implements ToModel
{

    public function model(array $row): string | Car
    {
        $arr = [
            'name' => $row[0],
            'model' => $row[1],
            'color' => $row[2],
            'year' => $row[3],
            'price' => $row[4],
        ];

        $validator = Validator::make($arr, [

            'name' => 'required',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required',
            'price' => 'required',

        ]);
        $message = $validator->messages()->first();
        if (!$validator->fails()) {
            return new Car($arr);
        }
        return $message;
    }
}
