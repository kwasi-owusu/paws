<?php

require_once '../../template/pos_template.php';

require_once 'DoPOSCors.php';
$page_name         = "do_sell_with_pos";
$token             = DoPOSCors::posCors($page_name);
$_SESSION['pos_token'] = $token;

require_once('../../sales/controller/FetchSellableItems.php');
$itemRst = FetchSellableItems::callSellableItems();
$fetchRst = $itemRst->fetchAll();

require_once('../controller/GetMyTodaySales.php');
$mySales = GetMyTodaySales::TodaySalesItems();
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-one">
                            <div class="widget-heading">
                                <h5 class="">Point of Sales</h5>
                                <div class="task-action">

                                </div>
                            </div>

                            <div class="widget-content">
                                <form action="" method="post" id="point_of_sale_form" autocomplete="off">


                                    <div style="height: 560px; overflow:scroll;">
                                        <div class="row">
                                            <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                                <table class="table pos_tbl" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th width="2%"><input id="check_all" class="formcontrol" type="checkbox" />
                                                            </th>
                                                            <th width="2%"></th>
                                                            <th width="2%"></th>
                                                            <th width="35%">Item</th>
                                                            <th width="15%">Price</th>
                                                            <th width="15%">Qty</th>
                                                            <th width="15%">Sub Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
                                                <button class="btn btn-danger delete" type="button">-</button>
                                            </div>

                                        </div>

                                        <div class="row" style="padding: 20px;">
                                            <div class="col-xl-4 col-lg-4 col-md-4 offset-md-8 layout-spacing" style="padding: 10px;">
                                                <div class="form-group">
                                                    <label>Grand Total</label>
                                                    <input type="text" class="form-control input-lg m-bot15" id="totalAftertax" name="totalAftertax" placeholder="Total" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                </div>

                                                <div class="form-group">
                                                    <label>Amount Paid</label>
                                                    <input type="text" class="form-control input-lg m-bot15" id="amountPaid" name="amountPaid" placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0">
                                                </div>

                                                <div class="form-group">
                                                    <label>Tax</label>
                                                    <input type="text" class="form-control input-lg m-bot15" id="tax" name="tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="0" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label>Amount Due</label>
                                                    <input type="text" class="form-control input-lg m-bot15 amountDue" name="amountDue" id="amountDue" placeholder="Amount Due" readonly onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">

                                                    <input type="hidden" class="form-control input-lg m-bot15 tkn" id="tkn" name="tkn" readonly value="<?php echo $token; ?>">

                                                </div>

                                                <div class="form-group">
                                                    <label>Taxable Sales</label>
                                                    <select class="form-control" name="taxableSales" id="taxableSales" data-size="7" data-style="select-with-transition">
                                                        <option value="0">No</option>
                                                        <option value="1" selected>Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <section class="panel">
                                        <div class="row" style="padding: 5px;">
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                <button class="btn btn-danger input-lg m-bot15" onclick="pauseThisSale(this)" data-toggle="modal" data-target="#PauseThisSale">
                                                    Pause Sales <i class="fa fa-pause"></i>
                                                </button>

                                            </div>
                                            <!--/.col-->

                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                <button type="submit" class="btn btn-info input-lg m-bot15" id="saveBtn">
                                                    Make Payment <i class="fa fa-check"></i>
                                                </button>
                                            </div>

                                            <p id="responseHere"></p>

                                            <div class="col-12">
                                                <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                                            </div>

                                            <!--/.col-->
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-three">
                            <div class="widget-heading">
                                <h5 class="">Summary</h5>

                            </div>
                            <div class="widget-content">
                                <section class="panel" style="padding: 10px;">
                                    <div class="row box box-success">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label for="exampleInputPassword1">Search For Item</label>
                                            <input type="text" class="form-control input-lg m-bot15" name="searchProductHere" id="searchProductHere" placeholder="Type Here">
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <label for="exampleInputPassword1">Scan For Item</label>
                                            <input type="text" class="form-control input-lg m-bot15" name="scanProductHere" id="scanProductHere" placeholder="Scan Here" autofocus>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="container-fluid">
                                            <div class="row" id="allItemsHere" style="height: 420px; overflow:scroll;">
                                                <?php
                                                foreach ($fetchRst as $itm) {
                                                    $itmImg = $itm['item_img'];
                                                ?>

                                                    <div class="col-md-2" style="padding: 10px;">
                                                        <a href="javascript:void(0);" onclick="addMe(this)" title="<?php echo $itm['product_name']; ?>" data-id="<?php echo $itm['stock_ID']; ?>" data-nm="<?php echo $itm['product_name']; ?>" data-cst="<?php echo $itm['unit_cost']; ?>" data-code="<?php echo $itm['product_code']; ?>">
                                                            <?php
                                                            if (isset($itmImg)) {

                                                                echo "<img src='" . $itm['item_img'] . "' style='width: 85px; height: 90px;' />";
                                                            } else {

                                                                echo "<img src='pos/view/product_icon.png'
                                                     style='width: 85px; height: 90px;'/>";
                                                            }
                                                            ?>
                                                        </a>
                                                        <?php
                                                        echo "<p style='font-size: smaller;'>" . trim($itm['product_name'] . "(" . $itm['recieved_qty'] . ")") . "</p>";
                                                        ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row box box-warning" style="padding: 10px; height: 300px; overflow:scroll;">
                                            <h4>Recent Transactions</h4>
                                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Transaction No</th>
                                                        <th>Customer Name</th>
                                                        <th>Order Date</th>
                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Total</th>
                                                        <th>Amount Paid</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($mySales as $ms) {
                                                    ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?php echo $ms['transaction_code']; ?></td>
                                                            <td><?php echo $ms['customer']; ?></td>
                                                            <td><?php echo Date('Y-m-d', strtotime($ms['system_date'])); ?></td>
                                                            <td><?php echo $ms['inventory_name']; ?></td>
                                                            <td><?php echo $ms['qty']; ?></td>
                                                            <td><?php echo $ms['unit_price']; ?></td>
                                                            <td><?php echo $ms['sub_total']; ?></td>
                                                            <td><?php echo $ms['amt_paid']; ?></td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                            <polyline points="6 9 12 15 18 9"></polyline>
                                                                        </svg>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                                        <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ms['transaction_ID']; ?>" onclick="transactionDetails(this)" data-toggle="modal" data-target="#transactionDetailsModal">
                                                                            View Transaction Details
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
                                </section>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="transactionDetailsModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Transaction Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body" id="userModalContentLG">

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

</div>

<?php

require_once '../../template/pos_footer.php';
?>
<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<script src="pos/js/extra.js"></script>
<script src="pos/js/sales.js"></script>
</body>

</html>