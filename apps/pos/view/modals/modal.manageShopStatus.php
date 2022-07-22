<?php
require_once('../../controller/GetThiShopDetailsCTRL.php');
require_once('../../../settings/controller/BranchesForModal.php');

require_once '../DoPOSCors.php';

$page_name         = "edit_this_shop";

$getToken = DoPOSCors::editUShopCors($page_name);
$_SESSION['editShopToken'] = $getToken;

$shop_ID    = $_REQUEST['id'];

$thisStoreDetails   = GetThiShopDetailsCTRL::callThisStores($shop_ID);

$getDetails         = $thisStoreDetails->fetch(PDO::FETCH_ASSOC);
$this_shop_status = $getDetails['shop_status'] == 1 ? "Activated" : "Deactivated";

?>

<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="change_pos_shop_status_form" class="section work-experience" action="" method="post" autocomplete="off">
        <div class="info">
            <h5 class="">Change Shop Status- <small>Deactivate or reactivate a shop</small></h5>
            <div class="work-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Shop Status </label>
                            <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" required readonly>
                            <input type="hidden" class="form-control input-lg m-bot15" id="shop_ID" name="shop_ID" value="<?php echo $shop_ID; ?>" required readonly>
                            <select class="form-control mb-12" id="wes-from1" id="shop_status" name="shop_status">
                                <optgroup label="Current Status">
                                    <option value="<?php echo $getDetails['shop_status']; ?>"><?php echo $this_shop_status; ?></option>
                                </optgroup>
                                <optgroup label="Change Status">
                                    <option value="1">Activate</option>
                                    <option value="2">Deactivate</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="col-12">
                    <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right mb-5">
            <button type="submit" class="btn btn-secondary" id="saveBtn">Submit</button>
        </div>

        <div class="col-12">
            <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
        </div>

    </form>
</div>

<script>
    $("#change_pos_shop_status_form").on("submit", function(e) {
        $('#saveBtn').prop('disabled', true);
        $("#loader").show();
        e.preventDefault();
        $.ajax({
            url: "pos/controller/ChangeThisStoreStatusCtr.php",
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
            },
        });
    });
</script>