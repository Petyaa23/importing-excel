<?php

namespace App\Imports;
use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportCars implements ToModel, WithValidation
{

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
            '0' => 'required',
            '1' => 'required',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
        ];
    }
}
