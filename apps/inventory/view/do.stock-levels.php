<?php
require_once '../../template/index.php';

require_once('../controller/GetAllStockLevels.php');
$stockLevels = GetAllStockLevels::allStockLevels();

require_once('../../settings/controller/Branches.php');
$getBrn = Branches::getAllBranches();
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

                    <div class="widget-content widget-content-area border-top-tab">
                        <ul class="nav nav-tabs mb-3 mt-3" id="borderTop" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="border-top-home-tab" data-toggle="tab" href="#all_locations" role="tab" aria-controls="border-top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> All Locations
                                </a>

                            </li>

                                <?php
                                foreach ($getBrn as $bn) {
                                ?>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-home-tab" data-toggle="tab" href="#<?php echo $bn['branch_name']; ?>" role="tab" aria-controls="border-top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> <?php echo $bn['branch_name']; ?>
                                </a>
                                <!-- <a data-toggle="tab" href="#<?php echo $bn['branch_name']; ?>">
                                    <?php echo $bn['branch_name']; ?>
                                </a> -->
                            </li>
                        <?php
                                }
                        ?>
                        

                        </ul>
                        <div class="tab-content" id="borderTopContent">
                            <div class="tab-pane fade show active" id="all_locations" role="tabpanel" aria-labelledby="border-top-home-tab">
                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Item Code</th>
                                            <th>Batch Number</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Item Name</th>
                                            <th>Base UoM</th>
                                            <th>Qty on Hand</th>
                                            <th>Mfg Date</th>
                                            <th>Expiry Date</th>
                                            <th>Days to Expire</th>
                                            <th>WH Stored</th>
                                            <th>Storage Address</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Item Code</th>
                                            <th>Batch Number</th>
                                            <th>Category</th>
                                            <th>Sub Category</th>
                                            <th>Item Name</th>
                                            <th>Base UoM</th>
                                            <th>Qty on Hand</th>
                                            <th>Mfg Date</th>
                                            <th>Expiry Date</th>
                                            <th>Days to Expire</th>
                                            <th>WH Stored</th>
                                            <th>Storage Address</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($stockLevels as $sl) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $sl['product_code']; ?></td>
                                                <td><?php echo $sl['batch_num']; ?></td>
                                                <td><?php echo $sl['cat_name']; ?></td>
                                                <td><?php echo $sl['sub_cat_name']; ?></td>
                                                <td><?php echo $sl['product_name']; ?></td>
                                                <td><?php echo $sl['base_uom']; ?></td>
                                                <td><?php echo $sl['recieved_qty']; ?></td>
                                                <td><?php echo $sl['manu_dt']; ?></td>
                                                <td><?php echo $sl['expiry_dt']; ?></td>
                                                <td><?php echo $sl['days_to_expire']; ?></td>
                                                <td><?php echo $sl['wh_nm']; ?></td>
                                                <td><?php echo $sl['storage_address']; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php
                            $thisBranch = Branches::getAllBranches();
                            foreach ($thisBranch as $tbn) {
                                $branchName = $tbn['branch_name'];
                                $branchStockLevel   = GetAllStockLevels::thisBranchStockLevels($branchName);
                            ?>
                                <div class="tab-pane fade" id="<?php echo $branchName; ?>" role="tabpanel" aria-labelledby="border-top-profile-tab">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>
                                            Stock Level for <?php echo $branchName; ?>
                                        </h4>
                                    </div>
                                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Item Code</th>
                                                <th>Batch Number</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Item Name</th>
                                                <th>Base UoM</th>
                                                <th>Qty on Hand</th>
                                                <th>Mfg Date</th>
                                                <th>Expiry Date</th>
                                                <th>Days to Expire</th>
                                                <th>WH Stored</th>
                                                <th>Storage Address</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th>Item Code</th>
                                                <th>Batch Number</th>
                                                <th>Category</th>
                                                <th>Sub Category</th>
                                                <th>Item Name</th>
                                                <th>Base UoM</th>
                                                <th>Qty on Hand</th>
                                                <th>Mfg Date</th>
                                                <th>Expiry Date</th>
                                                <th>Days to Expire</th>
                                                <th>WH Stored</th>
                                                <th>Storage Address</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            foreach ($branchStockLevel as $bsl) {
                                            ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $bsl['product_code']; ?></td>
                                                    <td><?php echo $bsl['batch_num']; ?></td>
                                                    <td><?php echo $bsl['cat_name']; ?></td>
                                                    <td><?php echo $bsl['sub_cat_name']; ?></td>
                                                    <td><?php echo $bsl['product_name']; ?></td>
                                                    <td><?php echo $bsl['base_uom']; ?></td>
                                                    <td><?php echo $bsl['recieved_qty']; ?></td>
                                                    <td><?php echo $bsl['manu_dt']; ?></td>
                                                    <td><?php echo $bsl['expiry_dt']; ?></td>
                                                    <?php
                                                    $tdy    = Date('Y-m-d');
                                                    if ($bsl['days_to_expire'] <= 7) {
                                                    ?>
                                                        <td style="background-color: #f02e05; color: #ffffff;"><?php echo $bsl['days_to_expire']; ?></td>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <td style="background-color: #0c571f; color: #ffffff;"><?php echo $bsl['days_to_expire']; ?></td>
                                                    <?php
                                                    }
                                                    ?>

                                                    <td><?php echo $bsl['wh_nm']; ?></td>
                                                    <td><?php echo $bsl['storage_address']; ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php
                            }
                            ?>


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

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<script src="template/statics/assets/plugins/editors/quill/quill.js"></script>
<script src="template/statics/assets/plugins/editors/quill/custom-quill.js"></script>

<script src="template/statics/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/functions.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/mtiny.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/tinymce.min.js"></script>


<script>
    tinymce.init({
        selector: '#item_desc',
        height: 400,
        menubar: true,

        plugins: ['advlist autolink lists link charmap print preview anchor textcolor', 'searchreplace visualblocks code fullscreen', 'insertdatetime table paste code help wordcount'],
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',


    });
</script>

<script src="inventory/js/extra.js"></script>

</body>

</html>