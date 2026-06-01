@php
    $storefrontNotices = [
        ['type' => 'success', 'title' => 'Success', 'message' => session('success_message')],
        ['type' => 'success', 'title' => 'Success', 'message' => session('success_message2')],
        ['type' => 'error', 'title' => 'Please check this', 'message' => session('error_message')],
        ['type' => 'error', 'title' => 'Please check this', 'message' => session('error_message2')],
    ];

    foreach ($errors->all() as $error) {
        $storefrontNotices[] = ['type' => 'error', 'title' => 'Please check this', 'message' => $error];
    }

    $storefrontNotices = array_values(array_filter($storefrontNotices, fn ($notice) => !empty($notice['message'])));
@endphp

@if(!empty($storefrontNotices))
    <div class="container storefront-flash" aria-live="polite">
        @foreach($storefrontNotices as $notice)
            @include('front.elements.notice', [
                'noticeType' => $notice['type'],
                'noticeTitle' => $notice['title'],
                'noticeMessage' => $notice['message'],
                'noticeDismissible' => true,
            ])
        @endforeach
    </div>
@endif
