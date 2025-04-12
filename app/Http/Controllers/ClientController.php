<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')->where('status', 1)->orderBy('id', 'desc');
        $categories = Category::query()->where('status', 1)->get();

        if ($request->has('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('loc_gia')) {
            switch ($request->loc_gia) {
                case 'duoi_500':
                    $products->where('price', '<', 500000);
                    break;
                case '500_1tr':
                    $products->whereBetween('price', [500000, 1000000]);
                    break;
                case '1tr_5tr':
                    $products->whereBetween('price', [1000000, 5000000]);
                    break;
                case '5tr_tro_len':
                    $products -> where('price', '>' , 5000000);
                    break;
            }
        }

        if ($request -> has('category')) {
            $products -> where('category_id', $request -> category);
        }

        $products = $products->paginate(8);
        return view('client.list', compact('products', 'categories'));
    }
    public function detail($id)
    {
        $product = Product::with('category')->find($id);
        $relatedProducts = Product::with('category')->where('category_id', $product->category_id) -> where('id','!=', $product-> id) ->orderBy('id', 'desc')->limit(5)->get();
        return view('client.detail', compact('product', 'relatedProducts'));
    }
}
