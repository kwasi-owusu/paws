<?php
session_start();

require_once '../DoInventoryCors.php';
//inventory category
$editInventorySubCategoryToken = DoInventoryCors::editInventoryCategoryCors();
$_SESSION['editInventoryCategory'] = $editInventorySubCategoryToken;

$cat_ID     = $_REQUEST['id'];

/// get category by ID
require_once('../../controller/LoadInventoryCategoryByID.php');
$rs     = LoadInventoryCategoryByID::inventoryCatByID($cat_ID);
?>
<section class="panel">
    <div class="panel-body">
        <section class="panel">
            <form id="edit_inv_cat_form" action="" method="post" autocomplete="off">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating"> Category Name *</label>
                                <input type="text" class="form-control input-lg m-bot15" id="cat_name" name="cat_name" required value="<?php echo $rs['cat_name']; ?>">
                                <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $editInventorySubCategoryToken; ?>" required readonly>

                                <input type="hidden" class="form-control" id="cat_ID" name="cat_ID" value="<?php echo $cat_ID; ?>" required readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">Category
                                    Description</label>
                                <input type="text" class="form-control input-lg m-bot15" id="cat_desc" name="cat_desc" value="<?php echo $rs['cat_desc']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right" name="saveBtn" id="saveBtn">Save
                        </button>
                    </div>
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
    $('#edit_inv_cat_form').on('submit', function(e) {
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();
        $.ajax({
            url: "inventory/controller/ChangeInventoryCategory.php",
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