<?php
session_start();
require_once '../DoInventoryCors.php';
//inventory items
$editInventoryItemsCors = DoInventoryCors::editInventoryItemsCors();
$_SESSION['editInventoryItemsCors'] = $editInventoryItemsCors;

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

?>

<h4>Edit Inventory Item</h4>
<form id="edit_inventory_itm_frm" action="" method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating">Inventory Category</label>
                <select class="form-control input-lg m-bot15" name="product_cat" id="product_cat">
                    <optgroup label="Current Category">
                        <option value="<?php echo $itm['inventory_cat_ID']; ?>"><?php echo $itm['cat_name']; ?></option>
                    </optgroup>
                    <optgroup label="Change Category">
                        <?php
                        foreach ($allInventoryCat as $nic) {
                        ?>
                            <option value="<?php echo $nic['cat_ID']; ?>"><?php echo $nic['cat_name']; ?></option>">
                        <?php
                        }
                        ?>
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
                    <optgroup label="Change Sub Category" id="sub_ca_here">
                        <?php
                        foreach ($allInventorySubCat as $isc) {
                        ?>
                            <option value="<?php echo $isc['sub_cat_ID']; ?>"><?php echo $isc['sub_cat_name']; ?></option>
                        <?php
                        }
                        ?>
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
                    <option value="0">No Brand</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> inventory Code *</label>
                <input type="text" class="form-control input-lg m-bot15" id="inventory_code" name="inventory_code" required value="<?php echo $itm['inventory_code']; ?>" readonly>
                <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $editInventoryItemsCors; ?>" required readonly>

                <input type="hidden" class="form-control" id="inventory_ID" name="inventory_ID" value="<?php echo $inventory_ID; ?>" required readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Inventory Name *</label>
                <input type="text" class="form-control input-lg m-bot15" id="inventory_name" name="inventory_name" required value="<?php echo $itm['inventory_name']; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Internal Reference
                    *</label>
                <input type="text" class="form-control input-lg m-bot15" id="Internal_ref" name="Internal_ref" required value="<?php echo $itm['Internal_ref']; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Reorder Rule *</label>
                <input type="text" class="form-control input-lg m-bot15" id="re_order_rule" name="re_order_rule" required onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $itm['re_order_rule']; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label> UOM</label>
                <select class="form-control input-lg m-bot15" name="uom">
                    <optgroup label="Current UOM">
                        <option selected value="<?php echo $itm['uom']; ?>"><?php echo $itm['uom']; ?></option>
                    </optgroup>
                    <optgroup label="Change UOM">
                        <?php
                        foreach ($itm_uom as $u) {
                        ?>
                            <option value="<?php echo $u['uom']; ?>"><?php echo $u['uom']; ?></option>
                        <?php
                        }
                        ?>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Unit Price *</label>
                <input type="text" class="form-control input-lg m-bot15" id="unit_cost" name="unit_cost" required onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $itm['unit_cost']; ?>">
            </div>
        </div>


    </div>
    <hr />

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="bmd-label-floating"> Inventory Item
                    Image</label>
                <input type="file" class="form-control" name="item_img" id="item_img">
            </div>
        </div>

        <div class="col-md-4">
            <label>Sellable</label>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="sellable" id="sellable">
                        If checked, product will not be displayed in the POS
                    </label>
                </div>
                <input type="hidden" class="form-control input-lg m-bot15" id="this_is_sellable" name="this_is_sellable" required value="<?php echo $itm['sellable']; ?>">
            </div>
        </div>

        <div class="col-md-4">
            <label> Enable Description </label>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="enable_desc" id="enable_desc">
                        If checked, Item will display with Description in
                        POS
                    </label>
                </div>
                <input type="hidden" class="form-control input-lg m-bot15" id="enable_this_desc" name="enable_this_desc" required value="<?php echo $itm['enable_desc']; ?>">
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
    //inventory items
    $('#edit_inventory_itm_frm').on('submit', function(e) {
        tinyMCE.triggerSave();
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();
        $.ajax({
            url: "inventory/controller/EditInventoryItem.php",
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
                setInterval("location.reload()", 3000);
            }
        });
    });
</script>

<script>
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
</script>