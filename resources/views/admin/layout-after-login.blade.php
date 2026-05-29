<?php
use Illuminate\Support\Facades\Route;;
$routeName    = Route::current();
$pageName     = explode("/", $routeName->uri());
$pageSegment  = $pageName[0];
$pageFunction = ((count($pageName)>2)?$pageName[1]:'');
// dd($routeName);
// echo $pageSegment;
// echo $pageFunction;
// print_r($pageName);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?=$head?>
  <style type="text/css">
    :root {
      --san-theme-ink: #201608;
      --san-theme-primary: #4b3205;
      --san-theme-primary-dark: #2f2004;
      --san-theme-primary-soft: #f3ead9;
      --san-theme-gold: #c5a466;
      --san-theme-gold-strong: #9b741f;
      --san-theme-border: #deccaa;
      --san-theme-page: #ffffff;
      --san-theme-muted: #746851;
    }
    body {
      background: var(--san-theme-page);
      color: var(--san-theme-ink);
    }
    a {
      color: var(--san-theme-primary);
    }
    a:hover {
      color: var(--san-theme-gold-strong);
    }
    .header {
      background: #080704;
      border-bottom: 1px solid var(--san-theme-primary);
      box-shadow: 0 8px 22px rgba(32, 22, 8, 0.14);
    }
    .header .toggle-sidebar-btn,
    .header-nav .nav-profile,
    .header-nav .nav-profile span,
    .logo span {
      color: #fff7e8;
    }
    .header .btn,
    .header a.btn {
      border-color: var(--san-theme-gold);
    }
    #main {
      background: var(--san-theme-page);
    }
    .pagetitle h1 {
      color: var(--san-theme-primary);
      font-weight: 800;
    }
    .breadcrumb a,
    .breadcrumb .breadcrumb-item,
    .breadcrumb .active {
      color: var(--san-theme-muted);
    }
    .card {
      border: 1px solid var(--san-theme-border);
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(75, 50, 5, 0.06);
    }
    .card-title,
    .sub-title {
      color: var(--san-theme-primary);
    }
    .sidebar {
      background: #fffaf0;
      border-right: 1px solid var(--san-theme-border);
      box-shadow: 8px 0 24px rgba(75, 50, 5, 0.06);
    }
    .sidebar-nav .nav-link {
      background: transparent;
      color: var(--san-theme-primary);
      font-weight: 700;
      border-radius: 6px;
      transition: background-color .18s ease, color .18s ease, box-shadow .18s ease;
    }
    .sidebar-nav .nav-link i,
    .sidebar-nav .nav-content a i {
      color: var(--san-theme-primary);
    }
    a.nav-link.active {
      color: var(--san-theme-primary);
      background: var(--san-theme-primary-soft);
      box-shadow: inset 3px 0 0 var(--san-theme-gold-strong);
    }
    .sidebar-nav .nav-link:hover,
    .sidebar-nav .nav-link:not(.collapsed) {
      background: var(--san-theme-primary-soft);
      color: var(--san-theme-primary);
    }
    .sidebar-nav .nav-content a {
      color: var(--san-theme-muted);
      border-radius: 6px;
    }
    .sidebar-nav .nav-content a:hover,
    .sidebar-nav .nav-content a.active {
      color: var(--san-theme-primary);
      background: #f8efd9;
    }
    .table,
    .datatable-table {
      color: var(--san-theme-ink);
    }
    .table thead th,
    .global_table thead th,
    .datatable-table thead th {
      background: #000000;
      color: #fff7e8;
      border-color: #000000;
      font-weight: 700;
    }
    .table tbody tr,
    .datatable-table tbody tr {
      border-color: var(--san-theme-border);
    }
    .table tbody tr:hover,
    .datatable-table tbody tr:hover {
      background: #fff7e8;
    }
    .table > :not(caption) > * > * {
      border-bottom-color: var(--san-theme-border);
    }
    .dataTable-selector,
    .dataTable-input,
    .form-control,
    .form-select {
      border-color: var(--san-theme-border);
    }
    .dataTable-selector:focus,
    .dataTable-input:focus,
    .form-control:focus,
    .form-select:focus {
      border-color: var(--san-theme-gold-strong);
      box-shadow: 0 0 0 .2rem rgba(155, 116, 31, .18);
    }
    .dataTable-pagination a,
    .page-link {
      color: var(--san-theme-primary);
    }
    .dataTable-pagination .active a,
    .page-item.active .page-link {
      background: var(--san-theme-primary);
      border-color: var(--san-theme-primary);
      color: #fff7e8;
    }
    .btn-primary,
    .btn-success,
    .btn-warning,
    .btn-info,
    .new-btn-style,
    .footer-btn-group .bg,
    button.bg,
    a.bg {
      background: var(--san-theme-primary) !important;
      border-color: var(--san-theme-primary) !important;
      color: #fff7e8 !important;
    }
    .btn-primary:hover,
    .btn-success:hover,
    .btn-warning:hover,
    .btn-info:hover,
    .new-btn-style:hover,
    .footer-btn-group .bg:hover,
    button.bg:hover,
    a.bg:hover {
      background: var(--san-theme-primary-dark) !important;
      border-color: var(--san-theme-primary-dark) !important;
      color: #ffffff !important;
    }
    .btn-outline-primary,
    .btn-outline-success,
    .btn-outline-warning,
    .btn-outline-info {
      border-color: var(--san-theme-primary) !important;
      color: var(--san-theme-primary) !important;
    }
    .btn-outline-primary:hover,
    .btn-outline-success:hover,
    .btn-outline-warning:hover,
    .btn-outline-info:hover {
      background: var(--san-theme-primary) !important;
      border-color: var(--san-theme-primary) !important;
      color: #fff7e8 !important;
    }
    .badge.bg-success,
    .badge.bg-primary,
    .badge.bg-info {
      background: var(--san-theme-primary) !important;
      color: #fff7e8 !important;
    }
    .alert-success {
      background: #efe3cc !important;
      border-color: var(--san-theme-border) !important;
      color: var(--san-theme-primary) !important;
    }
  </style>
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <?=$header?>
  </header><!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <?=$sidebar?>
  </aside><!-- End Sidebar-->
  <main id="main" class="main">
    <?=$maincontent?>
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <?=$footer?>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/chart.js/chart.umd.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/quill/quill.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="<?=env('ADMIN_ASSETS_URL')?>assets/js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script type="text/javascript">
    $(function(){
      $('.autohide').delay(5000).fadeOut('slow');
    })
  </script>

