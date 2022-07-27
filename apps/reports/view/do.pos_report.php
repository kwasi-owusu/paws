<?php
require_once('../../pos/controller/CTRPOSSalesReport.php');
$allTime = CTRPOSSalesReport::allTimePOSReport();
$fetchAllTime = $allTime->fetchAll();

$thisMonth = CTRPOSSalesReport::thisMonths();
$fetchThisMonth = $thisMonth->fetchAll();

$thisYr = CTRPOSSalesReport::thisYr();
$fetchThisYr = $thisYr->fetchAll();

//total sum this month
$totalThisMonth = CTRPOSSalesReport::totalThisMonth();

//total sum this year
$totalThisYr = CTRPOSSalesReport::totalThisYear();

//all time total
$totalAllTime = CTRPOSSalesReport::totalAllTime();

if (isset($_POST['searchBtn'])) {
    //$error = false;
    // collect search form inputs
    //$supplierID = trim($_POST['select_suppliers']);
    $start_date = trim($_POST['start_date']);
    $end_date   = trim($_POST['end_date']);
    //$end_date     = str_replace(" ", "-", $state_region);

    if ($start_date != '' && $end_date != '') {
        header('Location: search_pos_sales_report/' . $start_date . "/" . $end_date);
        exit();
    }

    //    if ($supplierID != '' && $start_date != '' && $end_date != '') {
    //        header('Location: ../search_supplier_purchase_history/' . $supplierID . "/" . $start_date . "/" . $end_date);
    //        exit();
    //    }
}
require_once '../../template/index.php';
?>
<div id="content" class="main-content">
    <div class="row">
        <div id="tabsVerticalWithIcon" class="col-lg-10 col-10  offset-1 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Stock Levels</h4>
                        </div>
                    </div>
                </div>

                <div class="statbox widget box box-shadow">

                    <div style="border: 2px solid #666666; border-radius: 2px; padding: 10px; margin-bottom: 10px;">
                        <h4>Advance Date Range Search</h4>
                        <hr />
                        <form id="search_supplier_po_history" action="" method="post" autocomplete="off" role="form">
                            <div class="form-group">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label for="firstName" class="bmd-label-floating"> Start Date *</label>
                                        <input type="date" class="form-control input-lg m-bot15" id="start_date" name="start_date" required value="<?php echo Date('Y-m-d'); ?>">

                                    </div>

                                    <div class="col-md-4">
                                        <label for="firstName" class="bmd-label-floating"> End Date *</label>
                                        <input type="date" class="form-control input-lg m-bot15" id="end_date" name="end_date" required value="<?php echo Date('Y-m-d'); ?>">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="firstName" class="bmd-label-floating"></label>
                                        <input type="submit" name="searchBtn" id="searchBtn" class="btn btn-primary form-control input-lg m-bot15" value="Search">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="widget-content widget-content-area border-top-tab">
                        <ul class="nav nav-tabs mb-3 mt-3" id="borderTop" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="border-top-home-tab" data-toggle="tab" href="#thisMonthSales" role="tab" aria-controls="border-top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> This Month Sales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-profile-tab" data-toggle="tab" href="#thisYearSales" role="tab" aria-controls="border-top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> This Year Sales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-contact-tab" data-toggle="tab" href="#allTimeSales" role="tab" aria-controls="border-top-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg> All Time Sales</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="borderTopContent">
                            <div class="tab-pane fade show active" id="thisMonthSales" role="tabpanel" aria-labelledby="border-top-home-tab">
                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($fetchThisMonth

                                            as $thm) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $thm['transaction_code']; ?></td>
                                                <td><?php echo $thm['customer']; ?></td>
                                                <td><?php echo $thm['sales_day']; ?></td>
                                                <td><?php echo $thm['sales_month']; ?></td>
                                                <td><?php echo $thm['sales_yr']; ?></td>
                                                <td><?php echo $thm['pmt_type']; ?></td>
                                                <td><?php echo $thm['branch_owner']; ?></td>
                                                <td><?php echo $thm['final_total']; ?></td>
                                                <td><?php echo $thm['firstName'] . " " . $thm['lastName']; ?></td>

                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $thm['transaction_ID']; ?>" onclick="salesDetails(this)" data-toggle="modal" data-target="#salesDetailsModalLG">
                                                                Sales Details
                                                            </a>

                                                        </div>
                                                    </div>

                                                </td>
                                            <?php
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="thisYearSales" role="tabpanel" aria-labelledby="border-top-profile-tab">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>
                                        This Year Sales
                                    </h4>
                                </div>

                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($fetchThisYr

                                            as $tyr) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $tyr['transaction_code']; ?></td>
                                                <td><?php echo $tyr['customer']; ?></td>
                                                <td><?php echo $tyr['sales_day']; ?></td>
                                                <td><?php echo $tyr['sales_month']; ?></td>
                                                <td><?php echo $tyr['sales_yr']; ?></td>
                                                <td><?php echo $tyr['pmt_type']; ?></td>
                                                <td><?php echo $tyr['branch_owner']; ?></td>
                                                <td><?php echo $tyr['final_total']; ?></td>
                                                <td><?php echo $tyr['firstName'] . " " . $tyr['lastName']; ?></td>

                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $tyr['transaction_ID']; ?>" onclick="salesDetails(this)" data-toggle="modal" data-target="#salesDetailsModalLG">
                                                                Sales Details
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            <?php
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="allTimeSales" role="tabpanel" aria-labelledby="border-top-profile-tab">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>
                                        All Time Sales
                                    </h4>
                                </div>
                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Transaction No</th>
                                            <th>Customer Name</th>
                                            <th>Order Day</th>
                                            <th>Order Month</th>
                                            <th>Order Year</th>
                                            <th>Payment Type</th>
                                            <th>Cost Point</th>
                                            <th>Total Amount</th>
                                            <th>Sales Person</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($fetchAllTime as $alt) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $alt['transaction_code']; ?></td>
                                                <td><?php echo $alt['customer']; ?></td>
                                                <td><?php echo $alt['sales_day']; ?></td>
                                                <td><?php echo $alt['sales_month']; ?></td>
                                                <td><?php echo $alt['sales_yr']; ?></td>
                                                <td><?php echo $alt['pmt_type']; ?></td>
                                                <td><?php echo $alt['branch_owner']; ?></td>
                                                <td><?php echo $alt['final_total']; ?></td>
                                                <td><?php echo $alt['firstName'] . " " . $alt['lastName']; ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $alt['transaction_ID']; ?>" onclick="salesDetails(this)" data-toggle="modal" data-target="#salesDetailsModalLG">
                                                                Sales Details
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            <?php
                                        }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="salesDetailsModalLG" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body" id="salesDetailsModalContentLG">

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

<script src="reports/js/extra.js"></script>

</body>

</html>