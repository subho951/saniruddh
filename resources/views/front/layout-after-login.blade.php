<!DOCTYPE html>
<html lang="en">
<head>
    {!! $head !!}
</head>
<body>
    {!! $header !!}

    @include('front.elements.notifications')

    <main class="section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    {!! $sidebar !!}
                </div>
                <div class="col-lg-9">
                    {!! $maincontent !!}
                </div>
            </div>
        </div>
    </main>

    {!! $footer !!}

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script src="{{ asset('public/frontend/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/plugins.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
</body>
</html>
