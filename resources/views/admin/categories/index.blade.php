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

@section('title', 'Danh sách danh mục')
@section('content')
    @if (Auth::check())
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Dang xuat</button>
        </form>
    @endif
    <div class="container">
        <h2>Danh sách danh mục</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Thêm danh mục</a>
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" placeholder="Tim kiem theo danh muc..." class="form-control"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Tìm kiếm</button>
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cate)
                    <tr>
                        <td>{{ $cate->id }}</td>
                        <td>{{ $cate->name }}</td>
                        <td>{{ $cate->status ? 'Hoạt động' : 'Tạm dừng' }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $cate->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="{{ route('categories.show', $cate->id) }}" class="btn btn-info btn-sm">Xem</a>
                            <form action="{{ route('categories.destroy', $cate->id) }}" class="d-inline" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn chắc chắn chưa ???')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
