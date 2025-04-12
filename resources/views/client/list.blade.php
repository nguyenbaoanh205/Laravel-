@extends('client.layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">Chào mừng đến với trang web của chúng tôi</h1>
                    <p class="lead">Đây là nơi bạn có thể tìm thấy những dịch vụ tuyệt vời và thông tin hữu ích.</p>
                    <a href="#" class="btn btn-primary btn-lg">Khám Phá Ngay</a>
                </div>
                <div class="col-lg-6">
                    <img src="https://shop.daisycomms.co.uk/wp-content/uploads/2023/09/Apple-iPhone-15-promo-banner-buy-now-scaled.jpg"
                        class="img-fluid rounded" alt="Hero Image">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Các Tính Năng Nổi Bật</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-rocket fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Nhanh Chóng</h5>
                            <p class="card-text">Tốc độ xử lý vượt trội cho mọi nhu cầu của bạn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">An Toàn</h5>
                            <p class="card-text">Bảo mật thông tin tuyệt đối cho khách hàng.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Hỗ Trợ 24/7</h5>
                            <p class="card-text">Đội ngũ hỗ trợ luôn sẵn sàng giúp bạn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="mb-5">
                <h2 class="text-center mb-5">Danh Mục Sản Phẩm</h2>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <a href="{{ route('client.list', ['category' => $category->id]) }}"
                            class="btn btn-outline-primary {{ request('category') == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                    <a href="{{ route('client.list') }}"
                        class="btn btn-outline-secondary {{ !request('category') ? 'active' : '' }}">
                        Tất cả
                    </a>
                </div>
            </div>

            <h2 class="text-center mb-5">Sản Phẩm Mới</h2>
            <form method="GET" class="mb-5 d-flex">
                <select name="loc_gia" class="form-select me-1 w-50" >
                    <option value="">-- Lọc theo giá --</option>
                    <option value="duoi_500" {{ request('loc_gia') == 'duoi_500' ? 'selected' : '' }}>Dưới 500K</option>
                    <option value="500_1tr" {{ request('loc_gia') == '500_1tr' ? 'selected' : '' }}>500K - 1 triệu</option>
                    <option value="1tr_5tr" {{ request('loc_gia') == '1tr_5tr' ? 'selected' : '' }}>1 triệu - 5 triệu
                    </option>
                    <option value="5tr_tro_len" {{ request('loc_gia') == '5tr_tro_len' ? 'selected' : '' }}>Trên 5 triệu
                    </option>
                </select>

                <input type="text" value="{{ request('search') }}" name="search" placeholder="Tim kiem san pham..."
                    class="form-control me-1">
                <button class="btn btn-primary w-25">Tim kiem</button>
            </form>

            <div class="row">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset($product->image) }}" class="w-100 object-fit-cover" alt="">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="fw-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                                    <a href="{{ route('client.detail', ['id' => $product->id]) }}"
                                        class="btn btn-primary">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            Không có sản phẩm trong danh mục này 
                        </div>
                    </div>
                @endif
            </div>
            <?php echo $products->links(); ?>
        </div>
    </section>
@endsection
