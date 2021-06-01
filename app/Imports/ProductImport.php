<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Product([
            'nama_product' => $row['nama_product'],
            'deskripsi' => $row['description'],
            'price' => $row['price'],
            'images' => $row['image'],
            'stok' => $row['stock'],
            'status' => 'publish',
            'user_id' => Auth::user()->id,
        ]);
    }
}
