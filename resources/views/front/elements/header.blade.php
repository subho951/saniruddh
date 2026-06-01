@php
    $logoUrl = !empty($generalSetting->site_logo)
        ? asset('public/uploads/'.$generalSetting->site_logo)
        : asset('public/frontend/images/logo/logo.png');
    $cartItemCount = $cartItemCount ?? 0;
@endphp

<div class="header section d-none d-lg-block">
    <div class="header-top" style="font-size: 12px; font-weight: 600;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <div class="header-top-info">
                        <p><a href="{{ url('/') }}" style="color: wheat;">{{ $generalSetting->topbar_text ?: 'Exclusive Boutique Products' }}</a></p>
                    </div>
                </div>
                <div class="col">
                    <div class="header-top-action">
                        <a href="{{ $user ? url('user/account') : url('signin') }}" class="actionstop" style="margin-top: 2px; color: wheat;">
                            {{ $user ? 'Welcome! '.$user->first_name : 'Welcome to Saniruddh' }}
                        </a>
                        <div class="header-top-lan dropdown">
                            <button class="action" data-bs-toggle="dropdown"><i class="fa fa-bars" style="color: wheat;"></i></button>
                            <ul class="dropdown-menu">
                                @if($user)
                                    <li><a class="dropdown-item" href="{{ url('user/account') }}">My Account</a></li>
                                    <li><a class="dropdown-item" href="{{ url('signout') }}">Sign Out</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ url('signin') }}">Login</a></li>
                                    <li><a class="dropdown-item" href="{{ url('signup') }}">Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="header-logo storefront-logo">
                        <a href="{{ url('/') }}"><img src="{{ $logoUrl }}" alt="{{ $generalSetting->site_name }}"></a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="primary-menu">
                        <nav>
                            <ul>
                                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                                <li>
                                    <a href="javascript:;">Shop Categories</a>
                                    <ul class="mega-sub-menu">
                                        @foreach($parentCats as $parentCat)
                                            <li>
                                                <a href="{{ url('products/'.$parentCat->slug) }}">{{ $parentCat->category_name }}</a>
                                                <ul class="menu-item">
                                                    @foreach($childCats->get($parentCat->id, collect()) as $childCat)
                                                        <li><a href="{{ url('products/'.$parentCat->slug.'/'.$childCat->slug) }}">{{ $childCat->category_name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ url('products/'.$parentCats->first()->slug) }}">
                                                <img src="{{ asset('public/frontend/images/menu-banner.jpg') }}" alt="Saniruddh collection">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('page/our-store') }}">Our Store</a></li>
                                <li class="{{ request()->is('blogs*') || request()->is('blog/*') ? 'active' : '' }}"><a href="{{ url('blogs') }}">Blogs</a></li>
                                <li><a href="{{ url('contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="header-action">
                        <a class="action" href="{{ url('cart') }}">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="num">{{ $cartItemCount }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header-mobile d-lg-none">
    <div class="container">
        <div class="row row-cols-2 align-items-center">
            <div class="col">
                <div class="header-logo storefront-logo">
                    <a href="{{ url('/') }}"><img src="{{ $logoUrl }}" alt="{{ $generalSetting->site_name }}"></a>
                </div>
            </div>
            <div class="col">
                <div class="header-action">
                    <a href="{{ url('cart') }}" class="action">
                        <i class="icofont-cart"></i>
                        <span class="num">{{ $cartItemCount }}</span>
                    </a>
                    <a href="javascript:;" class="action mobile-menu-open"><i class="icofont-navigation-menu"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas-menu d-lg-none">
    <a class="menu-close" href="javascript:;"><span></span><span></span></a>
    <div class="offcanvas-menu-wrapper">
        <div class="header-top-info">
            <p><a href="{{ url('/') }}">{{ $generalSetting->topbar_text ?: 'Exclusive Boutique Products' }}</a></p>
        </div>
        <div class="header-top-action">
            <a href="{{ $user ? url('user/account') : url('signin') }}" class="action">
                {{ $user ? 'Welcome! '.$user->first_name : 'Login / Register' }}
            </a>
        </div>
        <div class="mobile-primary-menu">
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        <a href="javascript:;">Shop Categories</a>
                        <ul class="mega-sub-menu">
                            @foreach($parentCats as $parentCat)
                                <li>
                                    <a href="{{ url('products/'.$parentCat->slug) }}">{{ $parentCat->category_name }}</a>
                                    <ul class="menu-item">
                                        @foreach($childCats->get($parentCat->id, collect()) as $childCat)
                                            <li><a href="{{ url('products/'.$parentCat->slug.'/'.$childCat->slug) }}">{{ $childCat->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ url('page/our-store') }}">Our Store</a></li>
                    <li><a href="{{ url('blogs') }}">Blogs</a></li>
                    <li><a href="{{ url('contact') }}">Contact</a></li>
                    @if($user)
                        <li><a href="{{ url('user/account') }}">My Account</a></li>
                        <li><a href="{{ url('signout') }}">Sign Out</a></li>
                    @else
                        <li><a href="{{ url('signin') }}">Login</a></li>
                        <li><a href="{{ url('signup') }}">Register</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="menu-overlay"></div>
