<?php
session_start();
require_once '../DoInventoryCors.php';
$transferToken = DoInventoryCors::transferInventoryRequest();
$_SESSION['transferToken'] = $transferToken;


$storage_ID = $_REQUEST['id'];
require_once '../../controller/ManageInventoryModalCtr.php';
$getRst = ManageInventoryModalCtr::getInventoryStorageDetails($storage_ID);
$fetchItem = $getRst->fetch(PDO::FETCH_ASSOC);

$allWarehouses = ManageInventoryModalCtr::CTRAllAllLocations();
$lct = $allWarehouses->fetchAll();
?>
<h4>Request Inventory Transfer</h4>
<section class="panel">
    <div class="panel-body">
        <section class="panel">
            <form id="transfer_request_frm" action="" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Inventory Name *</label>
                            <input type="text" class="form-control input-lg m-bot15" id="product_name" name="product_name" required value="<?php echo $fetchItem['product_name']; ?>" readonly>
                            <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $transferToken; ?>" required readonly>

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
                            <label class="bmd-label-floating"> Quantity On Hand</label>
                            <input type="text" class="form-control input-lg m-bot15" id="received_qty" name="received_qty" value="<?php echo $fetchItem['recieved_qty']; ?>" required readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Quantity To Transfer</label>
                            <input type="text" class="form-control input-lg m-bot15" id="transfer_qty" name="transfer_qty" required onkeypress="return IsNumeric(event);" ondrop="return false;">

                            <input type="hidden" class="form-control input-lg m-bot15" id="wh_stored" name="wh_stored" value="<?php echo $fetchItem['wh_stored']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="po_ID" name="po_ID" value="<?php echo $fetchItem['po_ID']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="unit_cost" name="unit_cost" value="<?php echo $fetchItem['unit_cost']; ?>" required readonly>


                            <input type="hidden" class="form-control input-lg m-bot15" id="storage_address" name="storage_address" value="<?php echo $fetchItem['storage_address']; ?>" required readonly>

                            <input type="hidden" class="form-control input-lg m-bot15" id="batch_num" name="batch_num" value="<?php echo $fetchItem['batch_num']; ?>" required readonly>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="bmd-label-floating"> Current Warehouse Store</label>
                            <input type="text" class="form-control input-lg m-bot15" id="curr_wh_stored" name="curr_wh_stored" value="<?php echo $fetchItem['wh_nm']; ?>" required readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="bmd-label-floating"> Select Transfer Type</label>
                        <select class="form-control input-lg m-bot15" name="transfer_type" id="transfer_type">
                            <option value="1">Local Transfer</option>
                            <option value="2">Inter-Branch Transfer</option>
                        </select>
                    </div>

                </div>

                <hr />

                <section id="for_local_transfer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating"> Destination Location</label>
                                <select class="form-control input-lg m-bot15" name="destination_wh" id="destination_wh">
                                    <?php
                                    foreach ($lct as $lc) {
                                    ?>
                                        <option value="<?php echo $lc['branch_name']; ?>"><?php echo $lc['branch_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>
                </section>

    </div>

    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="bmd-label-floating"> Transfer Reason</label>
                <textarea class="form-control input-lg m-bot15" id="trans_reason" name="trans_reason" required rows="4"></textarea>
            </div>
        </div>
    </div>


    <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right" name="saveBtn" id="saveBtn">Save
        </button>
    </div>

    </form>
    <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right" name="save_qir" id="save_qir">Save
        </button>
    </div>
    <p id="submit_output"></p>
</section>
</div>
</section>

<script>
    $('#transfer_qty').on('keyup blur', function() {
        let qtyTrn = parseFloat($(this).val());
        let qtyOnHand = parseFloat($('#received_qty').val());

        if (qtyTrn > qtyOnHand) {
            $('#submit_output').text('You cannot transfer more than available for the batch');
            $('#save_qir').prop('disabled', true);
        } else {
            $('#submit_output').text('');
            $('#save_qir').prop('disabled', false);
        }

    });
</script>

<script>
    //edit inventory category
    $('#transfer_request_frm').on('submit', function(e) {
        $("#loader").show();
        $("#saveBtn").prop("disabled", true);
        e.preventDefault();

        let curr_wh = $('#wh_stored').val();
        let dest_wh = $('#destination_wh').val();
        let dest_rack = $('#destination_rack').val();
        let dest_pal = $('#destination_palette').val();

        //if (curr_wh !== dest_wh){
        $.ajax({
            url: "inventory/controller/RequestInventoryTransferCtr.php",
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
        //}
        // else {
        //     $('#submit_output').text('You cannot transfer to same location');
        //     $('#save_qir').prop('disabled', false);
        //     $("#save_gif_loader").hide();
        // }
    });
</script>