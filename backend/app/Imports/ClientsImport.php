<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([

            'name' => $row['name'],
            'lastname' => $row['lastname'],
            'dni' => $row['dni'],
            'address' => $row['address'],
            'city' => $row['city'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'status' => $row['status']

        ]);
    }

    public function batchSize(): int
    {
        return 10000;
    }

    public function chunkSize(): int
    {
        return 10000;
    }
}
