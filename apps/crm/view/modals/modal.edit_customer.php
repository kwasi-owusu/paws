<?php

require_once('../../controller/GetThisCustomer.php');

require_once '../DoCustomerCors.php';

$page_name         = "edit_this_customer";

$editCustomerToken = DoCustomerCors::editCustomerCors($page_name);
$_SESSION['editCustomerToken'] = $editCustomerToken;


$customer_ID = $_REQUEST['id'];

$thisCustomer = GetThisCustomer::thisCustomer($customer_ID);
?>

<form id="customer_add_frm" class="section work-experience" action="" method="post" autocomplete="off">
    <div class="info">
        <h5 class="">Edit this Customer</h5>
        <div class="row">
            <div class="col-md-11 mx-auto">

                <div class="work-section">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName" class="bmd-label-floating"> Customer Code *</label>
                                    <!-- <input type="text" class="form-control input-lg m-bot15" id="CCCode" name="CCCode" required value="<?php //echo rand(1, date('Y')) * rand(1, date('Y')); 
                                                                                                                                            ?>"> -->
                                    <input type="text" class="form-control input-lg m-bot15" id="CCCode" name="CCCode" readonly required value="<?php echo $thisCustomer['CCCode']; ?>">
                                    <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $editCustomerToken; ?>" readonly>
                                    <input type="hidden" class="form-control input-lg m-bot15" id="customer_ID" name="customer_ID" 
                                    value="<?php echo $customer_ID; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName" class="bmd-label-floating"> Customer Name *</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="customa_name" name="customa_name" value="<?php echo $thisCustomer['customa_name']; ?>" placeholder="Customer Name" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> Customer Email * <small id="responseHere" style="color:red"></small></label>
                                    <input type="email" class="form-control input-lg m-bot15" id="customa_email" name="customa_email" value="<?php echo $thisCustomer['customa_email']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> Customer Phone Number *</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="customa_phone"  value="<?php echo $thisCustomer['customa_phone']; ?>"
                                    name="customa_phone" onkeypress="return IsNumeric(event);" ondrop="return false;" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> Customer Address (Street/GeoCode)</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="customer_address" name="customer_address" required 
                                    value="<?php echo $thisCustomer['customa_address1']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> Select Customer Country*</label>
                                    <select class="form-control mb-4" id="thisCountry" name="country">
                                        <?php
                                        foreach ($allCountries as $cty) {
                                        ?>
                                            <option value="<?php echo $cty['id']; ?>"><?php echo $cty['country_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> State/Region *</label>
                                    <select class="form-control mb-4" id="state_region" name="state">
                                        <option value="000">Select State/Region</option>
                                        <optgroup id="states_here">

                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName" class="bmd-label-floating"> City/Town*</label>
                                    <input type="text" class="form-control input-lg m-bot15" name="town_city" list="cities_here">
                                    <datalist id="cities_here">

                                    </datalist>
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
</form>