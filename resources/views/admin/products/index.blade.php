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
@section('title', 'Danh sách sản phẩm')
@section('content')
    <h2>Danh sách sản phẩm</h2>
    <div class="table-responsive">
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Thêm sản phẩm</a>
        <a href="{{ route('products.trash') }}" class="btn btn-danger btn-sm">Thùng Rác</a>

        <form action="" method="GET" class="d-flex my-2">
            <input value="{{ request('search') }}" type="text" name="search" placeholder="Tim kiem theo ten san pham..."
                class="form-control">
            <button style="width: 100px" type="submit" class="btn btn-secondary">Tim kiem</button>
        </form>
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" width="90px" alt="Không có ảnh">
                            @else
                                <span>Không có ảnh</span>
                            @endif
                        </td>
                        {{-- <td>{{ $product->category_name }}</td> query builder --}}
                        <td>
                            @if ($product->category && $product->category->status == 1)
                                {{ $product->category->name }}
                            @else
                                <span class="text-danger">Không có danh mục</span>
                            @endif
                        </td>
                        <td>{{ $product->status ? 'Hoạt động' : 'Tạm dừng' }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">Show</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Bạn chắc chứ ???')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
