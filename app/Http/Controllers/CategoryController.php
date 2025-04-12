<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // query builder
        // $query = DB::table('categories')->orderBy('id', 'desc');

        // if ($request->has('search')) {
        //     $query->where('name', 'like', '%' . $request->search . '%');
        // }

        // $categories = $query->paginate(5); // sang bên boot của provides
        // return view('categories.index', compact('categories'));

        // eloquent
        $query = Category::query() ; // Category::all() : lấy theo id về sau sẽ bị ảnh hưởng
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->orderBy('id', 'desc')->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // query builder
        // DB::table('categories')->insert([
        //     'name' => $request->name,
        //     'status' => (bool)$request->status, // ép kiểu
        // ]);
        // return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');

        // eloquent
        // Category::created([
        //     'name' => $request->name,
        //     'status' => (bool)$request->status,
        // ]);
        Category::create($request -> validated());
        return redirect()->route('categories.index')->with('success', 'Them danh muc thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // query builder
        // $category = DB::table('categories')->where('id', $id)->first();
        // return view('categories.show', compact('category'));

        // eloquent
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // query builder
        // // lấy dữ liệu để chỉnh sửa
        // $category = DB::table('categories')->where('id', $id)->first();
        // // đẩy dữ liệu chỉnh sửa lên form
        // return view('categories.edit', compact('category'));
        // // có route sẽ trả về controller, kh có route trả về view

        // eloquent
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // query builder
        // DB::table('categories')->where('id', $id)->update([
        //     'name' => $request->name,
        //     'status' => (bool)$request->status,
        // ]);
        // return redirect()->route('categories.index')->with('success', 'Cập nhật thành công');

        // eloquent updated khi có timetamps
        $category->update($request -> validated());
        return redirect()->route('categories.index')->with('success', 'Cap nhat thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // query builder
        // $product = DB::table('products')->where('category_id', $id)->count();
        // if ($product > 0) {
        //     return redirect()->route('categories.index')->with('error', 'Không thể xóa danh mục vì vẫn còn sản phẩm');
        // }
        // DB::table('categories')->where('id', $id)->delete();
        // return redirect()->route('categories.index')->with('success', 'Xóa thành công');

        // eloquent
        $product = Product::where('category_id', $category->id)->count();
        if ($product > 0) {
            return redirect()->route('categories.index')->with('error', 'Khong the xoa danh muc vi van con san pham');
        }
        $category -> delete();
        return redirect()->route('categories.index')->with('success', 'Xoa thanh cong');
    }
}
