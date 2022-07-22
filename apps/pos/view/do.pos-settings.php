<?php
require_once '../../template/index.php';

require_once 'DoPOSCors.php';
$page_name         = "pos_settings_page";
$getToken          = DoPOSCors::posSettings($page_name);

$_SESSION['pos_settings_tkn']  = $getToken;

require_once('../../settings/controller/Branches.php');
$getBrn = Branches::getAllBranches();


?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">

                        <div class="col-xl-8 col-lg-8 col-md-8  offset-2 layout-spacing">
                            <form id="pos_settings_form" class="section work-experience" action="" method="post" autocomplete="off">
                                <div class="info">
                                    <h5 class="">Setup Profit Center</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">

                                            <div class="work-section">
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_name" class="bmd-label-floating"> Shop Code *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="store_code" name="store_code" required>
                                                                <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" required readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_email" class="bmd-label-floating"> Store Name *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="store_name" name="store_name" placeholder="Name of Store" required>
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
                                                                    <?php
                                                                    foreach ($getBrn as $br) {
                                                                    ?>
                                                                        <option value="<?php echo $br['branch_name']; ?>"><?php echo $br['branch_name']; ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
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
                                        <p id="responseHere"></p>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right mb-5">
                                    <button type="submit" class="btn btn-secondary" id="saveBtn">Submit</button>
                                    <p id="testMe"></p>
                                </div>

                                <div class="col-12">
                                    <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                                </div>

                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>

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