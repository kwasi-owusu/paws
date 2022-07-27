<?php
require_once '../../template/index.php';

require_once('../../inventory/controller//TotalReorderLimit.php');
$getReOrderLimit = TotalReorderLimit::getReorderRule();
$reOrderLimit = $getReOrderLimit->rowCount();

require_once('../../sales/controller/TodayOrdersController.php');
$ordersThisMonth = TodayOrdersController::ordersThisMonth();

require_once '../../inventory/controller/GetInventoryValueCtr.php';
$getInvVal = GetInventoryValueCtr::totalInvVal();
$fetchTotalValue = $getInvVal->fetch(PDO::FETCH_ASSOC);

require_once('../../sales/controller/TodayOrdersController.php');
$listOrders = TodayOrdersController::dashboardOrdersThisMonth();
$topFiveSelling = TodayOrdersController::topSellingThisMonth();
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <div class="widget widget-content-area br-4">
                    <div class="widget-one">

                        <div class="container-fluid">
                            <div class="widget-heading" style="padding-top: 10px;">
                                <h5 class="">Summaries for this month.</h5>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card component-card_5" title="This represents the total number of inventory Items that reached their re-order limit">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(237, 17, 17);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                                                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                        <line x1="12" y1="9" x2="12" y2="13"></line>
                                                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                    </svg>
                                                </div>
                                                <h5 class="card-title" style="color:#fff;"><?php echo isset($reOrderLimit) ? $reOrderLimit : 0; ?></h5>
                                                <p class="card-text">Re-Order Limit Reached.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_b" title="This represents the total number Orders received for today">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                                        <circle cx="9" cy="21" r="1"></circle>
                                                        <circle cx="20" cy="21" r="1"></circle>
                                                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                                    </svg>
                                                </div>
                                                <h5 class="card-title" style="color:#fff;"><?php echo isset($ordersThisMonth) ? $ordersThisMonth : "0.00"; ?></h5>
                                                <p class="card-text">Total Orders.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_c" title="Total Number of your Items currently in the Wishlist of the E-Commerce users">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                                    </svg>
                                                </div>
                                                <h5 class="card-title" style="color:#fff;">0</h5>
                                                <p class="card-text">Total Items in Wishlist.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_d" title="Total Number of your Items currently in  Shopping Cart by the E-Commerce users">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square">
                                                        <polyline points="9 11 12 14 22 4"></polyline>
                                                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                                    </svg>
                                                </div>
                                                <h5 class="card-title" style="color:#fff;">0</h5>
                                                <p class="card-text">Total Items in Cart.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card component-card_5_e" title="Total Revenue from both E-commerce and Physical Shop (if any)">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                                        <rect x="3" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="14" width="7" height="7"></rect>
                                                        <rect x="3" y="14" width="7" height="7"></rect>
                                                    </svg>
                                                </div>
                                                <h5 style="color:#fff;">15000</h5>
                                                <p class="card-text">Total Revenue.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_f" title="Total Value of all your Inventory in the System">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize">
                                                        <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                                                    </svg>
                                                </div>
                                                <h5 style="color:#fff;"><?php echo isset($fetchTotalValue['totalVal']) ? number_format($fetchTotalValue['totalVal'], 2) : "0.00" ?></h5>
                                                </h5>
                                                <p class="card-text">Total Inventory Value.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_g" title="Total Value of your Price Quotes that are yet to be converted to Sales">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(237, 17, 17);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-square">
                                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        <line x1="15" y1="9" x2="9" y2="15"></line>
                                                    </svg>
                                                </div>
                                                <h5 style="color:#fff;">21</h5>
                                                <p class="card-text">Total Value of Lost Leads.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card component-card_5_h" title="Total Value of your Price Quotes that have been converted to Sales">
                                        <a href="javascript:void(0);">
                                            <div class="card-body">
                                                <div class="icon-svg" style="color:rgb(182, 255, 239);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                    </svg>
                                                </div>
                                                <h5 style="color:#fff;">30</h5>
                                                <p class="card-text">Total Value of Won Leads.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Revenue Chart</h5>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">Weekly</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Monthly</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Yearly</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div id="revenueMonthly"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-three">
                            <div class="widget-heading">
                                <h5 class="">Summary</h5>

                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">View Report</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Edit Report</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Mark as Done</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="widget-content">

                                <div class="order-summary">

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Sales Revenue</h6>
                                                <p class="summary-count">$92,600</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                <line x1="7" y1="7" x2="7" y2="7"></line>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Profit</h6>
                                                <p class="summary-count">$37,515</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card">
                                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                                <line x1="1" y1="10" x2="23" y2="10"></line>
                                            </svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Expenses</h6>
                                                <p class="summary-count">$55,085</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    <div class="widget-heading">
                        <h5 class="">Recent Orders for the Month</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Order No</th>
                                        <th>Customer Name</th>
                                        <th>Approval Status</th>
                                        <th>Delivery Date</th>
                                        <th>Fulfilled Status</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Order No</th>
                                        <th>Customer Name</th>
                                        <th>Approval Status</th>
                                        <th>Delivery Date</th>
                                        <th>Fulfilled Status</th>
                                        <!--                                                <th class="disabled-sorting text-right">Actions</th>-->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($listOrders as $od) {
                                        //approval_status: 0 = for all new sales orders; 1 = Approved; 3 = rejected
                                        $status = '';

                                        $approval_status = $od['approval_status'];
                                        switch ($approval_status) {
                                            case 0:
                                                $status .= "Pending";
                                                break;

                                            case 1:
                                                $status .= "Approved";
                                                break;

                                            case 2:
                                                $status .= "Rejected";
                                                break;

                                            default:
                                                $status .= "";
                                        }

                                        //fulfilled_status: 0 =pending; 1 = fulfilled; 2 = Partial fulfillment
                                        $del_status = '';
                                        $delivery_status = $od['fulfilled_status'];
                                        switch ($delivery_status) {
                                            case 0:
                                                $del_status .= "Pending";
                                                break;

                                            case 1:
                                                $del_status .= "Fulfilled";
                                                break;

                                            case 2:
                                                $del_status .= "Partial Fulfillment";
                                                break;

                                            default:
                                                $del_status .= "";
                                        }
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $od['order_No']; ?></td>
                                            <td><?php echo $od['customa_name']; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $od['delivery_dt']; ?></td>
                                            <td><?php echo $del_status; ?></td>

                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">

                    <div class="widget-heading">
                        <h5 class="">Top Selling Product for this Month</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Item</th>
                                        <th>Item Code</th>
                                        <th>Total Sales</th>
                                        

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <th></th>
                                        <th>Item</th>
                                        <th>Item Code</th>
                                        <th>Total Sales</th>
                                        <!--                                                <th class="disabled-sorting text-right">Actions</th>-->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($topFiveSelling as $ts) {
                                      
                                    ?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $ts['inventory_name']; ?></td>
                                            <td><?php echo $ts['inventory_code']; ?></td>
                                            <td><?php echo $ts['grandTotal']; ?></td>

                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="container-fluid">
                <div class="row">

                    <div class="col-sm-12 col-lg-12 col-md-12 layout-spacing">

                        <div class="widget widget-content-area br-4">
                            <div class="widget-one">

                                <div class="container-fluid">





                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<?php

require_once '../../template/footer.php';
?>


</body>

</html>