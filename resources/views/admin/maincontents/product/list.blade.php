<?php
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
// Helper::pr(Session::all());
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<style type="text/css">
   .premium-product-list {
      color: #171717;
   }
   .premium-product-list a {
      text-decoration: none;
   }
   .premium-product-list .catalog-hero {
      background: #080704;
      border: 1px solid #221706;
      border-radius: 8px;
      color: #fff;
      margin-bottom: 18px;
      padding: 22px;
   }
   .premium-product-list .section-eyebrow {
      color: #c5a466;
      display: block;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0;
      margin-bottom: 7px;
      text-transform: uppercase;
   }
   .premium-product-list .catalog-title {
      color: #fff;
      font-size: 27px;
      font-weight: 800;
      line-height: 1.15;
      margin: 0;
   }
   .premium-product-list .catalog-subtitle {
      color: #d8d0c4;
      margin: 8px 0 0;
   }
   .premium-product-list .catalog-stats {
      display: grid;
      gap: 10px;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      margin-top: 18px;
   }
   .premium-product-list .stat-pill {
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(197, 164, 102, .35);
      border-radius: 8px;
      min-height: 72px;
      padding: 12px;
   }
   .premium-product-list .stat-pill span {
      color: #d8d0c4;
      display: block;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
   }
   .premium-product-list .stat-pill b {
      color: #fff;
      display: block;
      font-size: 24px;
      line-height: 1.1;
      margin-top: 7px;
   }
   .premium-product-list .catalog-actions {
      align-items: stretch;
      display: flex;
      flex-direction: column;
      gap: 12px;
      height: 100%;
      justify-content: flex-end;
   }
   .premium-product-list .header-search {
      align-items: center;
      background: #fff;
      border: 1px solid #deccaa !important;
      border-radius: 8px !important;
      display: grid;
      grid-template-columns: 44px minmax(0, 1fr);
      min-height: 48px;
      overflow: hidden;
      width: 100%;
   }
   .premium-product-list .header-search .btn-search {
      background: transparent;
      border: 0;
      color: #4b3205;
      height: 48px;
      width: 44px;
   }
   .premium-product-list .header-search input {
      border: 0;
      color: #171717;
      min-width: 0;
      outline: none;
      padding: 0 14px 0 0;
      width: 100%;
   }
   .premium-product-list #suggestion-section {
      background: #fff;
      border: 1px solid #deccaa;
      border-radius: 8px;
      box-shadow: 0 16px 32px rgba(23, 23, 23, .12);
      list-style: none;
      margin: 8px 0 0 !important;
      max-height: 280px;
      overflow-y: auto;
      padding: 8px;
      position: absolute;
      width: calc(100% - 24px);
      z-index: 20;
   }
   .premium-product-list .new-btn-style.add-listing {
      align-items: center;
      background: #c5a466 !important;
      border: 1px solid #c5a466 !important;
      border-radius: 8px;
      color: #080704 !important;
      display: inline-flex;
      font-weight: 800;
      justify-content: center;
      min-height: 48px;
      padding: 10px 16px;
      width: 100%;
   }
   .premium-product-list .shop-list-section-2 {
      margin-top: 0 !important;
      padding-top: 0 !important;
   }
   .premium-product-list .product-left-side-top-bar {
      background: #fff;
      border: 1px solid #deccaa;
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(75, 50, 5, .06);
      margin-bottom: 14px;
      padding: 10px 12px;
   }
   .premium-product-list .product-left-side-top-bar ul,
   .premium-product-list .stoke-details,
   .premium-product-list .product-grid-footer ul,
   .premium-product-list .product-right-side-top-1 ul {
      align-items: center;
      display: flex;
      flex-wrap: wrap;
      gap: 9px;
      list-style: none;
      margin: 0;
      padding: 0;
   }
   .premium-product-list .product-left-side-top-bar input[type="checkbox"],
   .premium-product-list .checkItem {
      accent-color: #4b3205;
      height: 18px;
      width: 18px;
   }
   .premium-product-list .product-left-side-top-bar button.bg {
      border-radius: 6px;
      font-size: 13px;
      font-weight: 700;
      min-height: 34px;
      padding: 7px 12px;
   }
   .premium-product-list .listing_box {
      display: grid;
      gap: 12px;
   }
   .premium-product-list .product-items-list {
      background: #fff;
      border: 1px solid #e4d6bd;
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(75, 50, 5, .05);
      padding: 13px;
      transition: border-color .18s ease, box-shadow .18s ease, transform .18s ease;
   }
   .premium-product-list .product-items-list:hover,
   .premium-product-list .product-items-grid:hover {
      border-color: #c5a466;
      box-shadow: 0 18px 34px rgba(75, 50, 5, .11);
      transform: translateY(-1px);
   }
   .premium-product-list .product-items-images img,
   .premium-product-list .product-img img {
      background: #f7f2e9;
      border: 1px solid #eadfc9;
      border-radius: 8px;
      object-fit: cover;
      width: 100%;
   }
   .premium-product-list .product-items-images img {
      height: 96px !important;
   }
   .premium-product-list .product-items-descr {
      align-items: flex-start;
      display: flex;
      gap: 12px;
      justify-content: space-between;
   }
   .premium-product-list .items-descr-name h2,
   .premium-product-list .product-grid-details h2 {
      color: #171717;
      font-size: 17px;
      font-weight: 800;
      line-height: 1.25;
      margin: 0;
   }
   .premium-product-list .items-descr-rating-setting {
      align-items: center;
      display: flex;
      gap: 10px;
   }
   .premium-product-list .items-setting .dropdown-toggle {
      align-items: center;
      background: #f6ead5;
      border: 1px solid #deccaa;
      border-radius: 6px;
      color: #4b3205;
      display: inline-flex;
      height: 34px;
      justify-content: center;
      width: 34px;
   }
   .premium-product-list .items-setting .dropdown-toggle:after {
      display: none;
   }
   .premium-product-list .stoke-details {
      margin-top: 13px;
   }
   .premium-product-list .stoke-details li,
   .premium-product-list .grid-stoke-details p {
      background: #faf5eb;
      border: 1px solid #eadfc9;
      border-radius: 999px;
      color: #5d503b;
      font-size: 12px;
      font-weight: 700;
      margin: 0;
      padding: 6px 10px;
   }
   .premium-product-list .badge {
      border-radius: 999px;
      font-size: 11px;
      padding: 6px 9px;
   }
   .premium-product-list .product-items-grid {
      background: #fff;
      border: 1px solid #e4d6bd;
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(75, 50, 5, .05);
      overflow: hidden;
      transition: border-color .18s ease, box-shadow .18s ease, transform .18s ease;
   }
   .premium-product-list .product-img img {
      border: 0;
      border-radius: 0;
      height: 230px;
   }
   .premium-product-list .product-grid-details {
      background: #fff;
   }
   .premium-product-list .grid-stoke-details {
      display: flex;
      flex-wrap: wrap;
      gap: 7px;
      margin-top: 12px;
   }
   .premium-product-list .product-grid-footer {
      background: #fbf8f1;
      border-color: #eadfc9 !important;
      padding: 9px;
   }
   .premium-product-list .product-grid-footer ul {
      justify-content: space-between !important;
   }
   .premium-product-list .product-right-side {
      background: #fff;
      border: 1px solid #deccaa !important;
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(75, 50, 5, .06);
      padding: 14px;
      position: sticky;
      top: 92px;
   }
   .premium-product-list .product-right-side h5,
   .premium-product-list .product-right-side label {
      color: #171717;
      font-weight: 800;
   }
   .premium-product-list .product-right-side .form-select {
      border-radius: 7px;
      min-height: 42px;
   }
   .premium-product-list .shop-tab {
      align-items: center;
      background: #f6ead5;
      border: 1px solid #deccaa;
      border-radius: 8px;
      display: inline-flex;
      gap: 4px;
      padding: 4px;
   }
   .premium-product-list .shop-tab a {
      align-items: center;
      border-radius: 6px;
      color: #4b3205;
      display: inline-flex;
      height: 34px;
      justify-content: center;
      width: 34px;
   }
   .premium-product-list .shop-tab a:hover {
      background: #fff;
   }
   .premium-product-list .shop-tab svg {
      height: 16px;
      width: 16px;
   }
   .premium-product-list .renuel-radio {
      align-items: flex-start;
      display: flex;
      gap: 8px;
   }
   .premium-product-list .renuel-radio input {
      accent-color: #4b3205;
      margin-top: 3px;
   }
   .premium-product-list .renuel-radio label {
      color: #5d503b;
      font-size: 13px;
      line-height: 1.35;
   }
   .premium-product-list .pagination-links {
      align-items: center;
      display: flex;
      gap: 8px;
      justify-content: flex-end;
   }
   .premium-product-list .pagination-links a,
   .premium-product-list .pagination-links span {
      border: 1px solid #deccaa;
      border-radius: 6px;
      color: #4b3205;
      min-width: 82px;
      padding: 7px 12px;
      text-align: center;
   }
   .premium-product-list .pagination-links span {
      color: #96856a;
   }
   .premium-product-list .relative .z-0 .inline-flex .shadow-sm {
      display: none;
   }
   .premium-product-list .choices__list--multiple .choices__item {
      background-color: #4b3205;
      border: 1px solid #4b3205;
   }
   .very-small {
      font-size: 10px;
   }
   @media (max-width: 1199px) {
      .premium-product-list .catalog-stats {
         grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .premium-product-list .product-right-side {
         margin-top: 16px;
         position: static;
      }
   }
   @media (max-width: 767px) {
      .premium-product-list .catalog-hero {
         padding: 18px;
      }
      .premium-product-list .catalog-title {
         font-size: 23px;
      }
      .premium-product-list .catalog-stats {
         grid-template-columns: 1fr;
      }
      .premium-product-list .product-items-descr {
         flex-direction: column;
      }
      .premium-product-list .product-items-images {
         margin: 10px 0;
      }
      .premium-product-list .product-img img {
         height: 260px;
      }
   }
</style>
<div class="pagetitle">
   <h1><?=$page_header?></h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
         <li class="breadcrumb-item active"><?=$page_header?></li>
      </ol>
   </nav>
</div>
<!-- End Page Title -->
<!-- Modal -->
<div class="modal fade add-product-modal-details" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <form method="POST" action="">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="staticBackdropLabel">First, tell us about your listing</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <p>This basic info helps us understand your listing and how it meets our policies. Next you can dive into the full listing form to add all the details that make your item special.</p>
               <?php
                  $defaultShopProduceItem = (($shop_produce_items) ? $shop_produce_items->firstWhere('name', 'SANIRUDDH Studio') : null);
                  if(! $defaultShopProduceItem && $shop_produce_items){
                     $defaultShopProduceItem = $shop_produce_items->first();
                  }
               ?>
               <input type="hidden" name="who_made_it" value="I did">
               <input type="hidden" name="what_is_it" value="A finished product">
               <input type="hidden" name="manufacture_year" value="2026">
               <input type="hidden" name="shop_produce_item" value="<?=(($defaultShopProduceItem)?$defaultShopProduceItem->id:0)?>">
               <?php if($tools_useds){ foreach($tools_useds as $tools_used){?>
                  <input type="hidden" name="tools_used[]" value="<?=$tools_used->id?>">
               <?php } }?>
               <div class="col-lg-12 mb-3">
                  <label for="sub_category" class="form-label">Sub Categories</label>
                  <select class="form-select" aria-label="Default select example" id="sub_category" name="sub_category" required>
                     <option value="" selected>Sub Categories</option>
                     <?php if($subcategories){ foreach($subcategories as $subcategory){?>
                        <?php
                        $getParentCategory = Category::select('id', 'category_name')->where('status', '=', 1)->where('id', '=', $subcategory->parent_id)->first();
                        ?>
                        <option value="<?=$subcategory->id?>"><?=(($getParentCategory)?$getParentCategory->category_name:'')?> - <?=$subcategory->category_name?></option>
                     <?php } }?>
                  </select>
               </div>
            </div>
            <div class="modal-footer d-flex justify-content-between" style="border:none;padding-top:0;">
               <a href="javascript:void(0);" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-outline-danger">Cancel</a>
               <ul class="footer-btn-group">
                  <li>
                     <!-- <a class="bg" href="">Continue </a> -->
                     <button type="submit" class="bg btn btn-outline-success" name="mode" value="Continue">Continue</button>
                  </li>
               </ul>
            </div>
         </div>
      </form>
   </div>
</div>
<!-------------------- Modal-end------------------------- -->
<section class="section shop-list premium-product-list">
   <div class="row">
      <div class="col-xl-12">
         @if(session('success_message'))
         <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show autohide" role="alert">
            {{ session('success_message') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
         @if(session('error_message'))
         <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show autohide" role="alert">
            {{ session('error_message') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
         @endif
      </div>
   </div>
   <div class="shop-list-section-1 catalog-hero">
      <div class="row align-items-center">
         <div class="col-lg-7">
            <span class="section-eyebrow">Inventory Desk</span>
            <h2 class="catalog-title"><?=number_format($total_products)?> products found</h2>
            <p class="catalog-subtitle">Review listings, adjust visibility, manage stock status and create new products from one focused workspace.</p>
            <div class="catalog-stats">
               <div class="stat-pill">
                  <span>All</span>
                  <b><?=number_format($all_products)?></b>
               </div>
               <div class="stat-pill">
                  <span>Active</span>
                  <b><?=number_format($active_products)?></b>
               </div>
               <div class="stat-pill">
                  <span>Deactive</span>
                  <b><?=number_format($deactive_products)?></b>
               </div>
               <div class="stat-pill">
                  <span>Draft</span>
                  <b><?=number_format($draft_products)?></b>
               </div>
            </div>
         </div>
         <div class="col-lg-5">
            <div class="catalog-actions">
               <div class="position-relative">
                  <form class="header-search border rounded-5" method="POST">
                     @csrf
                     <button type="submit" class="btn btn-search"><i class="search-icon fas fa-search"></i></button>
                     <input type="text" list="browsers" id="searchText" placeholder="Search by title, tag or SKU" name="search">
                  </form>
                  <ul id="suggestion-section" style="list-style: none;margin-left: -16px;height: 400px;overflow-y: scroll;">
                     <!-- <li>
                        <div class="row" style="border: 1px solid #00000036;padding: 1px;border-radius: 3px;background-color: #00000012;">
                           <div class="col-md-2">
                              <img src="https://admin.threecranesgallery.com/public/uploads/product/6787d94a3ea98.avif" style="width:30px; height: 30px; border-radius: 50%;">
                           </div>
                           <div class="col-md-10">
                              <span style="font-size: 12px;">Product Name</span>
                           </div>
                        </div>
                     </li> -->
                  </ul>
               </div>
               <a class="new-btn-style add-listing" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> Add a Listing</a>
            </div>
         </div>
      </div>
   </div>
   <div class="shop-list-section-2 mt-4 pt-2">
      <div class="row">
         <div class="col-lg-10">
            <form method="POST" action="">
               @csrf
               <div class="product-left-side">
                  <div class="product-left-side-top-bar">
                     <ul>
                        <li>
                           <div class="dropdown">
                              <input type="checkbox" id="checkAll" name="checkAll"/>
                              <!-- <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 <li><a class="dropdown-item" href="#">Action</a></li>
                                 <li><a class="dropdown-item" href="#">Another action</a></li>
                                 <li><a class="dropdown-item" href="#">Something else here</a></li>
                              </ul> -->
                           </div>
                        </li>
                        <li class="action-bar" style="display: none;">
                           <button type="submit" class="bg" name="mode" value="Active">Active</button>
                        </li>
                        <li class="action-bar" style="display: none;">
                           <button type="submit" class="bg" name="mode" value="Deactive">Deactive</button>
                        </li>
                        <li class="action-bar" style="display: none;">
                           <button type="submit" class="bg" name="mode" value="Delete">Delete</button>
                        </li>
                        <!-- <li>
                           <div class="dropdown">
                              <button class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">Editing option</button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                 <li><a class="dropdown-item" href="#">Action</a></li>
                                 <li><a class="dropdown-item" href="#">Another action</a></li>
                                 <li><a class="dropdown-item" href="#">Something else here</a></li>
                              </ul>
                           </div>
                        </li> -->
                     </ul>
                  </div>
                  <?php if($view_type == 'LIST'){?>
      			      <!-------------------- list-view-start------------------------- -->
                     <div class="listing_box">
                        <?php
                        if($rows){ $sl=1; foreach($rows as $row){
                        ?>
                           <div class="product-items-list <?=(($sl % 2 == 0)?'bg-color':'')?>">
                              <div class="row align-items-center">
                                 <div class="col-lg-1">
                                    <div class="product-items-checkbox text-center">
                                       <input type="checkbox" name="product_id[]" class="checkItem" value="<?=$row->id?>" id="productId<?=$row->id?>">
                                    </div>
                                 </div>
                                 <div class="col-lg-1">
                                    <div class="product-items-images">
                                       <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">
                                          <?php if($row->cover_image != ''){?>
                                             <img src="<?=env('UPLOADS_URL').'product/'.$row->cover_image?>" alt="<?=$row->name?>" style="width: 100%; height:100px;">
                                          <?php } else {?>
                                             <img src="<?=env('NO_IMAGE')?>" alt="<?=$row->name?>" class="img-thumbnail" style="width: 100%; height:100px;">
                                          <?php }?>
                                       </a>
                                    </div>
                                 </div>
                                 <div class="col-lg-10">
                                    <div class="product-items-descr">
                                       <div class="items-descr-name">
                                       <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>"><h2><?=$row->name?></h2></a>
                                       </div>
                                       <div class="items-descr-rating-setting">
                                          <div class="items-descr-rating">
                                             <?php if($row->is_feature){?>
                                                <i class="fa-solid fa-star" style="color: orange;"></i>
                                             <?php } else {?>
                                                <i class="fa-regular fa-star"></i>
                                             <?php } ?>
                                          </div>
                                          <div class="items-setting">
                                             <div class="dropdown">
                                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gear"></i></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                                   <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">Edit</a></li>
                                                   <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/copy/'.Helper::encoded($row->id))?>" onclick="return confirm('Do You Want To Copy <?=$row->name?>');">Copy</a></li>
                                                   <?php if($row->status){?>
                                                      <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>">Deactivate</a></li>
                                                   <?php } else {?>
                                                      <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>">Activate</a></li>
                                                   <?php }?>
                                                   <?php if($row->is_feature){?>
                                                      <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-feature/'.Helper::encoded($row->id))?>">Mark Not Featured</a></li>
                                                   <?php } else {?>
                                                      <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-feature/'.Helper::encoded($row->id))?>">Mark Featured</a></li>
                                                   <?php }?>
                                                   <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->id))?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');">Delete</a></li>
                                                </ul>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">
                                       <ul class="stoke-details">
                                          <li><?=$row->sub_category_name?></li>
                                          <li>$<?=number_format($row->discounted_price,2)?> <span style="text-decoration: line-through;">$<?=number_format($row->base_price,2)?></span> <span>(<?=$row->price_percentage?>)</span></li>
                                          <li><?=$row->product_sku?></li>
                                          <li>
                                             <?php if($row->status == 1){?>
                                                <span class="badge bg-success"><i class="fa fa-check"></i> Active</span>
                                             <?php } elseif($row->status == 2){?>
                                                <span class="badge bg-primary"><i class="fa fa-times"></i> Draft</span>
                                             <?php } elseif($row->status == 0){?>
                                                <span class="badge bg-danger"><i class="fa fa-times"></i> Deactive</span>
                                             <?php }?>
                                          </li>
                                       </ul>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        <?php $sl++; } }?>
                     </div>
      			      <!-------------------- list-view-end------------------------- -->
                  <?php }?>
                  <?php if($view_type == 'GRID'){?>
      			      <!-------------------- grid-view-start------------------------- -->
      			      <div class="row">
         				   <?php
                        if($rows){ foreach($rows as $row){
                        ?>
            				   <div class="col-lg-3 mb-3">
            					  <div class="product-items-grid d-flex flex-column h-100">
            						 <div class="product-img">
                                 <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">
                                    <?php if($row->cover_image != ''){?>
                                       <img src="<?=env('UPLOADS_URL').'product/'.$row->cover_image?>" alt="<?=$row->name?>">
                                    <?php } else {?>
                                       <img src="<?=env('NO_IMAGE')?>" alt="<?=$row->name?>" class="img-thumbnail">
                                    <?php }?>
                                 </a>
            						 </div>
            						 <div class="product-grid-details d-flex flex-column justify-content-between h-100">
            							<div class="p-3">
                                    <a href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">
                                       <h2><?=$row->name?></h2>
                                       <div class="grid-stoke-details">
                                       <p><?=$row->sub_category_name?></p>
                                       <p>$<?=number_format($row->discounted_price,2)?> <span style="text-decoration: line-through;">$<?=number_format($row->base_price,2)?></span> <span>(<?=$row->price_percentage?>)</span></p>
                                       <p><?=$row->product_sku?></p>
                                       </div>
                                    </a>
            							</div>
            							<div class="product-grid-footer border-top">
            							   <ul class="d-flex justify-content-center flex-wrap align-items-center">
            								  <li>
            									 <div class="form-check">
            										<input class="form-check-input checkItem" type="checkbox" name="product_id[]" value="<?=$row->id?>" id="productId<?=$row->id?>">
            									 </div>
            								  </li>
            								  <li>
                                          <?php if($row->is_feature){?>
                                             <i class="fa-solid fa-star" style="color: orange;"></i>
                                          <?php } else {?>
                                             <i class="fa-regular fa-star"></i>
                                          <?php } ?>
                                       </li>
         								      <li class="items-setting">
            									 <div class="dropdown">
            										<button class="dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-gear"></i></button>
            										<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
            										   <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/edit/'.Helper::encoded($row->id))?>">Edit</a></li>
                                             <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/copy/'.Helper::encoded($row->id))?>" onclick="return confirm('Do You Want To Copy <?=$row->name?>');">Copy</a></li>
                                             <?php if($row->status){?>
                                                <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>">Deactivate</a></li>
                                             <?php } else {?>
                                                <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-status/'.Helper::encoded($row->id))?>">Activate</a></li>
                                             <?php }?>
                                             <?php if($row->is_feature){?>
                                                <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-feature/'.Helper::encoded($row->id))?>">Mark Not Featured</a></li>
                                             <?php } else {?>
                                                <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/change-feature/'.Helper::encoded($row->id))?>">Mark Featured</a></li>
                                             <?php }?>
                                             <li><a class="dropdown-item" href="<?=url('admin/' . $controllerRoute . '/delete/'.Helper::encoded($row->id))?>" onclick="return confirm('Do You Want To Delete This <?=$module['title']?>');">Delete</a></li>
            										</ul>
            									 </div>
            								  </li>
                                      <li class="w-auto">
                                          <?php if($row->status == 1){?>
                                             <span class="badge bg-success"><i class="fa fa-check"></i> Active</span>
                                          <?php } elseif($row->status == 2){?>
                                             <span class="badge bg-primary"><i class="fa fa-times"></i> Draft</span>
                                          <?php } elseif($row->status == 0){?>
                                             <span class="badge bg-danger"><i class="fa fa-times"></i> Deactive</span>
                                          <?php }?>
                                      </li>
            							   </ul>
            							</div>
            						 </div>
            					  </div>
            				   </div>
                        <?php } }?>
      			      </div>
      			      <!-------------------- grid-view-end------------------------- -->
                  <?php }?>
               </div>
            </form>
         </div>
         <div class="col-lg-2">
            <div class="product-right-side border">
               <div class="product-right-side-top-1">
                  <ul>
                     <li>
                        <!-- <div class="form-check form-switch">
                           <label class="form-check-label" for="flexSwitchCheckChecked">Stats</label>
                           <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        </div> -->
                     </li>
                     <li>
                        <div class="shop-tab">
                           <a href="javascript:void(0);" class="product-view" data-product-view-type="GRID">
                              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="grid-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-grid-2 ">
                                 <path fill="currentColor" d="M224 80c0-26.5-21.5-48-48-48L80 32C53.5 32 32 53.5 32 80l0 96c0 26.5 21.5 48 48 48l96 0c26.5 0 48-21.5 48-48l0-96zm0 256c0-26.5-21.5-48-48-48l-96 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l96 0c26.5 0 48-21.5 48-48l0-96zM288 80l0 96c0 26.5 21.5 48 48 48l96 0c26.5 0 48-21.5 48-48l0-96c0-26.5-21.5-48-48-48l-96 0c-26.5 0-48 21.5-48 48zM480 336c0-26.5-21.5-48-48-48l-96 0c-26.5 0-48 21.5-48 48l0 96c0 26.5 21.5 48 48 48l96 0c26.5 0 48-21.5 48-48l0-96z" class=""></path>
                              </svg>
                           </a>
                           <a href="javascript:void(0);" class="product-view" data-product-view-type="LIST">
                              <i class="fa-solid fa-list"></i>
                           </a>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="row">
                  <div class="col-lg-12 mb-3">
                     <label for="exampleInputEmail1" class="form-label">Sort</label>
                     <form method="GET" name="PostName" action="<?=url('admin/product/product-sorting/')?>">
                        <input type="hidden" name="mode" value="filter">
                        <select class="form-select" aria-label="Default select example" name="filter_by" onchange="PostName.submit()">
                           <option value="" selected="" selected>None</option>
                           <option value="name-asc" <?=(($filter_by == 'name-asc')?'selected':'')?>>Name (A-Z)</option>
                           <option value="name-desc" <?=(($filter_by == 'name-desc')?'selected':'')?>>Name (Z-A)</option>
                           <option value="price-asc" <?=(($filter_by == 'price-asc')?'selected':'')?>>Price (A-Z)</option>
                           <option value="price-desc" <?=(($filter_by == 'price-desc')?'selected':'')?>>Price (Z-A)</option>
                        </select>
                     </form>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <h5>Listing Status</h5>
                     <form method="GET" name="PostName2" action="<?=url('admin/product/product-filter/')?>">
                        <input type="hidden" name="mode" value="filter">
                        <div class="renuel-radio mb-2">
                           <input type="radio" id="Status0" name="listing_status" value="-1" <?=(($filter == -1)?'checked':'')?> onchange="PostName2.submit()">
                           <label for="Status0">All (<?=$all_products?>)</label>
                        </div>
                        <div class="renuel-radio mb-2">
                           <input type="radio" id="Status1" name="listing_status" value="1" <?=(($filter == 1)?'checked':'')?> onchange="PostName2.submit()">
                           <label for="Status1">Active (<?=$active_products?>)</label>
                        </div>
                        <div class="renuel-radio mb-2">
                           <input type="radio" id="Status2" name="listing_status" value="0" <?=(($filter == 0)?'checked':'')?> onchange="PostName2.submit()">
                           <label for="Status2">Deactive (<?=$deactive_products?>)</label>
                        </div>
                        <div class="renuel-radio mb-2">
                           <input type="radio" id="Status3" name="listing_status" value="2" <?=(($filter == 2)?'checked':'')?> onchange="PostName2.submit()">
                           <label for="Status3">Draft (<?=$draft_products?>)</label>
                        </div>
                     </form>
                  </div>
                  <div class="col-lg-12 mb-3">
                     <h5>Category Tree</h5>
                     <form method="GET" name="PostName3" action="<?=url('admin/product/product-category/')?>">
                        <input type="hidden" name="mode" value="category">
                        <?php if($categories){ foreach($categories as $cat){?>
                           <div class="renuel-radio mb-2">
                              <input type="radio" id="Status<?=$cat['category_id']?>" name="listing_category" value="<?=$cat['category_id']?>" <?=(($categoryVal == $cat['category_id'])?'checked':'')?> onchange="PostName3.submit()">
                              <label for="Status<?=$cat['category_id']?>"><?=$cat['category_name']?> (<?=$cat['product_count']?>)</label>
                              <input type="hidden" name="category_name[<?=$cat['category_id']?>][]" value="<?=$cat['category_name']?>">
                           </div>
                        <?php } }?>
                     </form>
                  </div>

               </div>
            </div>
         </div>
         <!-- Pagination Links -->
      </div>
   </div>
   <div class="pagination-links mt-3">
      @if ($rows->onFirstPage())
          <span>Previous</span>
      @else
          <a href="{{ $rows->previousPageUrl() }}" class="btn btn-sm">Previous</a>
      @endif

      @if ($rows->hasMorePages())
          <a href="{{ $rows->nextPageUrl() }}" class="btn btn-sm">Next</a>
      @else
          <span>Next</span>
      @endif
   </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
   $(function(){
      $('.product-view').on('click', function(){
         var viewType         = $(this).attr('data-product-view-type');
         var base_url         = '<?=url('admin//')?>';
         $.ajax({
            type: "POST",
            url: base_url + "/product/update-product-view",
            data: {"_token": "{{ csrf_token() }}", viewType : viewType},
            dataType: "JSON",
            beforeSend: function () {
               
            },
            success: function (res) {
               // console.log(res);
               window.location.reload();
            }
         });
      });
   });
</script>
<script>
   $(document).ready(function () {
      // When the 'checkAll' checkbox is clicked
      $('#checkAll').on('change', function () {
         $('.checkItem').prop('checked', $(this).prop('checked'));
         if ($(this).prop('checked')) {
            $('.action-bar').show();
         } else {
            $('.action-bar').hide();
         }
      });

      // If any 'checkItem' checkbox is unchecked, uncheck 'checkAll'
      $('.checkItem').on('change', function () {
         // if (!$('.checkItem:checked').length) {
         //     $('#checkAll').prop('checked', false);
         //     $('.action-bar').hide();
         // } else if ($('.checkItem:checked').length === $('.checkItem').length) {
         //     $('#checkAll').prop('checked', true);
         //     $('.action-bar').show();
         // }
         if (!$('.checkItem:checked').length) {
             $('#checkAll').prop('checked', false);
             $('.action-bar').hide();
         } else {
             $('#checkAll').prop('checked', true);
             $('.action-bar').show();
         }
      });

      $('#suggestion-section').hide();
      $('#searchText').on('input', function(){
         var baseUrl = '<?=url('/')?>';
         var searchText = $('#searchText').val();
         if(searchText.length > 2){
            var settings = {
              "url": baseUrl + "/api/search-suggestion",
              "method": "POST",
              "timeout": 0,
              "headers": {
                "Key": "13ae7b7d7ba75ac286656a7a274905ca",
                "source": "ANDROID",
                "Authorization": "",
                "Content-Type": "application/json"
              },
              "data": JSON.stringify({
                "search_keyword": searchText
              }),
            };

            $.ajax(settings).done(function (response) {
               // console.log(response);
               $('#suggestion-section').show();
               var html = '';
               if(response.status){
                  $('#suggestion-section').empty();
                  $.each(response.data, function(key, value) {
                     var productLink = value.product_link;
                     html += '<li>\
                                 <div class="row" style="border: 1px solid #00000036;padding: 1px;border-radius: 3px;background-color: #00000012;">\
                                    <div class="col-md-2">\
                                       <a href="' + productLink + '"><img src="' + value.cover_image + '" style="width:30px; height: 30px; border-radius: 50%;"></a>\
                                    </div>\
                                    <div class="col-md-10" style="padding-left: 0px;">\
                                       <a href="' + productLink + '"><span style="font-size: 10px;">' + value.name + '</span></a>\
                                    </div>\
                                 </div>\
                              </li>';
                  });
                  $('#suggestion-section').html(html);
               }
            });
         }
      });
   });
</script>
