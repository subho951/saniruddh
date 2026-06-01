@include('front.elements.page-banner', [
    'pageTitle' => 'Contact Us',
    'breadcrumbs' => [['label' => 'Contact']],
])

<div class="section storefront-content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="storefront-contact-card">
                    <h2>Visit Saniruddh</h2>
                    <p>{{ $generalSetting->description }}</p>
                    <p><strong>Phone:</strong> <a href="tel:{{ $generalSetting->site_phone }}">{{ $generalSetting->site_phone }}</a></p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $generalSetting->site_mail }}">{{ $generalSetting->site_mail }}</a></p>
                    <div class="storefront-footer-map">{!! $generalSetting->google_analytics_code !!}</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-form storefront-form-card">
                    <h2>Send an enquiry</h2>
                    <form action="{{ url('contact') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6"><div class="single-form"><label>First name *</label><input type="text" name="fname" value="{{ old('fname') }}" required></div></div>
                            <div class="col-sm-6"><div class="single-form"><label>Last name *</label><input type="text" name="lname" value="{{ old('lname') }}" required></div></div>
                            <div class="col-sm-6"><div class="single-form"><label>Email *</label><input type="email" name="email" value="{{ old('email') }}" required></div></div>
                            <div class="col-sm-6"><div class="single-form"><label>Phone *</label><input type="text" name="phone" value="{{ old('phone') }}" required></div></div>
                            <div class="col-sm-12"><div class="single-form"><label>Subject *</label><input type="text" name="subject" value="{{ old('subject') }}" required></div></div>
                            <div class="col-sm-12"><div class="single-form"><label>Message *</label><textarea name="message" required>{{ old('message') }}</textarea></div></div>
                            <div class="col-sm-12"><div class="single-form"><button class="btn btn-primary btn-hover-dark rounded-pill" type="submit">Submit Enquiry</button></div></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
