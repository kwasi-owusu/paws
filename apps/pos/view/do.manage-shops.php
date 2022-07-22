<?php
require_once '../../template/index.php';

require_once('../controller//CTRListAllShops.php');
$rst = CTRListAllShops::callAllStores();

?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="w-content">
                        <span class="w-value" style="padding: 15px; font-size:20px; font-weight:bolder;">Manage Profit Centers</span>
                    </div>
                    <div class="table-responsive-sm">
                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Shop Code</th>
                                    <th>Shop Name</th>
                                    <th>Location</th>
                                    <th>Default Currency</th>
                                    <th>Status</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Shop Code</th>
                                    <th>Shop Name</th>
                                    <th>Location</th>
                                    <th>Default Currency</th>
                                    <th>Status</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php
                                foreach ($rst as $rs) {
                                    $shopStatus    = $rs['shop_status'];
                                    $status = '';
                                    switch ($shopStatus) {
                                        case 0:
                                            $status .= 'Inactive';
                                            break;

                                        case 1:
                                            $status .= 'Active';
                                            break;
                                    }
                                ?>
                                    <tr id="">
                                        <td></td>
                                        <td><?php echo $rs['store_code']; ?></td>
                                        <td><?php echo $rs['store_name']; ?></td>
                                        <td><?php echo $rs['store_physical_location']; ?></td>
                                        <td><?php echo $rs['defaultCurr']; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td class="text-right">

                                            <div class="btn-group">
                                                <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                    <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $rs['store_ID']; ?>" onclick="editThisShop(this)" data-toggle="modal" data-target="#manageModalLG">
                                                        Edit Shop Details
                                                    </a>

                                                    <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $rs['store_ID']; ?>" onclick="AddSalesPerson(this)" data-toggle="modal" data-target="#manageModalLG">
                                                        Add Sales Person
                                                    </a>

                                                    <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $rs['store_ID']; ?>" onclick="deactivateUser(this)" data-toggle="modal" data-target="#manageModalLG">
                                                        Change Shop Status
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
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="manageModalLG" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Manage Shop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="ModalContentLG">

            </div>
        </div>
    </div>
</div>

<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>
<script src="pos/js/extra.js"></script>

</body>

</html>