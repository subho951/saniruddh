@include('front.elements.page-banner', [
    'pageTitle' => $page->page_title ?? 'Page',
    'breadcrumbs' => [['label' => $page->page_title ?? 'Page']],
])

<div class="section storefront-content-section">
    <div class="container">
        @if($page)
            @if($page->page_banner_image)
                <img class="storefront-page-image" src="{{ asset('public/uploads/page/'.$page->page_banner_image) }}" alt="{{ $page->page_title }}">
            @endif
            @if($page->short_description)<p class="storefront-page-lead">{{ $page->short_description }}</p>@endif
            <div class="storefront-rich-content">{!! $page->long_description ?: '<p>Content will be published soon.</p>' !!}</div>
        @else
            <div class="storefront-empty-state"><h2>Page not found</h2><a href="{{ url('/') }}" class="btn btn-primary rounded-pill">Return Home</a></div>
        @endif
    </div>
</div>
