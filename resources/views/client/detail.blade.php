@extends('client.layouts.app')
@section('content')
    <!-- Product Detail Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{ asset($product->image) }}" class="img-fluid rounded mb-3" style="height: 400px" alt="Sản phẩm">
                </div>
                <div class="col-lg-6">
                    <h1 class="fw-bold">{{ $product->name }}</h1>
                    <p class="text-muted">Danh mục: {{ $product->category->name }}</p>
                    <h3 class="text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</h3>
                    <p class="lead">Mô tả ngắn: {{ $product->description }}</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Tính năng 1: Hiệu suất cao</li>
                        <li><i class="fas fa-check text-success me-2"></i>Tính năng 2: Độ bền tốt</li>
                        <li><i class="fas fa-check text-success me-2"></i>Tính năng 3: Dễ sử dụng</li>
                    </ul>
                    <div class="mt-4">
                        <button class="btn btn-primary btn-lg me-2">Thêm vào giỏ hàng</button>
                        <button class="btn btn-outline-secondary btn-lg">Mua ngay</button>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h3>Mô tả chi tiết</h3>
                <p>Sản phẩm này được thiết kế với công nghệ tiên tiến, mang lại trải nghiệm tuyệt vời cho người dùng. Với
                    chất liệu cao cấp và độ hoàn thiện tỉ mỉ, đây là lựa chọn hoàn hảo cho những ai đang tìm kiếm một sản
                    phẩm chất lượng.</p>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Sản Phẩm Cùng Danh Mục</h2>
            <div class="row">
                @foreach ($relatedProducts as $item)
                    <div class="col-md-2 col-6">
                        <div class="card mb-4">
                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="Sản phẩm liên quan 1">
                            <div class="card-body">
                                <h6 class="card-title">{{ $item->name }}</h6>
                                <p class="card-text fw-bold">{{ number_format($item->price, 0, ',', '.') }} VNĐ</p>
                                <a href="{{ route('client.detail', ['id' => $item->id]) }}"
                                    class="btn btn-sm btn-primary">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
