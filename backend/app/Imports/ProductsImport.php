<?php

namespace App\Imports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductsImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'code' => $row['code'],
            'name'=> $row['name'],
            'stock'=> $row['stock'],
            'price_purchase'=> $row['price_purchase'],
            'price_sale'=> $row['price_sale'],
            'status'=> $row['status'],
            'date_purchase'=> Carbon::parse($row['date_purchase'])->format('Y-m-d H:i:s'), //$row['date_purchase'],
            'category_id'=> $row['category_id'],
            'brand_product_id' => $row['brand_product_id'],
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
