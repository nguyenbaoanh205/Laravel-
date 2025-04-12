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

@section('title', 'Sửa sản phẩm')
@section('content')
    <div class="container">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input value="{{ old('name', $product->name) }}" type="text" class="form-control" name="name" id="name"
                        placeholder="Name" />
                </div>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-4 col-form-label">Price</label>
                <div class="col-8">
                    <input value="{{ $product->price }}" type="text" class="form-control" name="price" id="price"
                        placeholder="Price" />
                </div>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="quantity" class="col-4 col-form-label">Quantity</label>
                <div class="col-8">
                    <input value="{{ $product->quantity }}" type="text" class="form-control" name="quantity"
                        id="quantity" placeholder="quantity" />
                </div>
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Image Old</label>
                <div class="col-8">
                    @if ($product->image)
                        <img src="{{ asset($product->image) }}" width="90px" alt="Không có ảnh cũ">
                    @endif
                </div>
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
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
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
                    <input value="{{ $product->description }}" type="text" class="form-control" name="description"
                        id="description" placeholder="description" />
                </div>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="status" class="col-4 col-form-label">Status</label>
                <div class="col-8">
                    <select name="status" class="form-select">
                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Tạm dừng</option>
                    </select>
                </div>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-sm btn-primary">
                        Sửa
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-sm">Quay lại</a>
                </div>
            </div>
        </form>
    </div>

@endsection
