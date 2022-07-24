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

require_once('../../controller/CTRGetAllSalesPerson.php');
$getSalesP  = CTRGetAllSalesPerson::GetAllSalesPersons();
$fetchSP    = $getSalesP->fetchAll();
?>

<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="change_pos_shop_status_form" class="section work-experience" action="" method="post" autocomplete="off">
        <div class="info">
            <h5 class="">Add Sales Person- <small>Assign a Sales Person to this shop</small></h5>
            <div class="work-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="bmd-label-floating">Select Sales Person</label>
                            <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" required readonly>
                            <input type="hidden" class="form-control input-lg m-bot15" id="store_ID" name="store_ID" value="<?php echo $shop_ID; ?>" required readonly>
                            <select class="form-control input-lg m-bot15" name="salesPerson" id="salesPerson" data-size="7" data-style="select-with-transition" required>
                                <?php
                                foreach ($fetchSP as $sp) {
                                ?>
                                    <option value="<?php echo $sp['user_ID']; ?>"><?php echo $sp['firstName'] . " " . $sp['lastName']; ?></option>
                                <?php
                                }
                                ?>
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
            url: "pos/controller/AddNewSalesPersonToShop.php",
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
                etInterval("location.reload()", 3000);
            },
        });
    });
</script>