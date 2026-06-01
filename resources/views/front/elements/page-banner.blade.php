<div class="page-banner section {{ !empty($compactBanner) ? 'storefront-page-banner-compact' : 'storefront-page-banner' }}">
    <div class="container">
        <div class="page-banner-wrapper text-center">
            @if(!empty($compactBanner))
                <h3>{{ $pageTitle }}</h3>
            @else
                <h1 class="title">{{ $pageTitle }}</h1>
                <ul class="breadcrumb storefront-breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    @foreach($breadcrumbs ?? [] as $breadcrumb)
                        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                            @if(!empty($breadcrumb['url']) && ! $loop->last)
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                            @else
                                {{ $breadcrumb['label'] }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
