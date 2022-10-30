<?php

namespace App\Imports;
use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCars implements ToModel, WithValidation
{

    public function rules(): array
    {
        return [

            '1' => 'require',
            '2' => 'require',
            '4' => 'require',


//            '3' => function($attribute, $value, $onFailure) {
//                if (! isset($value))
//
//                    $onFailure('Name is not Patrick Brouwers');


//            }

        ];
    }

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

}
