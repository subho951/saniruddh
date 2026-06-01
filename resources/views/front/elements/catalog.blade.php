@php
    $catalogProducts = isset($getProducts) ? collect($getProducts) : $products;
    $isSubcategoryPage = isset($child_id);
    $catalogCategory = $isSubcategoryPage ? $subcategory : $getCategory;
    $catalogParent = $getCategory;
@endphp

@include('front.elements.page-banner', [
    'pageTitle' => $catalogCategory->category_name,
    'breadcrumbs' => [
        ['label' => $catalogParent->category_name, 'url' => url('products/'.$catalogParent->slug)],
        ['label' => $catalogCategory->category_name],
    ],
])

<div class="section storefront-catalog-section">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="storefront-catalog-toolbar">
                    <p>{{ $catalogProducts->count() }} products found</p>
                    @if(isset($child_id))
                        <form action="{{ url('product-sorting/'.$slug1.'/'.\App\Helpers\Helper::encoded($child_id)) }}" method="get">
                            <select name="filter_by" class="form-select" onchange="this.form.submit()">
                                <option value="">Sort products</option>
                                <option value="name-asc" {{ ($filter_by ?? '') == 'name-asc' ? 'selected' : '' }}>Name, A to Z</option>
                                <option value="name-desc" {{ ($filter_by ?? '') == 'name-desc' ? 'selected' : '' }}>Name, Z to A</option>
                                <option value="price-asc" {{ ($filter_by ?? '') == 'price-asc' ? 'selected' : '' }}>Price, low to high</option>
                                <option value="price-desc" {{ ($filter_by ?? '') == 'price-desc' ? 'selected' : '' }}>Price, high to low</option>
                            </select>
                        </form>
                    @endif
                </div>

                @if($catalogProducts->isNotEmpty())
                    <div class="row">
                        @foreach($catalogProducts as $catalogProduct)
                            <div class="col-md-4 col-sm-6">
                                @include('front.elements.product-card', [
                                    'cardProduct' => $catalogProduct,
                                    'cardCategoryName' => 'Category: '.$catalogParent->category_name,
                                    'cardCategoryUrl' => url('products/'.$catalogParent->slug),
                                    'cardLabel' => $loop->even ? 'Popular' : 'New',
                                ])
                            </div>
                        @endforeach
                    </div>
                    @if($catalogProducts instanceof \Illuminate\Contracts\Pagination\Paginator && $catalogProducts->hasPages())
                        <div class="page-pagination mt-5">{{ $catalogProducts->links('pagination::bootstrap-4') }}</div>
                    @endif
                @else
                    @include('front.elements.notice', [
                        'noticeType' => 'info',
                        'noticeTitle' => 'No products found',
                        'noticeMessage' => 'No products matched your selection.',
                    ])
                @endif
            </div>

            <div class="col-lg-3">
                <div class="sidebar-widget storefront-catalog-sidebar">
                    <div class="widget-item">
                        <h4 class="widget-title">Shop Categories</h4>
                        <div class="widget-link">
                            <ul>
                                @foreach($parentCats as $parentCat)
                                    <li>
                                        <a href="{{ url('products/'.$parentCat->slug) }}">{{ $parentCat->category_name }}</a>
                                        @if($parentCat->id == $catalogParent->id)
                                            <ul>
                                                @foreach($childCats->get($parentCat->id, collect()) as $childCat)
                                                    <li><a href="{{ url('products/'.$parentCat->slug.'/'.$childCat->slug) }}">{{ $childCat->category_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    @if($isSubcategoryPage && isset($filterAttributes) && $filterAttributes->isNotEmpty())
                        <form action="{{ url('products/'.$slug1.'/'.$slug2) }}" method="post">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                            <input type="hidden" name="child_id" value="{{ $child_id }}">
                            <input type="hidden" name="min_price" value="{{ $minPrice ?: 0 }}">
                            <input type="hidden" name="max_price" value="{{ $maxPrice ?: 999999 }}">
                            @foreach($filterAttributes as $filterAttribute)
                                <div class="widget-item">
                                    <h4 class="widget-title">{{ $filterAttribute->name }}</h4>
                                    <div class="storefront-check-list">
                                        @foreach($filterAttribute->values as $filterValue)
                                            <label>
                                                <input type="checkbox" name="attr_vals{{ $filterAttribute->id }}[]" value="{{ $filterAttribute->id.'-'.$filterValue->id }}" {{ in_array($filterAttribute->id.'-'.$filterValue->id, $category_filter ?? []) ? 'checked' : '' }}>
                                                <span>{{ $filterValue->attr_value }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button class="btn btn-primary btn-hover-dark rounded-pill mt-4" type="submit">Apply Filters</button>
                        </form>
                    @elseif(! $isSubcategoryPage && $subcategory->isNotEmpty())
                        <form action="{{ url('products/'.$getCategory->slug) }}" method="post">
                            @csrf
                            <div class="widget-item">
                                <h4 class="widget-title">Subcategories</h4>
                                <div class="storefront-check-list">
                                    @foreach($subcategory as $childCategory)
                                        <label>
                                            <input type="checkbox" name="subcat[]" value="{{ $childCategory->id }}" {{ in_array($childCategory->id, $filter_subcat ?? []) ? 'checked' : '' }}>
                                            <span>{{ $childCategory->category_name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary btn-hover-dark rounded-pill mt-4" type="submit">Apply Filters</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
