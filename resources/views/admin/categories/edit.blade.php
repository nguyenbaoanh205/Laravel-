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

@section('title', 'Them danh muc')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Sửa danh mục</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3 form-group">
                    <label class="form-label">Tên danh mục</label>
                    <input value="{{ $category->name }}" type="text" name="name" class="form-control">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-group">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="1" {{$category->status == 1 ? 'selected':''}}>Hoạt động</option>
                        <option value="0" {{$category->status == 0 ? 'selected':''}}>Tạm dừng</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success btn-sm">Sửa danh mục</button>
            </form>
        </div>
    </div>
@endsection
