<aside class="storefront-blog-sidebar">
    <div class="widget-item">
        <h4 class="widget-title">Search Stories</h4>
        <form class="storefront-blog-search" action="{{ url('blogs') }}" method="get">
            <input type="search" name="q" value="{{ $searchTerm ?? '' }}" placeholder="Search blog posts">
            <button type="submit" aria-label="Search"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="widget-item">
        <h4 class="widget-title">Categories</h4>
        <div class="widget-link">
            <ul>
                <li><a class="{{ empty($activeBlogCategory) ? 'active' : '' }}" href="{{ url('blogs') }}">All Stories</a></li>
                @foreach($blogCategories as $blogCategory)
                    <li>
                        <a class="{{ !empty($activeBlogCategory) && $activeBlogCategory->id == $blogCategory->id ? 'active' : '' }}" href="{{ url('blogs/category/'.$blogCategory->slug) }}">
                            {{ $blogCategory->name }} ({{ $blogCategory->active_blogs_count }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    @if($recentBlogs->isNotEmpty())
        <div class="widget-item">
            <h4 class="widget-title">Recent Posts</h4>
            <div class="widget-link">
                <ul>
                    @foreach($recentBlogs as $recentBlog)
                        <li>
                            <div class="storefront-recent-post">
                                <a href="{{ url('blog/'.$recentBlog->slug) }}">
                                    <img src="{{ $recentBlog->blog_image ? asset('public/uploads/blog/'.$recentBlog->blog_image) : asset('public/frontend/images/blog/blog-01.jpg') }}" alt="{{ $recentBlog->title }}">
                                </a>
                                <div>
                                    <a href="{{ url('blog/'.$recentBlog->slug) }}">{{ \Illuminate\Support\Str::limit($recentBlog->title, 52) }}</a>
                                    <span>{{ date('d M, Y', strtotime($recentBlog->publish_date)) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</aside>
