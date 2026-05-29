<?php
use App\Helpers\Helper;

$total_products = $total_products ?? ($total_active_products + $total_deactive_products + $total_draft_products);
$total_customers = $total_customers ?? 0;
$conversionRate = ($total_visit > 0) ? (($total_orders / $total_visit) * 100) : 0;
$avgOrderValue = ($total_orders > 0) ? ($total_sales / $total_orders) : 0;
$listingTotal = max(1, $total_active_products + $total_deactive_products + $total_draft_products);
$activityCount = (($recent_activities) ? count($recent_activities) : 0);
$orderLinks = [
   'New' => [1, 0],
   'Processing' => [2, 0],
   'Incomplete' => [3, 0],
   'Shipped' => [4, 0],
   'Complete' => [5, 0],
   'Rejected' => [6, 0],
   'Cancelled' => [7, 1],
];
$orderCards = [
   ['label' => 'New', 'count' => $total_new_orders, 'tone' => 'gold', 'icon' => 'fa-box-open'],
   ['label' => 'Processing', 'count' => $total_processing_orders, 'tone' => 'blue', 'icon' => 'fa-arrows-rotate'],
   ['label' => 'Incomplete', 'count' => $total_incomplete_orders, 'tone' => 'red', 'icon' => 'fa-circle-exclamation'],
   ['label' => 'Shipped', 'count' => $total_shipped_orders, 'tone' => 'green', 'icon' => 'fa-truck-fast'],
   ['label' => 'Complete', 'count' => $total_complete_orders, 'tone' => 'green', 'icon' => 'fa-circle-check'],
   ['label' => 'Rejected', 'count' => $total_rejected_orders, 'tone' => 'red', 'icon' => 'fa-ban'],
   ['label' => 'Cancelled', 'count' => $total_cancelled_orders, 'tone' => 'muted', 'icon' => 'fa-xmark'],
];
?>
<style>
   .premium-dashboard {
      color: #171717;
   }
   .premium-dashboard .page-kicker {
      color: #8B2525;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0;
      margin-bottom: 6px;
      text-transform: uppercase;
   }
   .premium-dashboard .dashboard-hero {
      background: #12100e;
      border: 1px solid #2c2620;
      border-radius: 8px;
      color: #ffffff;
      display: grid;
      gap: 18px;
      grid-template-columns: minmax(0, 1fr) auto;
      margin-bottom: 18px;
      padding: 22px;
   }
   .premium-dashboard .dashboard-hero h2 {
      color: #ffffff;
      font-size: 26px;
      font-weight: 800;
      line-height: 1.2;
      margin: 0 0 8px;
   }
   .premium-dashboard .dashboard-hero p {
      color: #d7d0c8;
      margin: 0;
      max-width: 760px;
   }
   .premium-dashboard .hero-actions {
      align-items: flex-end;
      display: flex;
      flex-direction: column;
      gap: 10px;
      min-width: 250px;
   }
   .premium-dashboard .filter-form {
      margin: 0;
      width: 100%;
   }
   .premium-dashboard .filter-select {
      background: #fff;
      border: 1px solid #d6c2a3;
      border-radius: 6px;
      color: #171717;
      font-weight: 600;
      min-height: 42px;
      padding: 8px 12px;
      width: 100%;
   }
   .premium-dashboard .action-row {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: flex-end;
   }
   .premium-dashboard .dash-button {
      align-items: center;
      background: #f6e3c1;
      border: 1px solid #d1b27f;
      border-radius: 6px;
      color: #711f1f;
      display: inline-flex;
      font-size: 13px;
      font-weight: 700;
      gap: 7px;
      min-height: 36px;
      padding: 8px 11px;
   }
   .premium-dashboard .dash-button.secondary {
      background: transparent;
      border-color: #5a5048;
      color: #f6e3c1;
   }
   .premium-dashboard .metric-grid {
      display: grid;
      gap: 14px;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      margin-bottom: 18px;
   }
   .premium-dashboard .metric-card,
   .premium-dashboard .panel,
   .premium-dashboard .order-card,
   .premium-dashboard .listing-stat {
      background: #ffffff;
      border: 1px solid #e8e0d5;
      border-radius: 8px;
      box-shadow: 0 10px 24px rgba(23, 23, 23, 0.05);
   }
   .premium-dashboard .metric-card {
      min-height: 138px;
      padding: 16px;
   }
   .premium-dashboard .metric-top {
      align-items: center;
      display: flex;
      justify-content: space-between;
      margin-bottom: 18px;
   }
   .premium-dashboard .metric-label,
   .premium-dashboard .panel-eyebrow {
      color: #6d6258;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0;
      text-transform: uppercase;
   }
   .premium-dashboard .metric-icon,
   .premium-dashboard .order-icon {
      align-items: center;
      border-radius: 6px;
      display: inline-flex;
      height: 38px;
      justify-content: center;
      width: 38px;
   }
   .premium-dashboard .tone-gold {
      background: #f7ead2;
      color: #9b6a18;
   }
   .premium-dashboard .tone-blue {
      background: #e7f0fb;
      color: #2f6f9f;
   }
   .premium-dashboard .tone-green {
      background: #e4f5ed;
      color: #1f7a5a;
   }
   .premium-dashboard .tone-red {
      background: #f8e8e7;
      color: #8B2525;
   }
   .premium-dashboard .tone-muted {
      background: #eeeeee;
      color: #5e5e5e;
   }
   .premium-dashboard .metric-value {
      color: #171717;
      display: block;
      font-size: 28px;
      font-weight: 800;
      line-height: 1.1;
      margin-bottom: 7px;
   }
   .premium-dashboard .metric-note {
      color: #746b61;
      font-size: 13px;
   }
   .premium-dashboard .dashboard-grid {
      display: grid;
      gap: 16px;
      grid-template-columns: minmax(0, 1.45fr) minmax(340px, 0.8fr);
   }
   .premium-dashboard .panel {
      padding: 18px;
   }
   .premium-dashboard .panel-head {
      align-items: center;
      display: flex;
      gap: 14px;
      justify-content: space-between;
      margin-bottom: 16px;
   }
   .premium-dashboard .panel-title {
      color: #171717;
      font-size: 18px;
      font-weight: 800;
      margin: 3px 0 0;
   }
   .premium-dashboard .panel-link {
      align-items: center;
      color: #8B2525;
      display: inline-flex;
      font-size: 13px;
      font-weight: 800;
      gap: 7px;
      white-space: nowrap;
   }
   .premium-dashboard .order-grid {
      display: grid;
      gap: 12px;
      grid-template-columns: repeat(2, minmax(0, 1fr));
   }
   .premium-dashboard .order-card {
      align-items: center;
      display: flex;
      gap: 12px;
      min-height: 92px;
      padding: 13px;
   }
   .premium-dashboard .order-card b {
      color: #171717;
      display: block;
      font-size: 22px;
      line-height: 1.1;
   }
   .premium-dashboard .order-card span {
      color: #6d6258;
      display: block;
      font-size: 13px;
      font-weight: 700;
      margin-top: 4px;
   }
   .premium-dashboard .listing-stack {
      display: grid;
      gap: 12px;
   }
   .premium-dashboard .listing-stat {
      padding: 14px;
   }
   .premium-dashboard .listing-stat h6 {
      color: #171717;
      font-size: 14px;
      font-weight: 800;
      margin: 0;
   }
   .premium-dashboard .listing-stat strong {
      color: #171717;
      font-size: 22px;
      line-height: 1;
   }
   .premium-dashboard .listing-stat-head {
      align-items: center;
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
   }
   .premium-dashboard .progress-rail {
      background: #eee7df;
      border-radius: 999px;
      height: 7px;
      overflow: hidden;
   }
   .premium-dashboard .progress-fill {
      border-radius: 999px;
      display: block;
      height: 100%;
      min-width: 3px;
   }
   .premium-dashboard .progress-fill.active {
      background: #1f7a5a;
   }
   .premium-dashboard .progress-fill.deactive {
      background: #8B2525;
   }
   .premium-dashboard .progress-fill.draft {
      background: #c1954a;
   }
   .premium-dashboard .activity-list {
      display: grid;
      gap: 11px;
   }
   .premium-dashboard .activity-item {
      align-items: center;
      border: 1px solid #eee7df;
      border-radius: 8px;
      display: grid;
      gap: 12px;
      grid-template-columns: 44px minmax(0, 1fr);
      min-height: 72px;
      padding: 10px;
   }
   .premium-dashboard .activity-item img,
   .premium-dashboard .activity-avatar {
      border-radius: 50%;
      height: 44px;
      object-fit: cover;
      width: 44px;
   }
   .premium-dashboard .activity-avatar {
      align-items: center;
      background: #f7ead2;
      color: #8B2525;
      display: flex;
      justify-content: center;
   }
   .premium-dashboard .activity-item a {
      color: #171717;
      display: block;
      font-size: 14px;
      font-weight: 700;
      line-height: 1.35;
      overflow-wrap: anywhere;
   }
   .premium-dashboard .activity-time {
      color: #766d64;
      font-size: 12px;
      margin-top: 5px;
   }
   .premium-dashboard .empty-state {
      align-items: center;
      border: 1px dashed #d6c2a3;
      border-radius: 8px;
      color: #6d6258;
      display: flex;
      min-height: 96px;
      padding: 16px;
   }
   @media (max-width: 1199px) {
      .premium-dashboard .metric-grid {
         grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .premium-dashboard .dashboard-grid {
         grid-template-columns: 1fr;
      }
   }
   @media (max-width: 767px) {
      .premium-dashboard .dashboard-hero {
         grid-template-columns: 1fr;
         padding: 18px;
      }
      .premium-dashboard .hero-actions {
         align-items: stretch;
         min-width: 0;
      }
      .premium-dashboard .action-row {
         justify-content: flex-start;
      }
      .premium-dashboard .metric-grid,
      .premium-dashboard .order-grid {
         grid-template-columns: 1fr;
      }
      .premium-dashboard .dashboard-hero h2 {
         font-size: 23px;
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

<section class="section dashboard premium-dashboard">
   <div class="dashboard-hero">
      <div>
         <div class="page-kicker">Saniruddh Admin</div>
         <h2>Command center for orders, listings and customer movement.</h2>
         <p><?=$filter_keyword_text?> snapshot with <?=$total_orders?> orders, <?=number_format($total_active_products)?> active listings and <?=number_format($activityCount)?> recent activity records.</p>
      </div>
      <div class="hero-actions">
         <form method="GET" name="PostName" action="<?=url('admin/dashboard-filter')?>" class="filter-form">
            @csrf
            <input type="hidden" name="mode" value="filter">
            <select class="filter-select" name="filter_keyword" onchange="PostName.submit()">
               <option value="" <?=(($filter_keyword == '')?'selected':'')?>>All Time</option>
               <option value="today" <?=(($filter_keyword == 'today')?'selected':'')?>>Today</option>
               <option value="yesterday" <?=(($filter_keyword == 'yesterday')?'selected':'')?>>Yesterday</option>
               <option value="this_month" <?=(($filter_keyword == 'this_month')?'selected':'')?>>This Month</option>
               <option value="last_month" <?=(($filter_keyword == 'last_month')?'selected':'')?>>Last Month</option>
               <option value="last_7_days" <?=(($filter_keyword == 'last_7_days')?'selected':'')?>>Last 7 Days</option>
               <option value="last_30_days" <?=(($filter_keyword == 'last_30_days')?'selected':'')?>>Last 30 Days</option>
               <option value="this_year" <?=(($filter_keyword == 'this_year')?'selected':'')?>>This Year</option>
               <option value="last_year" <?=(($filter_keyword == 'last_year')?'selected':'')?>>Last Year</option>
            </select>
         </form>
         <div class="action-row">
            <a class="dash-button" href="<?=url('admin/orders/list/'.Helper::encoded(1).'/'.Helper::encoded(0))?>"><i class="fa-solid fa-cart-shopping"></i> Orders</a>
            <a class="dash-button secondary" href="<?=url('admin/product/list')?>"><i class="fab fa-product-hunt"></i> Listings</a>
            <a class="dash-button secondary" href="<?=url('admin/stats')?>"><i class="fa-solid fa-chart-line"></i> Stats</a>
         </div>
      </div>
   </div>

   <div class="metric-grid">
      <div class="metric-card">
         <div class="metric-top">
            <span class="metric-label">Revenue</span>
            <span class="metric-icon tone-gold"><i class="fa-solid fa-indian-rupee-sign"></i></span>
         </div>
         <span class="metric-value"><?=number_format($total_sales,2)?></span>
         <span class="metric-note">Avg order <?=number_format($avgOrderValue,2)?></span>
      </div>
      <div class="metric-card">
         <div class="metric-top">
            <span class="metric-label">Orders</span>
            <span class="metric-icon tone-blue"><i class="fa-solid fa-bag-shopping"></i></span>
         </div>
         <span class="metric-value"><?=number_format($total_orders)?></span>
         <span class="metric-note"><?=number_format($conversionRate,2)?>% visit to order</span>
      </div>
      <div class="metric-card">
         <div class="metric-top">
            <span class="metric-label">Visitors</span>
            <span class="metric-icon tone-green"><i class="fa-solid fa-users-viewfinder"></i></span>
         </div>
         <span class="metric-value"><?=number_format($total_visit)?></span>
         <span class="metric-note"><?=number_format($total_view)?> total views</span>
      </div>
      <div class="metric-card">
         <div class="metric-top">
            <span class="metric-label">Customers</span>
            <span class="metric-icon tone-red"><i class="fa-solid fa-user-group"></i></span>
         </div>
         <span class="metric-value"><?=number_format($total_customers)?></span>
         <span class="metric-note"><?=number_format($total_products)?> total listings</span>
      </div>
   </div>

   <div class="dashboard-grid">
      <div class="panel">
         <div class="panel-head">
            <div>
               <div class="panel-eyebrow">Fulfillment</div>
               <h3 class="panel-title">Open Order Pipeline</h3>
            </div>
            <a class="panel-link" href="<?=url('admin/orders/list/'.Helper::encoded(1).'/'.Helper::encoded(0))?>">All orders <i class="fa-solid fa-arrow-right"></i></a>
         </div>
         <div class="order-grid">
            <?php foreach($orderCards as $orderCard){?>
               <?php $linkParts = $orderLinks[$orderCard['label']]; ?>
               <a class="order-card" href="<?=url('admin/orders/list/'.Helper::encoded($linkParts[0]).'/'.Helper::encoded($linkParts[1]))?>">
                  <span class="order-icon tone-<?=$orderCard['tone']?>"><i class="fa-solid <?=$orderCard['icon']?>"></i></span>
                  <span>
                     <b><?=number_format($orderCard['count'])?></b>
                     <span><?=$orderCard['label']?> orders</span>
                  </span>
               </a>
            <?php }?>
         </div>
      </div>

      <div class="panel">
         <div class="panel-head">
            <div>
               <div class="panel-eyebrow">Catalog</div>
               <h3 class="panel-title">Listing Health</h3>
            </div>
            <a class="panel-link" href="<?=url('admin/product/list')?>">Manage <i class="fa-solid fa-arrow-right"></i></a>
         </div>
         <div class="listing-stack">
            <div class="listing-stat">
               <div class="listing-stat-head">
                  <h6>Active Listing</h6>
                  <strong><?=number_format($total_active_products)?></strong>
               </div>
               <div class="progress-rail"><span class="progress-fill active" style="width: <?=round(($total_active_products / $listingTotal) * 100, 2)?>%;"></span></div>
            </div>
            <div class="listing-stat">
               <div class="listing-stat-head">
                  <h6>Deactive Listing</h6>
                  <strong><?=number_format($total_deactive_products)?></strong>
               </div>
               <div class="progress-rail"><span class="progress-fill deactive" style="width: <?=round(($total_deactive_products / $listingTotal) * 100, 2)?>%;"></span></div>
            </div>
            <div class="listing-stat">
               <div class="listing-stat-head">
                  <h6>Draft Listing</h6>
                  <strong><?=number_format($total_draft_products)?></strong>
               </div>
               <div class="progress-rail"><span class="progress-fill draft" style="width: <?=round(($total_draft_products / $listingTotal) * 100, 2)?>%;"></span></div>
            </div>
         </div>
      </div>
   </div>

   <div class="panel mt-3">
      <div class="panel-head">
         <div>
            <div class="panel-eyebrow">Activity</div>
            <h3 class="panel-title">Recent Activity</h3>
         </div>
         <a class="panel-link" href="<?=url('admin/user-all-activity')?>">View all <i class="fa-solid fa-arrow-right"></i></a>
      </div>
      <?php if($recent_activities && count($recent_activities) > 0){?>
         <div class="activity-list">
            <?php foreach($recent_activities as $recent_activity){?>
               <div class="activity-item">
                  <?php if($recent_activity->profile_image != ''){?>
                     <img src="<?=env('UPLOADS_URL').'user/'.$recent_activity->profile_image?>" alt="User">
                  <?php } else {?>
                     <span class="activity-avatar"><i class="fa-solid fa-user"></i></span>
                  <?php }?>
                  <div>
                     <a href="<?=url('admin/user-all-activity')?>"><?=$recent_activity->comment?></a>
                     <div class="activity-time"><i class="fa-regular fa-clock"></i> <?=date_format(date_create($recent_activity->created_at), "M d, Y h:i A")?></div>
                  </div>
               </div>
            <?php }?>
         </div>
      <?php } else {?>
         <div class="empty-state">No recent activity yet.</div>
      <?php }?>
   </div>
</section>
