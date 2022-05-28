<?php
require_once '../../template/index.php';
require_once '../../settings/controller/CountriesCtrl.php';
$allCountries = CountriesCtrl::getAllCountries();

require_once 'DoCustomerCors.php';
$page_name         = "add_new_customer";
$token             = DoCustomerCors::addCustomer($page_name);

$_SESSION['addCustomerTkn']  = $token;
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">


                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="customer_add_frm" class="section work-experience" action="" method="post" autocomplete="off">
                                <div class="info">
                                    <h5 class="">Add a new Customer</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">

                                            <div class="work-section">
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="firstName" class="bmd-label-floating"> Customer Code *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="CCCode" name="CCCode" required value="<?php echo rand(1, date('Y')) * rand(1, date('Y')); ?>">
                                                                <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="firstName" class="bmd-label-floating"> Customer Name *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="customa_name" name="customa_name" placeholder="Customer Name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Customer Email *</label>
                                                                <input type="email" class="form-control input-lg m-bot15" id="customa_email" name="customa_email">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Customer Phone Number *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="customa_phone" name="customa_phone" onkeypress="return IsNumeric(event);" ondrop="return false;" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Customer Address Line 1*</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="customer_address" name="customer_address" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Customer Address Line 2</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="customer_address_b" name="customer_address_b">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Select Customer Country*</label>
                                                                <select class="form-control mb-4" id="wes-from1" id="country" name="country">
                                                                    <option value="000">No Country Available</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> State/Region *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="state" name="state" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> City/Town*</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="town_city" name="town_city" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                               
                                                <h5>Contact Person- <small>If customer is an Institution.</small></h5>
                                                <small>This details is added to your contacts automatically.</small>
                                                                                                
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Contact Person Name. </label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="contact_person" name="contact_person" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName" class="bmd-label-floating"> Contact Person Phone</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="contact_person_phone" name="contact_person_phone">
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
<script src="auth/js/extra.js"></script>

</body>

</html>