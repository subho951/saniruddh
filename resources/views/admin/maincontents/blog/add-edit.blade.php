<?php
use App\Helpers\Helper;
$controllerRoute = $module['controller_route'];
?>
<div class="pagetitle">
  <h1><?=$page_header?></h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=url('admin/dashboard')?>">Home</a></li>
      <li class="breadcrumb-item active"><a href="<?=url('admin/' . $controllerRoute . '/list/')?>"><?=$module['title']?> List</a></li>
      <li class="breadcrumb-item active"><?=$page_header?></li>
    </ol>
  </nav>
</div>
<section class="section profile">
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
    <?php
    if($row){
      $blog_category_id = $row->blog_category_id;
      $title = $row->title;
      $blog_image = $row->blog_image;
      $short_description = $row->short_description;
      $long_description = $row->long_description;
      $publish_date = $row->publish_date;
      $meta_title = $row->meta_title;
      $meta_description = $row->meta_description;
      $meta_keywords = $row->meta_keywords;
    } else {
      $blog_category_id = '';
      $title = '';
      $blog_image = '';
      $short_description = '';
      $long_description = '';
      $publish_date = date('Y-m-d');
      $meta_title = '';
      $meta_description = '';
      $meta_keywords = '';
    }
    ?>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body pt-3">
          <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
              <label for="blog_category_id" class="col-md-2 col-lg-2 col-form-label">Blog Category</label>
              <div class="col-md-10 col-lg-10">
                <select name="blog_category_id" class="form-select" id="blog_category_id" required>
                  <option value="">Select Blog Category</option>
                  <?php if($categories){ foreach($categories as $category){?>
                    <option value="<?=$category->id?>" <?=(($category->id == $blog_category_id)?'selected':'')?>><?=$category->name?></option>
                  <?php } }?>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="title" class="col-md-2 col-lg-2 col-form-label">Title</label>
              <div class="col-md-10 col-lg-10">
                <input type="text" name="title" class="form-control" id="title" value="<?=$title?>" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="publish_date" class="col-md-2 col-lg-2 col-form-label">Publish Date</label>
              <div class="col-md-10 col-lg-10">
                <input type="date" name="publish_date" class="form-control" id="publish_date" value="<?=$publish_date?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="blog_image" class="col-md-2 col-lg-2 col-form-label">Blog Image</label>
              <div class="col-md-10 col-lg-10">
                <input type="file" name="blog_image" class="form-control" id="blog_image" <?=((!empty($row))?'':'required')?>>
                <small class="text-info">* Only JPG, JPEG, ICO, SVG, PNG, GIF, WEBP and AVIF files are allowed</small><br>
                <?php if($blog_image != ''){?>
                  <img src="<?=env('UPLOADS_URL').'blog/'.$blog_image?>" class="img-thumbnail" alt="<?=$title?>" style="width: 180px; height: 110px; margin-top: 10px; object-fit: cover;">
                <?php }?>
              </div>
            </div>
            <div class="row mb-3">
              <label for="short_description" class="col-md-2 col-lg-2 col-form-label">Short Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="short_description" class="form-control" id="short_description" rows="4"><?=$short_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="long_description" class="col-md-2 col-lg-2 col-form-label">Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="long_description" class="form-control" id="ckeditor1" rows="6"><?=$long_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="meta_title" class="col-md-2 col-lg-2 col-form-label">Meta Title</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="meta_title" class="form-control" id="meta_title" rows="3"><?=$meta_title?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="meta_description" class="col-md-2 col-lg-2 col-form-label">Meta Description</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="meta_description" class="form-control" id="meta_description" rows="3"><?=$meta_description?></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <label for="meta_keywords" class="col-md-2 col-lg-2 col-form-label">Meta Keywords</label>
              <div class="col-md-10 col-lg-10">
                <textarea name="meta_keywords" class="form-control" id="meta_keywords" rows="3"><?=$meta_keywords?></textarea>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary"><?=(($row)?'Save':'Add')?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('ckeditor1');
  }
</script>
