@extends('admin.layouts.app')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@section('title', 'Thêm sản phẩm')
@section('content')
    <div class="container">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-4 col-form-label">Price</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" />
                </div>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="quantity" class="col-4 col-form-label">Quantity</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="quantity" id="quantity" placeholder="quantity" />
                </div>
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Image</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="image" id="image" />
                </div>
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="category_id" class="col-4 col-form-label">Category_id</label>
                <div class="col-8">
                    <select name="category_id" class="form-select">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="description" class="col-4 col-form-label">Description</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="description" id="description" placeholder="description" />
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-4 col-form-label">Status</label>
                <div class="col-8">
                    <select name="status" class="form-select">
                        <option value="">Chọn trạng thái</option>
                        <option value="0">Tạm dừng</option>
                        <option value="1">Hoạt động</option>
                    </select>
                </div>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Thêm
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-sm">Quay lại</a>
                </div>
            </div>
        </form>
    </div>

@endsection
