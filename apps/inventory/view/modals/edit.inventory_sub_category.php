<?php
session_start();

require_once '../DoInventoryCors.php';
//inventory category
$editInventorySubCategoryToken = DoInventoryCors::editInventorySubCategoryCors();
$_SESSION['editInventorySubCategory'] = $editInventorySubCategoryToken;

$sub_cat_ID = $_REQUEST['id'];

/// get Sub category by ID
require_once('../../controller/LoadInventorySubCategoryByID.php');
$rs = LoadInventorySubCategoryByID::getInventorySubCategoryByID($sub_cat_ID);


/// get all category
require_once('../../controller/LoadInventoryCatForModal.php');
$rsl = LoadInventoryCatForModal::allCategoriesForModal();

?>
<section class="panel">
    <div class="panel-body">
        <section class="panel">
            <form id="edit_inv_sub_cat_form" action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating">Inventory Category</label>
                            <select class="form-control input-lg m-bot15" name="inventory_cat" id="inventory_cat">
                                <optgroup label="Current Category">
                                    <option value="<?php echo $rs['cat_ID']; ?>"><?php echo $rs['cat_name']; ?></option>
                                </optgroup>
                                <optgroup label="Change Category">
                                    <?php
                                    foreach ($rsl as $ic) {
                                    ?>
                                        <option value="<?php echo $ic['cat_ID']; ?>"><?php echo $ic['cat_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Sub Category Name
                                *</label>
                            <input type="text" class="form-control input-lg m-bot15" id="sub_cat_name" name="sub_cat_name" required value="<?php echo $rs['sub_cat_name']; ?>">
                            <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $editInventorySubCategoryToken; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="sub_cat_ID" name="sub_cat_ID" value="<?php echo $sub_cat_ID; ?>" required readonly>
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
        </section>
    </div>
</section>

<script>
    //edit inventory category
    $('#edit_inv_sub_cat_form').on('submit', function(e) {
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();
        $.ajax({
            url: "inventory/controller/ChangeInventorySubCategory.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $('#submit_output').fadeOut('slow', function() {
                    $("#loader").hide();
                    Snackbar.show({
                        text: data,
                        actionTextColor: "#fff",
                        backgroundColor: "#2196f3",
                    });
                    setInterval("location.reload()", 3000);
                });
            }
        });
    });
</script>