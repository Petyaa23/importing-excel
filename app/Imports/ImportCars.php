<?php

namespace App\Imports;
use App\Models\Car;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCars implements ToModel, WithValidation
{
    public $failed = [];

    public function model(array $row)
    {
        return new Car (
            [
                'name' => $row[0],
                'model' => $row[1],
                'color' => $row[2],
                'year' => $row[3],
                'price' => $row[4],
            ]
        );
    }

    public function rules(): array
    {
        return [
            '0' => '',
            '1' => '',
            '2' => '',
            '4' => '',

            '3' => function($attribute, $value) {
                if (!$value) {
                    Session::put('key', 'This is a message!');
                }

            }
        ];
    }

}
//return [
//    'name' => '',
//    'model' => '',
//    'color' => '',
//
//    'year' => function($attribute, $value) {
//        if (!$value)
//            Session::flash('key', 'This is a message!');
//    },
//    'price' => '',
//];
