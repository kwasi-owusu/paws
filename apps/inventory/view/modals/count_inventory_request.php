<?php
session_start();
require_once '../DoInventoryCors.php';
$countVarianceToken     = DoInventoryCors::countVarianceToken();
$_SESSION['countVarianceToken']     = $countVarianceToken;


$storage_ID     = $_REQUEST['id'];
require_once '../../controller/ManageInventoryModalCtr.php';
$getRst     = ManageInventoryModalCtr::getInventoryStorageDetails($storage_ID);
$fetchItem  = $getRst->fetch(PDO::FETCH_ASSOC);

?>
<h4>Request Inventory Count Variance</h4>
<p>Your theoretical inventory versus your physical inventory</p>
<section class="panel">
    <div class="panel-body">
        <section class="panel">
            <form id="count_variance_request_frm" action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Inventory Name *</label>
                            <input type="text" class="form-control input-lg m-bot15" id="product_name" name="product_name" required value="<?php echo $fetchItem['product_name']; ?>" readonly>
                            <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $countVarianceToken; ?>" required readonly>

                            <input type="hidden" class="form-control" id="storage_ID" name="storage_ID" value="<?php echo $storage_ID; ?>" required readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating">Inventory Code</label>
                            <input type="text" class="form-control input-lg m-bot15" id="product_code" name="product_code" value="<?php echo $fetchItem['product_code']; ?>" required readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Inventory On Hand (theoretical qty)</label>
                            <input type="text" class="form-control input-lg m-bot15" id="received_qty" name="received_qty" value="<?php echo $fetchItem['recieved_qty']; ?>" required readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Variant Inventory (physical qty)</label>
                            <input type="text" class="form-control input-lg m-bot15" id="variance_qty" name="variance_qty" required onkeypress="return IsNumeric(event);" ondrop="return false;">

                            <input type="hidden" class="form-control input-lg m-bot15" id="po_ID" name="po_ID" value="<?php echo $fetchItem['po_ID']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="unit_cost" name="unit_cost" value="<?php echo $fetchItem['unit_cost']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="wh_stored" name="wh_stored" value="<?php echo $fetchItem['wh_stored']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="storage_address" name="storage_address" value="<?php echo $fetchItem['storage_address']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="batch_num" name="batch_num" value="<?php echo $fetchItem['batch_num']; ?>" required readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Variance Reason</label>
                            <textarea class="form-control input-lg m-bot15" id="variance_reason" name="variance_reason" required rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg m-bot15" id="adjustment_value" name="adjustment_value" required readonly>
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
    $('#variance_qty').on('keyup blur', function() {
        let physicalQty = parseFloat($(this).val());
        let theoQty = parseFloat($('#received_qty').val());
        let adjustmentVal = (physicalQty - theoQty).toFixed(2);

        $('#adjustment_value').val(adjustmentVal);
    });
</script>

<script>
    //edit inventory category
    $('#count_variance_request_frm').on('submit', function(e) {
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();
        $.ajax({
            url: "inventory/controller/RequestInventoryVarianceCount.php",
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