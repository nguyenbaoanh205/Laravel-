@extends('admin.layouts.app')

@section('title', 'Thùng rác sản phẩm')
@section('content')
    <h2>Thùng rác sản phẩm</h2>
    <div class="table-responsive">
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">Quay lại</a>
        
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
                @foreach ($trashedProducts as $product)
                    <tr>
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
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->status ? 'Hoạt động' : 'Tạm dừng' }}</td>
                        <td>
                            <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                            </form>
                            <form action="{{ route('products.force-delete', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
