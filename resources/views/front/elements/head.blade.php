<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>{{ $title }}</title>
<meta name="description" content="{{ $metaDescription ?? $generalSetting->meta_description ?? '' }}">
<meta name="keywords" content="{{ $metaKeywords ?? $generalSetting->meta_keywords ?? '' }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/uploads/'.$generalSetting->site_favicon) }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/frontend/css/vendor/plugins.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/frontend/css/style.min.css') }}">
<script src="{{ asset('public/frontend/js/vendor/modernizr-3.11.2.min.js') }}"></script>

<style>
    .storefront-logo img {
        max-height: 72px;
        object-fit: contain;
    }
    .storefront-flash {
        padding-bottom: 2px;
        padding-top: 14px;
    }
    .storefront-notice {
        align-items: flex-start;
        background: #f6f9f7;
        border: 1px solid #d8e4dd;
        border-left: 4px solid #6a8878;
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        padding: 13px 44px 13px 14px;
        position: relative;
    }
    .storefront-notice-success {
        background: #f1f8f4;
        border-color: #cce3d4;
        border-left-color: #43845c;
        color: #245b38;
    }
    .storefront-notice-error {
        background: #fff5f3;
        border-color: #efd3ce;
        border-left-color: #b44d42;
        color: #8e3028;
    }
    .storefront-notice-info {
        background: #f4f8fc;
        border-color: #d4e1ed;
        border-left-color: #557d9f;
        color: #365f80;
    }
    .storefront-notice-icon {
        font-size: 20px;
        line-height: 1;
        padding-top: 2px;
    }
    .storefront-notice-content strong {
        display: block;
        font-size: 15px;
        margin-bottom: 2px;
    }
    .storefront-notice-content p {
        font-size: 14px;
        line-height: 1.55;
        margin: 0;
    }
    .storefront-notice-close {
        background: transparent;
        border: 0;
        color: currentColor;
        font-size: 14px;
        opacity: 0.65;
        padding: 6px;
        position: absolute;
        right: 9px;
        top: 8px;
    }
    .storefront-notice-close:hover {
        opacity: 1;
    }
    .storefront-account-nav {
        border: 1px solid #e5d7bc;
        margin-bottom: 30px;
        padding: 20px;
    }
    .storefront-account-nav li + li {
        border-top: 1px solid #efe4d0;
    }
    .storefront-account-nav a {
        display: block;
        padding: 10px 0;
    }
    .storefront-account-nav a.active {
        color: #ca7101;
        font-weight: 700;
    }
    .storefront-footer-map iframe {
        max-width: 100%;
    }
    .storefront-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
    }
    .storefront-page-banner {
        padding-bottom: 42px;
        padding-top: 42px;
    }
    .storefront-page-banner-compact {
        padding-bottom: 20px;
        padding-top: 20px;
    }
    .storefront-page-banner-compact h3 {
        margin-bottom: 0;
    }
    .storefront-blog-section {
        padding: 36px 0 80px;
    }
    .storefront-blog-card {
        height: calc(100% - 30px);
    }
    .storefront-blog-card .blog-image img {
        aspect-ratio: 16 / 10;
        object-fit: cover;
    }
    .storefront-blog-card .blog-summary {
        color: #676767;
        font-size: 14px;
        line-height: 1.7;
        margin: 12px 0;
    }
    .storefront-blog-sidebar .widget-item {
        margin-top: 30px;
    }
    .storefront-blog-sidebar .widget-title {
        margin-bottom: 18px;
    }
    .storefront-blog-search {
        display: flex;
        gap: 8px;
        padding: 0 15px;
    }
    .storefront-blog-search input {
        border: 1px solid #d2dfd5;
        height: 42px;
        min-width: 0;
        padding: 0 10px;
        width: 100%;
    }
    .storefront-blog-search button {
        background: #ca7101;
        border: 0;
        color: #fff;
        min-width: 42px;
    }
    .storefront-blog-sidebar .widget-link a.active {
        color: #ca7101;
        font-weight: 700;
    }
    .storefront-recent-post {
        align-items: center;
        display: flex;
        gap: 12px;
    }
    .storefront-recent-post img {
        height: 64px;
        object-fit: cover;
        width: 78px;
    }
    .storefront-recent-post a {
        display: block;
        font-weight: 600;
        line-height: 1.35;
    }
    .storefront-recent-post span {
        color: #777;
        display: block;
        font-size: 12px;
        margin-top: 4px;
    }
    .storefront-blog-detail .title {
        font-size: 30px;
        line-height: 1.3;
    }
    .storefront-blog-detail .article-content {
        color: #555;
        line-height: 1.86;
    }
    .storefront-blog-detail .article-content p {
        margin-bottom: 15px;
    }
    .storefront-blog-detail-image {
        max-height: 560px;
        object-fit: cover;
    }
    .storefront-catalog-section,
    .storefront-content-section,
    .storefront-auth-section,
    .storefront-status-section,
    .storefront-product-details-section {
        padding: 54px 0 80px;
    }
    .storefront-product-card .product-image img {
        aspect-ratio: 4 / 5;
        object-fit: cover;
        width: 100%;
    }
    .storefront-catalog-toolbar {
        align-items: center;
        border-bottom: 1px solid #e9dfcf;
        display: flex;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 16px;
    }
    .storefront-catalog-toolbar p {
        margin: 0;
    }
    .storefront-catalog-toolbar select {
        min-width: 190px;
    }
    .storefront-catalog-sidebar {
        border: 1px solid #ebdfcc;
        padding: 22px;
    }
    .storefront-catalog-sidebar .widget-link ul ul {
        margin: 7px 0 3px 14px;
    }
    .storefront-check-list label,
    .storefront-checkout-switch label {
        align-items: center;
        display: flex;
        gap: 8px;
        margin: 9px 0;
    }
    .storefront-variation select {
        display: inline-block;
        margin-left: 12px;
        max-width: 230px;
    }
    .cart-table .product-quantity input {
        appearance: textfield;
    }
    .cart-table .product-quantity input::-webkit-inner-spin-button,
    .cart-table .product-quantity input::-webkit-outer-spin-button {
        appearance: none;
        margin: 0;
    }
    .storefront-shipping-country {
        align-items: center;
        background: #fffdf9;
        border: 1px solid #ded7cb;
        display: flex;
        font-size: 16px;
        gap: 10px;
        padding: 14px 16px;
    }
    .storefront-shipping-country i {
        color: #ca7101;
    }
    .storefront-shipping-note {
        color: #777;
        font-size: 13px;
        margin: 8px 0 0;
    }
    .storefront-profile-upload {
        align-items: center;
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }
    .storefront-profile-upload img {
        border: 1px solid #e5d7bc;
        border-radius: 50%;
        height: 104px;
        object-fit: cover;
        width: 104px;
    }
    .storefront-profile-upload p {
        color: #777;
        font-size: 13px;
        margin: 8px 0 0;
    }
    .storefront-checkout-switch,
    .storefront-form-card,
    .storefront-user-section,
    .storefront-contact-card {
        background: #fffdf9;
        border: 1px solid #ebdfcc;
        margin-bottom: 20px;
        padding: 22px;
    }
    .storefront-checkout-address {
        margin-top: 32px;
    }
    .storefront-checkout-address + .storefront-checkout-address {
        border-top: 1px solid #ebdfcc;
        padding-top: 32px;
    }
    .storefront-form-card h3,
    .storefront-user-section h2 {
        font-size: 21px;
        margin-bottom: 16px;
    }
    .storefront-empty-state,
    .storefront-status-card {
        background: #fffdf9;
        border: 1px solid #ebdfcc;
        padding: 48px 28px;
        text-align: center;
    }
    .storefront-status-card {
        margin: auto;
        max-width: 760px;
    }
    .storefront-status-card h1,
    .storefront-empty-state h2 {
        margin-bottom: 14px;
    }
    .storefront-status-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    .storefront-status-error {
        border-color: #d6a6a6;
    }
    .storefront-page-image {
        margin-bottom: 26px;
        max-height: 440px;
        object-fit: cover;
        width: 100%;
    }
    .storefront-page-lead,
    .storefront-rich-content {
        color: #5f5f5f;
        line-height: 1.85;
    }
    .storefront-faq-group + .storefront-faq-group {
        margin-top: 32px;
    }
    .storefront-faq-group h2 {
        font-size: 24px;
        margin-bottom: 14px;
    }
    .storefront-auth-section .storefront-form-card {
        margin: auto;
        max-width: 650px;
    }
    .storefront-user-page-title {
        border-bottom: 1px solid #ebdfcc;
        margin-bottom: 24px;
        padding-bottom: 14px;
    }
    .storefront-user-page-title h1 {
        font-size: 31px;
        margin-bottom: 7px;
    }
    .storefront-user-page-title p {
        color: #707070;
        margin: 0;
    }
    .storefront-dashboard-grid {
        display: grid;
        gap: 16px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-bottom: 28px;
    }
    .storefront-dashboard-grid a {
        background: #fffdf9;
        border: 1px solid #ebdfcc;
        padding: 22px;
        text-align: center;
    }
    .storefront-dashboard-grid strong,
    .storefront-dashboard-grid span {
        display: block;
    }
    .storefront-dashboard-grid strong {
        color: #ca7101;
        font-size: 30px;
    }
    .storefront-address-card {
        border-top: 1px solid #ebdfcc;
        padding: 15px 0;
    }
    .storefront-address-card h4 {
        font-size: 18px;
    }
    .storefront-address-card p {
        color: #666;
        line-height: 1.7;
    }
    .storefront-orders-accordion .accordion-button:not(.collapsed) {
        background: #fff4e2;
        color: #7a4400;
    }
    @media (max-width: 991px) {
        .storefront-blog-sidebar {
            margin-top: 30px;
        }
        .storefront-catalog-sidebar {
            margin-top: 28px;
        }
    }
    @media (max-width: 575px) {
        .storefront-dashboard-grid {
            grid-template-columns: 1fr;
        }
        .storefront-catalog-toolbar {
            align-items: flex-start;
            gap: 12px;
            flex-direction: column;
        }
    }
</style>
