<?php
session_start();
require_once '../DoInventoryCors.php';
//inventory items
$quick_stock_shop = DoInventoryCors::editInventoryItemsCors();
$_SESSION['quick_stock_shop'] = $quick_stock_shop;

################## END  CORS CHECK ###################################

$inventory_ID = $_REQUEST['id'];

//get all categories
require_once('../../controller/LoadInventoryCatForModal.php');
$allInventoryCat = LoadInventoryCatForModal::allCategoriesForModal();


//get all sub categories

$allInventorySubCat = LoadInventoryCatForModal::allSubCategoriesForModal();

//get all uom
$itm_uom = LoadInventoryCatForModal::selectUOM();


$itm = LoadInventoryCatForModal::thisInventoryItemForModal($inventory_ID);

require_once('../../../settings/controller/BranchesForModal.php');
$getBranch = BranchesForModal::getAllBranches();
?>

<h4>Stock this item</h4>
<form id="quick_stock_shop_frm" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating">Inventory Category</label>
                <select class="form-control input-lg m-bot15" name="inventory_cat" id="inventory_cat">
                    <optgroup label="Current Category">
                        <option value="<?php echo $itm['inventory_cat_ID']; ?>"><?php echo $itm['cat_name']; ?></option>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating">Inventory Sub
                    Category</label>
                <select class="form-control input-lg m-bot15" name="inventory_sub_cat" id="get_inv_sub">
                    <optgroup label="Current Sub Category">
                        <option value="<?php echo $itm['sub_cat_ID']; ?>"><?php echo $itm['sub_cat_name']; ?></option>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating">Inventory Brand</label>
                <select class="form-control input-lg m-bot15" name="get_itm_brand">
                    <optgroup label="Currently Brand">
                        <option value="<?php echo $itm['inventory_brand']; ?>"><?php echo $itm['inventory_brand']; ?></option>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> inventory Code *</label>
                <input type="text" class="form-control input-lg m-bot15" id="product_code" name="product_code" required value="<?php echo $itm['inventory_code']; ?>" readonly>
                <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $quick_stock_shop; ?>" required readonly>

                <input type="hidden" class="form-control" id="inventory_ID" name="inventory_ID" value="<?php echo $inventory_ID; ?>" required readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Inventory Name *</label>
                <input type="text" class="form-control input-lg m-bot15" id="product_name" name="product_name" required value="<?php echo $itm['inventory_name']; ?>" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Internal Reference
                    *</label>
                <input type="text" class="form-control input-lg m-bot15" id="Internal_ref" name="Internal_ref" required readonly value="<?php echo $itm['Internal_ref']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Unit Price *</label>
                <input type="text" class="form-control input-lg m-bot15" id="unit_cost" name="unit_cost" required readonly onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $itm['unit_cost']; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Batch Number *</label>
                <input type="text" class="form-control input-lg m-bot15" id="batch_num" name="batch_num">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Quantity *</label>
                <input type="text" class="form-control input-lg m-bot15" id="received_qty" name="received_qty" required onkeypress="return IsNumeric(event);" ondrop="return false;">
            </div>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating"> Manufactured Date *</label>
                <input type="date" class="form-control input-lg m-bot15" id="manu_dt" name="manu_dt">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating"> Expiry Date *</label>
                <input type="date" class="form-control input-lg m-bot15" id="expiry_dt" name="expiry_dt">
            </div>
        </div>

    </div>

    <h4>Item Destination</h4>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">Select Branch</label>
                <select class="form-control input-lg m-bot15" name="branch_owner" id="branch_name">
                    <option value="999">Select a Branch</option>
                    <optgroup label="Select a Branch">
                        <?php
                        foreach ($getBranch as $brn) {
                        ?>
                            <option value="<?php echo $brn['branch_name']; ?>"><?php echo $brn['branch_name']; ?></option>
                        <?php
                        }
                        ?>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="bmd-label-floating">Select Shop</label>
                <select class="form-control input-lg m-bot15" name="store_name" id="store_name">
                    <option value="999">Select a Shop</option>
                    <optgroup label="Change Sub Category" id="post_shop_here">
                        
                    </optgroup>
                </select>
            </div>
        </div>
    </div>

    <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right" name="saveBtn" id="saveBtn">Save
        </button>
    </div>
</form>
<div class="col-12">
    <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
</div>
<p id="submit_output"></p>

<script>
    $(document).on("change", "#branch_name", function() {
        let brn = $("#branch_name").val();

        $.ajax({
            url: "pos/controller/GetShopController.php",
            type: "POST",
            //dataType:"json",
            data: {
                brn: brn
            },
            success: function(data) {
                $("#post_shop_here").html(data);
            },
        });
    });
</script>

<script>
    //inventory items
    $('#quick_stock_shop_frm').on('submit', function(e) {
        //tinyMCE.triggerSave();
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();
        $.ajax({
            url: "inventory/controller/QuickStockShop.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#loader").hide();
                Snackbar.show({
                    text: data,
                    actionTextColor: "#fff",
                    backgroundColor: "#2196f3",
                });
                //setInterval("location.reload()", 3000);
            }
        });
    });
</script>

<!-- <script>
    $(document).ready(function() {
        let sellable = parseInt($("#this_is_sellable").val());
        let enable_desc = parseInt($("#enable_this_desc").val());

        //for sellable checkbox
        if (sellable === 1) {
            $("#sellable").prop('checked', true);
        } else if (sellable !== 1) {
            $("#sellable").prop('checked', false);
        }

        //for enable desc checkbox
        if (enable_desc === 1) {
            $("#enable_desc").prop('checked', true);
        } else if (enable_desc !== 1) {
            $("#enable_desc").prop('checked', false);
        }


    })
</script> -->