<?php
require_once '../../template/index.php';

require_once('../controller/GetAllStockLevels.php');
$stockLevels     = GetAllStockLevels::allStockLevels();

?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="w-content">
                        <span class="w-value" style="padding: 15px; font-size:20px; font-weight:bolder;">Manage Inventory</span>
                    </div>

                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Batch Number</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Item Name</th>
                                <th>Qty on Hand</th>
                                <th>Mfg Date</th>
                                <th>Expiry Date</th>
                                <th>Days to Expire</th>
                                <th>WH Stored</th>
                                <th>Storage Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Item Code</th>
                                <th>Batch Number</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Item Name</th>
                                <th>Qty on Hand</th>
                                <th>Mfg Date</th>
                                <th>Expiry Date</th>
                                <th>Days to Expire</th>
                                <th>WH Stored</th>
                                <th>Storage Address</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            foreach ($stockLevels as $sl) {
                            ?>
                                <tr>
                                    <td><?php echo $sl['product_code']; ?></td>
                                    <td><?php echo $sl['batch_num']; ?></td>
                                    <td><?php echo $sl['cat_name']; ?></td>
                                    <td><?php echo $sl['sub_cat_name']; ?></td>
                                    <td><?php echo $sl['product_name']; ?></td>
                                    <td><?php echo $sl['recieved_qty']; ?></td>
                                    <td><?php echo $sl['manu_dt']; ?></td>
                                    <td><?php echo $sl['expiry_dt']; ?></td>
                                    <td><?php echo $sl['days_to_expire']; ?></td>
                                    <td><?php echo $sl['wh_nm']; ?></td>
                                    <td><?php echo $sl['storage_address']; ?></td>
                                    <td>

                                        <div class="btn-group">
                                            <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $sl['storage_ID']; ?>" onclick="scrapInventoryRequest(this)" data-toggle="modal" data-target="#manageInventoryModalLG">
                                                    Scrap Request
                                                </a>

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $sl['storage_ID']; ?>" onclick="transferInventory(this)" data-toggle="modal" data-target="#manageInventoryModalLG">
                                                    Transfer Request
                                                </a>

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $sl['storage_ID']; ?>" onclick="inventoryCountVariance(this)" data-toggle="modal" data-target="#manageInventoryModalLG">
                                                    Count Variance
                                                </a>

                                            </div>
                                        </div>

                                    </td>
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
</div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="manageInventoryModalLG" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <div class="modal-body" id="inventoryModalContentLG">

            </div>
        </div>
    </div>
</div>


<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>
<script src="inventory/js/extra.js"></script>

</body>

</html>