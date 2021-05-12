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
            'deskripsi' => $row['deskripsi'],
            'price' => $row['price'],
            'images' => $row['image'],
            'stok' => '20',
            'status' => 'publish',
            'user_id' => Auth::user()->id,
        ]);
    }
}
