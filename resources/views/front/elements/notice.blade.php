@php
    $noticeType = $noticeType ?? 'info';
    $noticeIcons = [
        'success' => 'check-circle',
        'error' => 'exclamation-circle',
        'info' => 'info-circle',
    ];
@endphp

<div class="storefront-notice storefront-notice-{{ $noticeType }}" role="{{ $noticeType == 'error' ? 'alert' : 'status' }}">
    <div class="storefront-notice-icon"><i class="fa fa-{{ $noticeIcons[$noticeType] ?? 'info-circle' }}"></i></div>
    <div class="storefront-notice-content">
        @if(!empty($noticeTitle))<strong>{{ $noticeTitle }}</strong>@endif
        <p>{{ $noticeMessage }}</p>
    </div>
    @if($noticeDismissible ?? false)
        <button type="button" class="storefront-notice-close" onclick="this.parentElement.remove()" aria-label="Close notification">
            <i class="fa fa-times"></i>
        </button>
    @endif
</div>
