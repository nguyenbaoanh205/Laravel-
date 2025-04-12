<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController1 extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('category') ;
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->orderBy('id', 'desc')->paginate(6);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        // $categories = Category::all();
        $categories = Category::where('status', 1)->get();
        return view('admin.products.create', compact('product', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = 'storage/' . $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = null;
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = 'storage/' . $request->file('image')->store('products', 'public');
        } else {
            $data['image'] = $product->image;
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Thêm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xoa thanh cong');
    }
    public function trash()
    {
        $trashedProducts = Product::onlyTrashed()->with('category')->get();
        return view('admin.products.trash', compact('trashedProducts'));
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('products.trash')->with('success', 'Khôi phục sản phẩm thành công');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->route('products.trash')->with('success', 'Xóa vĩnh viễn sản phẩm thành công');
    }
}
