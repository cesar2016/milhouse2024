<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
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
            'date_purchase'=> $row['date_purchase'],
            'category_id'=> $row['category_id'],
            'brand_product_id' => $row['brand_product_id'],
        ]);
    }
}
