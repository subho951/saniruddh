@include('front.elements.page-banner', [
    'pageTitle' => 'Frequently Asked Questions',
    'breadcrumbs' => [['label' => 'FAQ']],
])

<div class="section storefront-content-section">
    <div class="container">
        @forelse($faqCats as $faqCategory)
            <div class="storefront-faq-group">
                <h2>{{ $faqCategory->name }}</h2>
                <div class="accordion" id="faq-category-{{ $faqCategory->id }}">
                    @forelse($faqsByCategory->get($faqCategory->id, collect()) as $faq)
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}">{{ $faq->question }}</button>
                            </h3>
                            <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faq-category-{{ $faqCategory->id }}">
                                <div class="accordion-body">{!! $faq->answer !!}</div>
                            </div>
                        </div>
                    @empty
                        <p>No questions have been published in this section yet.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="storefront-empty-state"><h2>FAQ content is coming soon</h2><p>Please contact us if you need assistance.</p><a href="{{ url('contact') }}" class="btn btn-primary rounded-pill">Contact Us</a></div>
        @endforelse
    </div>
</div>
