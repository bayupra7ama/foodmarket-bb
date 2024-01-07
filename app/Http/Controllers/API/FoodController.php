<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Models\food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food as ModelsFood;

class FoodController extends Controller
{
    //filter data
    public function all(Request $request)
    {
        $id = $request->input('id');
        //limit tampilan makanan
        $limit = $request->input('limit');
        $name = $request->input('name');
        $types = $request->input('types');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        //pengambilan data berdasarkan id
        if ($id) {
            $food = food::find('$id');

            //jika makanan ada
            if ($food) {
                return ResponseFormatter::success(
                    $food,
                    'data berhasil di ambil'
                );
            }
            //jika tidak ade 
            else {
                return ResponseFOrmatter::error(
                    null,
                    'data produk tidak ada',
                    404
                );
            }
        }

        //untuk menampilkan data dengan queri

        $food = food::query();
        if ($name) {
            $food->where('name', 'like', '%' . $name . '%');
        }

        if ($types) {
            $food->where('types', 'like', '%' . $types . '%');
        }

        //berdasarkan harga
        if ($price_from) {
            $food->where('price', '>=', $price_from);
        }
        if ($price_to) {
            $food->where('price', '<=', $price_to);
        }

        if ($rate_from) {
            $food->where('rate', '>=', $rate_from);
        }
        if ($rate_to) {
            $food->where('rate', '<=', $price_to);
        }

        return ResponseFormatter::success(
            $food->paginate($limit),
            'data list berhasil di ambil'
        );
    }
}
