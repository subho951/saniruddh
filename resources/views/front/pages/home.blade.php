@php
    $homePage = $home_page;
    $productUrl = static fn ($product) => url('product/'.$product->slug.'/'.\App\Helpers\Helper::encoded($product->id));
@endphp

<div class="slider-section section slider-active">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($banners1 as $banner)
                <div class="single-slider swiper-slide animation-style-01">
                    <div class="container">
                        <div class="slider-wrapper">
                            <div class="row">
                                <div class="col-sm-6 align-self-center">
                                    <div class="slider-content">
                                        <img class="shape-1" src="{{ asset('public/frontend/images/slider/slider-shape/shape-1.svg') }}" alt="">
                                        <h4 class="sub-title">{{ $banner->banner_text2 }}</h4>
                                        <h2 class="main-title">{{ $banner->banner_text }}</h2>
                                        <a class="slider-btn" href="{{ $banner->banner_link ?: '#' }}">Shop Now <span class="material-icons">arrow_right_alt</span></a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="slider-image">
                                        <img src="{{ asset('public/uploads/banner/'.$banner->banner_image) }}" alt="{{ $banner->banner_text }}">
                                        <div class="slider-imgaes-shape">
                                            <div class="shape shape-1"><img src="{{ asset('public/frontend/images/slider/slider-shape/shape-2.svg') }}" alt=""></div>
                                            <div class="shape {{ $loop->even ? 'shape-4' : 'shape-2' }}"><img src="{{ asset('public/frontend/images/slider/slider-shape/shape-3.svg') }}" alt=""></div>
                                            <div class="shape shape-3"><img src="{{ asset('public/frontend/images/slider/slider-shape/shape-4.svg') }}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"><span class="material-icons">trending_flat</span></div>
        <div class="swiper-button-prev"><span class="material-icons">trending_flat</span></div>
    </div>
</div>

<div class="section section-padding mt-n1">
    <div class="container">
        <div class="editor-pick-wrapper">
            <div class="section-title line-1">
                <h2 class="title">{{ $homePage->sec2_title ?? "Saniruddh's Pick" }}</h2>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($featuredProducts as $product)
                            <div class="swiper-slide">
                                <div class="single-product">
                                    <div class="product-image">
                                        <a href="{{ $productUrl($product) }}"><img src="{{ asset('public/uploads/product/'.$product->cover_image) }}" alt="{{ $product->name }}"></a>
                                        <span class="product-label hot">Exclusive</span>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-category-action">
                                            <div class="product-category"><a href="{{ url('products/'.($categorySlugsById[$product->main_category] ?? '')) }}">Category : {{ $categoriesById[$product->main_category] ?? 'Boutique' }}</a></div>
                                            <div class="product-action">
                                                <a href="{{ $productUrl($product) }}" class="action" data-tooltip="tooltip" data-placement="top" title="Choose Options"><i class="fa fa-shopping-cart"></i></a>
                                                <a href="{{ url('make-wishlist/'.\App\Helpers\Helper::encoded($product->id)) }}" class="action" data-tooltip="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <h4 class="product-title"><a href="{{ $productUrl($product) }}">{{ $product->name }}</a></h4>
                                        <div class="product-price">
                                            @if($product->base_price > $product->discounted_price)
                                                <span class="old-price"><i class="fa fa-inr"></i>{{ number_format($product->base_price, 2) }}</span>
                                            @endif
                                            <span class="sale-price"><i class="fa fa-inr"></i>{{ number_format($product->discounted_price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section section-padding mt-n8">
    <div class="container">
        <div class="row grid">
            @foreach($banners2 as $banner)
                @php
                    $bannerColumn = match ($loop->index) {
                        0 => 'col-lg-4 custom-banner-col-1',
                        1 => 'col-lg-5 custom-banner-col-2',
                        2 => 'col-lg-3 custom-banner-col-2',
                        default => 'col-lg-8',
                    };
                @endphp
                <div class="{{ $bannerColumn }} grid-item">
                    <div class="banner-item banner-0{{ min($loop->iteration, 3) }}">
                        <a href="{{ $banner->banner_link ?: '#' }}">
                            <img src="{{ asset('public/uploads/banner/'.$banner->banner_image) }}" alt="{{ $banner->banner_text }}">
                            <div class="banner-text">
                                <span class="sub-title">{{ $banner->banner_text2 }}</span>
                                <h4 class="title">{{ $banner->banner_text }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="section section-padding mt-n1">
    <div class="container">
        <div class="new-arrivals-wrapper">
            <div class="section-title line-1">
                <h2 class="title">{{ $homePage->sec3_title ?? 'New Arrivals' }}</h2>
            </div>
        </div>
        <div class="product-wrapper">
            <div class="product-active">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($products as $product)
                            <div class="swiper-slide">
                                <div class="single-product">
                                    <div class="product-image">
                                        <a href="{{ $productUrl($product) }}"><img src="{{ asset('public/uploads/product/'.$product->cover_image) }}" alt="{{ $product->name }}"></a>
                                        <span class="product-label {{ $loop->even ? 'sold-out' : 'hot' }}">{{ $loop->even ? 'Popular' : 'New' }}</span>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-category-action">
                                            <div class="product-category"><a href="{{ url('products/'.($categorySlugsById[$product->main_category] ?? '')) }}">Category : {{ $categoriesById[$product->main_category] ?? 'Boutique' }}</a></div>
                                            <div class="product-action">
                                                <a href="{{ $productUrl($product) }}" class="action" data-tooltip="tooltip" data-placement="top" title="Choose Options"><i class="fa fa-shopping-cart"></i></a>
                                                <a href="{{ url('make-wishlist/'.\App\Helpers\Helper::encoded($product->id)) }}" class="action" data-tooltip="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart-o"></i></a>
                                            </div>
                                        </div>
                                        <h4 class="product-title"><a href="{{ $productUrl($product) }}">{{ $product->name }}</a></h4>
                                        <div class="product-price">
                                            @if($product->base_price > $product->discounted_price)
                                                <span class="old-price"><i class="fa fa-inr"></i>{{ number_format($product->base_price, 2) }}</span>
                                            @endif
                                            <span class="sale-price"><i class="fa fa-inr"></i>{{ number_format($product->discounted_price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="blog-posts" class="section section-padding mt-n1 mb-10">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title">{{ $homePage->sec5_title ?? 'Blog Post' }}</h2>
        </div>
        <div class="blog-wrapper">
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <div class="blog-image"><a href="{{ url('blog/'.$blog->slug) }}"><img src="{{ asset('public/uploads/blog/'.$blog->blog_image) }}" alt="{{ $blog->title }}"></a></div>
                            <div class="blog-content">
                                <div class="blog-meta">
                                    <a href="{{ $blog->category ? url('blogs/category/'.$blog->category->slug) : url('blogs') }}">{{ $blog->category->name ?? 'Fashion' }}</a>
                                    <span>{{ date('d F, Y', strtotime($blog->publish_date)) }}</span>
                                </div>
                                <h4 class="title"><a href="{{ url('blog/'.$blog->slug) }}">{{ $blog->title }}</a></h4>
                                <p>{{ $blog->short_description }}</p>
                                <a href="{{ url('blog/'.$blog->slug) }}" class="more">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
