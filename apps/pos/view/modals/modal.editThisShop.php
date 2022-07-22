<?php
require_once('../../controller/GetThiShopDetailsCTRL.php');
require_once('../../../settings/controller/BranchesForModal.php');

require_once '../DoPOSCors.php';

$page_name         = "edit_this_shop";

$getToken = DoPOSCors::editUShopCors($page_name);
$_SESSION['editShopToken'] = $getToken;

$shop_ID    = $_REQUEST['id'];

$thisStoreDetails   = GetThiShopDetailsCTRL::callThisStores($shop_ID);

$getDetails      = $thisStoreDetails->fetch(PDO::FETCH_ASSOC);

//get all branches
$allBranches = BranchesForModal::getAllBranches();

?>

<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form id="edit_pos_shop_form" class="section work-experience" action="" method="post" autocomplete="off">
        <div class="info">
            <h5 class="">Edit this shop</h5>
            <div class="row">
                <div class="col-md-11 mx-auto">

                    <div class="work-section">
                        <div class="col-md-12">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lead_name" class="bmd-label-floating"> Shop Code *</label>
                                        <input type="text" class="form-control input-lg m-bot15" id="this_store_code" name="store_code" readonly value="<?php echo $getDetails['store_code']; ?>" required>
                                        <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" required readonly>
                                        <input type="hidden" class="form-control input-lg m-bot15" id="shop_ID" name="shop_ID" value="<?php echo $shop_ID; ?>" required readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lead_email" class="bmd-label-floating"> Shop Name *</label>
                                        <input type="text" class="form-control input-lg m-bot15" id="store_name" name="store_name" value="<?php echo $getDetails['store_name']; ?>" required>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lead_source" class="bmd-label-floating"> Physical Location</label>
                                        <select class="form-control mb-4" id="wes-from1" id="store_physical_location" name="store_physical_location">
                                            <optgroup label="Current Location">
                                                <option value="<?php echo $getDetails['store_physical_location']; ?>"><?php echo $getDetails['store_physical_location']; ?></option>
                                            </optgroup>
                                            <optgroup label="Change Location">
                                                <?php
                                                foreach ($allBranches as $br) {
                                                ?>
                                                    <option value="<?php echo $br['branch_name']; ?>"><?php echo $br['branch_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lead_phone" class="bmd-label-floating"> Default Currency</label>
                                        <select class="form-control mb-4" id="defaultCurr" name="defaultCurr">
                                            <option value="GHS">GHS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                        </div>
                    </div>
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
    $("#edit_pos_shop_form").on("submit", function (e) {
  $('#saveBtn').prop('disabled', true);
  $("#loader").show();
  e.preventDefault();
  $.ajax({
    url: "pos/controller/EditThisStoreCtr.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
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