<?php if(($pageSegment == 'notification' && ($pageFunction == 'add' || $pageFunction == 'edit')) || ($pageSegment == 'newsletter' && ($pageFunction == 'add' || $pageFunction == 'edit'))) {?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">

  <!-- Initialize the plugin: -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#to_users').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
      });
      $('#users1').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
      });
    });
  </script>
  <script type="text/javascript">
    function getUsers(user_type){
      if(user_type != ''){
        let url = '<?=url('/')?>/notification/get-user';
        $.ajax({
            type: "POST",
            url: url,
            data: {"_token": "{{ csrf_token() }}", user_type : user_type},
            dataType: "JSON",
            beforeSend: function () {
                
            },
            success: function (rply) {
              if(rply.status){
                let html  = '';
                $.each(rply.data.user_selects, function(key, item) {
                  html += '<option value="'+item.id+'">'+item.label+'</option>';
                });
                $('#users1').empty();
                $('#users1').append(html);
                $("#users1").multiselect("rebuild");
              }else{
                  
              }
            },
            error:function (xhr, ajaxOptions, thrownError){
              var res = xhr.responseJSON;
              if(xhr.status==404) {
                  alert("Something Went Wrong In Loading The Page !!!");
              }
            }
        });
      } else {
        alert('Please Select User Type !!!');
      }
    }
  </script>
<?php } ?>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css" />
  <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
        }
    }
  </script>
  <script type="module">
    import {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Strikethrough,
        Subscript,
        Superscript,
        CodeBlock,
        Font,
        Link,
        List,
        Paragraph,
        Image,
        ImageCaption,
        ImageResize,
        ImageStyle,
        ImageToolbar,
        LinkImage,
        PictureEditing,
        ImageUpload,
        CloudServices,
        CKBox,
        CKBoxImageEdit,
        SourceEditing,
        ImageInsert
    } from 'ckeditor5';

    for (let i = 0; i <= 15; i++) {
      ClassicEditor
        .create( document.querySelector( '#ckeditor' + i ), {
          plugins: [ Essentials, Bold, Italic, Strikethrough, Subscript, Superscript, CodeBlock, Font, Link, List, Paragraph, Image, ImageToolbar, ImageCaption, ImageStyle, ImageResize, LinkImage, PictureEditing, ImageUpload, CloudServices, CKBox, CKBoxImageEdit, SourceEditing, ImageInsert ],
          toolbar: {
            items: [
              'undo', 'redo',
              '|',
              'heading',
              '|',
              'sourceEditing',
              '|',
              'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'formatPainter',
              '|',
              'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
              '|',
              'link', 'uploadImage', 'blockQuote', 'codeBlock',
              '|',
              'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
              '|',
              'ckbox', 'ckboxImageEdit', 'toggleImageCaption', 'imageTextAlternative', 'ckboxImageEdit',
              '|',
              'imageStyle:block',
              'imageStyle:side',
              '|',
              'toggleImageCaption',
              'imageTextAlternative',
              '|',
              'linkImage', 'insertImage', 'insertImageViaUrl'
            ]
          },
          menuBar: {
            isVisible: true
          }
        })
        .then( /* ... */ )
        .catch( /* ... */ );
    }
  </script>
</body>
</html>
