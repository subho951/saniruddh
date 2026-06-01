@php
    $blogImage = $blog->blog_image
        ? asset('public/uploads/blog/'.$blog->blog_image)
        : asset('public/frontend/images/blog/blog-details.jpg');
    $shareUrl = url('blog/'.$blog->slug);
@endphp

<div class="page-banner section storefront-page-banner">
    <div class="container">
        <div class="page-banner-wrapper text-center">
            <h1 class="title">Blog Details</h1>
            <ul class="breadcrumb storefront-breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('blogs') }}">Blogs</a></li>
                <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($blog->title, 42) }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="section storefront-blog-section">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <article class="blog-details-wrapper storefront-blog-detail">
                    <img class="storefront-blog-detail-image" src="{{ $blogImage }}" alt="{{ $blog->title }}">
                    <div class="blog-meta">
                        <a href="{{ $blog->category ? url('blogs/category/'.$blog->category->slug) : url('blogs') }}">{{ $blog->category->name ?? 'Fashion' }}</a>
                        <span>{{ date('d F, Y', strtotime($blog->publish_date)) }}</span>
                    </div>
                    <h1 class="title">{{ $blog->title }}</h1>
                    <div class="article-content">
                        {!! $blog->long_description ?: e($blog->short_description) !!}
                    </div>
                </article>

                <div class="blog-details-tags-share">
                    <div class="blog-details-tags">
                        <h4 class="title">Category:</h4>
                        <ul class="tag-list">
                            <li><a href="{{ $blog->category ? url('blogs/category/'.$blog->category->slug) : url('blogs') }}">{{ $blog->category->name ?? 'Fashion' }}</a></li>
                        </ul>
                    </div>
                    <div class="blog-details-share">
                        <h4 class="title">Share:</h4>
                        <div class="social">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-facebook-f"></i></a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title.' '.$shareUrl) }}" target="_blank" rel="noopener noreferrer"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>

                @if($relatedBlogs->isNotEmpty())
                    <div class="section-title line-1 mt-5">
                        <h2 class="title">More Stories</h2>
                    </div>
                    <div class="blog-wrapper">
                        <div class="row">
                            @foreach($relatedBlogs as $relatedBlog)
                                <div class="col-md-4">
                                    <article class="single-blog storefront-blog-card">
                                        <div class="blog-image">
                                            <a href="{{ url('blog/'.$relatedBlog->slug) }}">
                                                <img src="{{ $relatedBlog->blog_image ? asset('public/uploads/blog/'.$relatedBlog->blog_image) : asset('public/frontend/images/blog/blog-01.jpg') }}" alt="{{ $relatedBlog->title }}">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-meta"><span>{{ date('d M, Y', strtotime($relatedBlog->publish_date)) }}</span></div>
                                            <h3 class="title"><a href="{{ url('blog/'.$relatedBlog->slug) }}">{{ $relatedBlog->title }}</a></h3>
                                            <a href="{{ url('blog/'.$relatedBlog->slug) }}" class="more">Read more</a>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-3">
                @include('front.elements.blog-sidebar')
            </div>
        </div>
    </div>
</div>
