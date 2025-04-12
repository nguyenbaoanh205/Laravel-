<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = DB::table('products')
        // ->join('categories', 'products.category_id', '=', 'categories.id')
        // ->select('products.*', 'categories.name as category_name')
        // ->orderBy('products.id', 'desc');

        // if ($request->has('search')) {
        //     $query->where('products.name', 'like', '%' . $request->search . '%');
        // }

        // $products = $query->paginate(6);
        // return view('products.index', compact('products'));

        $query = Product::with('category');
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->orderBy('id', 'desc')->paginate(6);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = DB::table('categories')->get();
        // return view('products.create', compact('categories'));

        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $categories = DB::table('categories')->where('id', $request->category_id)->first();
        // if ($categories->status == 0) {
        //     return redirect()->back()->with('error', 'Danh mục đã tạm dừng, vui lòng chọn danh mục khác');
        // }

        // $imgPath = $request->hasFile('image') ? 'storage/' . $request->file('image')->store('products', 'public') : null;
        // DB::table('products')->insert([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'image' => $imgPath,
        //     'category_id' => $request->category_id,
        //     'status' => (bool)$request->status,
        //     'description' => $request->description,
        // ]);
        // return redirect()->route('products.index')->with('success', 'Thêm thành công');

        $categories = Category::find($request->category_id);
        if ($categories->status == 0) {
            return redirect()->back()->with('error', 'Danh muc da tam dung, vui long chon danh muc khac');
        }

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = 'storage/' . $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = null;
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Them thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // $product = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'categories.name as category_name')->where('products.id', $id)->first();
        // return view('products.show', compact('product'));

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $product = DB::table('products')->where('id', $id)->first();
        // $categories = DB::table('categories')->get();
        // return view('products.edit', compact('product', 'categories'));

        $product = Product::find($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // $categories = DB::table('categories')->where('id', $request->category_id)->first();
        // if ($categories->status == 0) {
        //     return redirect()->back()->with('error', 'Danh mục đã tạm dừng, vui lòng chọn danh mục khác');
        // }
        // // tìm sản phẩm 
        // $product = DB::table('products')->where('id', $id)->first();
        // if ($request->hasFile('image')) {
        //     $imgPath = 'storage/' . $request->file('image')->store('products', 'public');
        //     unlink(public_path($product->image));
        // } else {
        //     $imgPath = $product->image;
        // }
        // // cập nhật thông tin sản phẩm
        // DB::table('products')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'quantity' => $request->quantity,
        //     'image' => $imgPath,
        //     'category_id' => $request->category_id,
        //     'status' => (bool)$request->status,
        //     'description' => $request->description,
        // ]);
        // return redirect()->route('products.index')->with('success', 'Cập nhật thành công');

        $categories = Category::find($request->category_id);
        if ($categories->status == 0) {
            return redirect()->back()->with('error', 'Danh muc da tam dung, vui long chon danh muc khac');
        }

        // $product = Product::find($product->id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = 'storage/' . $request->file('image')->store('products', 'public');
            unlink(public_path($product->image));    
        }else{
            $data['image'] = $product->image;
        }

        $product->update($data);    
        return redirect()->route('products.index')->with('success', 'Cap nhat thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // DB::table('products')->where('id', $id)->delete();
        // return redirect()->route('products.index')->with('success', 'Xóa thành công');

        $product -> delete();
        return redirect()->route('products.index')->with('success', 'Xoa thanh cong');
    }
}
