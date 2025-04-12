@extends('admin.layouts.app')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <div class="container">
        <h2>Chi tiết sản phẩm</h2>
        <div class="mb-3 row">
            <label for="name" class="col-4 col-form-label">Name</label>
            <div class="col-8">
                {{ $product->name }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-4 col-form-label">Price</label>
            <div class="col-8">
                {{ $product->price }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="quantity" class="col-4 col-form-label">Quantity</label>
            <div class="col-8">
                {{ $product->quantity }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="image" class="col-4 col-form-label">Image</label>
            <div class="col-8">
                <img src="{{ asset($product->image) }}" width="90px" alt="Khong co anh">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="category_id" class="col-4 col-form-label">Category_id</label>
            <div class="col-8">
                {{ $product->category -> name }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="description" class="col-4 col-form-label">Description</label>
            <div class="col-8">
                {{ $product->description }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="status" class="col-4 col-form-label">Status</label>
            <div class="col-8">
                {{ $product->status ? 'Hoạt động' : 'Tạm dừng' }}
            </div>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-success btn-sm">Quay lại</a>
    </div>
@endsection
