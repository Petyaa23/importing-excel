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
        $message = function($attribute, $value) {
            if (!$value) {
                if (Session::has('error')) {
                    $error = Session::get('error');
                    $error++;
                    Session::put('error', $error);
                } else {
                    Session::put('error', 1);
                }
            }
        };

        return [
            '0' => $message,
            '1' => $message,
            '2' => $message,
            '3' => $message,
            '4' => $message,
        ];
    }

}

