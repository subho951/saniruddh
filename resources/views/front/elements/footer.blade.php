@php
    $footerLogoUrl = !empty($generalSetting->site_footer_logo)
        ? asset('public/uploads/'.$generalSetting->site_footer_logo)
        : asset('public/frontend/images/logo/logo.png');
@endphp

<div class="section footer-section">
    <div class="footer-widget-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5 order-md-1 order-lg-1">
                    <div class="footer-widget">
                        <div class="widget-text">
                            <a href="{{ url('/') }}"><img src="{{ $footerLogoUrl }}" alt="{{ $generalSetting->site_name }}"></a>
                            <p>{{ $home_page->sec7_description ?? 'Exclusive boutique apparel for all.' }}</p>
                        </div>
                        <div class="widget-social">
                            <h5 class="title">Social Link</h5>
                            <div class="social">
                                <a href="{{ $generalSetting->facebook_profile ?: 'javascript:;' }}"><i class="fa fa-facebook-f"></i></a>
                                <a href="{{ $generalSetting->instagram_profile ?: 'javascript:;' }}"><i class="fa fa-instagram"></i></a>
                                <a href="{{ $generalSetting->youtube_profile ?: 'javascript:;' }}"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-md-3 order-lg-2">
                    <div class="widget-link-wrapper">
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">{{ $home_page->sec6_title ?? 'Store Location' }}</h4>
                            <div class="footer-widget-link storefront-footer-map">
                                {!! $generalSetting->google_analytics_code !!}
                            </div>
                        </div>
                        <div class="footer-widget">
                            <h4 class="footer-widget-title">Useful Links</h4>
                            <div class="footer-widget-link d-flex justify-content-sm-between">
                                <ul>
                                    <li><a href="{{ url('page/about-us') }}"><i class="fa fa-angle-double-right"></i> About Us</a></li>
                                    <li><a href="{{ url('page/order-terms') }}"><i class="fa fa-angle-double-right"></i> Terms &amp; Conditions</a></li>
                                    <li><a href="{{ url('page/privacy-policy') }}"><i class="fa fa-angle-double-right"></i> Privacy Policy</a></li>
                                    <li><a href="{{ url('page/shipping-information') }}"><i class="fa fa-angle-double-right"></i> Shipping Information</a></li>
                                    <li><a href="{{ url('contact') }}"><i class="fa fa-angle-double-right"></i> Contact Us</a></li>
                                </ul>
                                <ul>
                                    @foreach($parentCats as $parentCat)
                                        <li><a href="{{ url('products/'.$parentCat->slug) }}"><i class="fa fa-angle-double-right"></i> {{ $parentCat->category_name }}</a></li>
                                    @endforeach
                                    <li><a href="{{ url('blogs') }}"><i class="fa fa-angle-double-right"></i> Blogs</a></li>
                                    <li><a href="{{ $user ? url('user/account') : url('signin') }}"><i class="fa fa-angle-double-right"></i> My Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-7 order-md-2 order-lg-3">
                    <div class="footer-widget widget-info">
                        <h4 class="footer-widget-title">{{ $home_page->sec7_title ?? 'Store Info' }}</h4>
                        <div class="widget-info-wrapper">
                            <h5 class="title">{{ $generalSetting->site_name }}</h5>
                            <div class="single-info"><p>{{ $generalSetting->description }}</p></div>
                            <div class="single-info">
                                <p>Phone <a href="tel:{{ $generalSetting->site_phone }}">{{ $generalSetting->site_phone }}</a></p>
                                <p>Whatsapp <a href="tel:{{ $generalSetting->site_phone }}">{{ $generalSetting->site_phone }}</a></p>
                            </div>
                            <div class="single-info"><p><a href="mailto:{{ $generalSetting->site_mail }}">{{ $generalSetting->site_mail }}</a></p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="copyright-payment">
                <div class="copyright-text"><p>{!! $generalSetting->footer_text !!}</p></div>
                <div class="payment-method"><img src="{{ asset('public/frontend/images/payment.png') }}" alt="Payment methods"></div>
            </div>
        </div>
    </div>
    <div class="footer-shape">
        <img src="{{ asset('public/frontend/images/footer-shape.png') }}" alt="">
    </div>
</div>
