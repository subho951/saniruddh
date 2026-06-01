<div class="page-banner section storefront-page-banner">
    <div class="container">
        <div class="page-banner-wrapper text-center">
            <h1 class="title">{{ $activeBlogCategory ? $activeBlogCategory->name.' Stories' : 'Our Blog' }}</h1>
            <ul class="breadcrumb storefront-breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $activeBlogCategory ? $activeBlogCategory->name : 'Blogs' }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="section storefront-blog-section">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                @if($searchTerm != '')
                    <div class="section-title line-1">
                        <h2 class="title">Search results for "{{ $searchTerm }}"</h2>
                    </div>
                @endif

                @if($blogs->isNotEmpty())
                    <div class="blog-wrapper">
                        <div class="row">
                            @foreach($blogs as $blog)
                                <div class="col-md-6">
                                    <article class="single-blog storefront-blog-card">
                                        <div class="blog-image">
                                            <a href="{{ url('blog/'.$blog->slug) }}">
                                                <img src="{{ $blog->blog_image ? asset('public/uploads/blog/'.$blog->blog_image) : asset('public/frontend/images/blog/blog-01.jpg') }}" alt="{{ $blog->title }}">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta">
                                                <a href="{{ $blog->category ? url('blogs/category/'.$blog->category->slug) : url('blogs') }}">{{ $blog->category->name ?? 'Fashion' }}</a>
                                                <span>{{ date('d F, Y', strtotime($blog->publish_date)) }}</span>
                                            </div>
                                            <h2 class="title"><a href="{{ url('blog/'.$blog->slug) }}">{{ $blog->title }}</a></h2>
                                            <p class="blog-summary">{{ \Illuminate\Support\Str::limit(strip_tags($blog->short_description), 145) }}</p>
                                            <a href="{{ url('blog/'.$blog->slug) }}" class="more">Read more</a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if($blogs->hasPages())
                        <div class="page-pagination mt-5">
                            {{ $blogs->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                @else
                    @include('front.elements.notice', [
                        'noticeType' => 'info',
                        'noticeTitle' => 'No stories found',
                        'noticeMessage' => 'No blog posts matched your selection.',
                    ])
                @endif
            </div>
            <div class="col-lg-3">
                @include('front.elements.blog-sidebar')
            </div>
        </div>
    </div>
</div>
