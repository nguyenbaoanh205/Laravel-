@extends('admin.layouts.app')

@section('title', 'Them danh muc')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Chi tiết danh mục</h2>
        </div>
        <div class="card-body">
            <div class="mb-3 form-group">
                <label class="form-label">Tên danh mục:</label>
                <div>{{ $category->name }}</div>
            </div>
            <div class="mb-3 form-group">
                <label class="form-label">Trạng thái:</label>
                <div>{{ $category->status ? 'Hoạt động' : 'Tạm dừng' }}</div>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-success btn-sm">Quay lại</a>
        </div>
    </div>
@endsection
