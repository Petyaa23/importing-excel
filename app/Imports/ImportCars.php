<?php

namespace App\Imports;

use App\Models\Car;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCars implements ToModel
{

    public function model(array $row): Car
    {
        return new Car([
            'name' => $row[0],
            'model' => $row[1],
            'color' => $row[2],
            'year' => $row[3],
            'price' => $row[4],
        ]);
    }
}
