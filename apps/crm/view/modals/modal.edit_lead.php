<?php
session_start();
require_once('../../controller/GetThisSalesLead.php');

require_once '../DoCustomerCors.php';

$page_name         = "edit_this_lead";

$editSalesLeadToken = DoCustomerCors::editSalesLeadCors($page_name);
$_SESSION['editSalesLeadToken'] = $editSalesLeadToken;


$lead_ID = $_REQUEST['id'];

require_once '../../controller/GetAllSalesLeadForModal.php';
$this_lead = GetAllSalesLeadForModal::callAllSalesLeadsForModal($lead_ID);

require_once '../../../settings/controller/SettingsForModalCtrl.php';
$allCountries = SettingsForModalCtrl::countries();
?>

<form id="sales_leads_form" class="section work-experience" action="" method="post" autocomplete="off">
    <div class="info">
        <h5 class="">Manage this Sales Lead</h5>
        <div class="row">
            <div class="col-md-11 mx-auto">

                <div class="work-section">
                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_name" class="bmd-label-floating"> Lead (Customer) Name *</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="lead_name" name="lead_name" value="<?php echo $this_lead['lead_name']; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_source" class="bmd-label-floating"> Lead Source *</label>
                                    <select class="form-control mb-4" id="wes-from1" id="lead_source" name="lead_source">
                                        <optgroup label="Current Lead Source">
                                            <option style="text-transform: capitalize;" value="<?php echo $this_lead['lead_source']; ?>"><?php echo $this_lead['lead_source']; ?></option>
                                        </optgroup>
                                        <optgroup label="Change Lead Source">
                                            <option value="referral">Referral</option>
                                            <option value="Former Client">Former Client</option>
                                            <option value="Google">Google</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Twitter">Twitter</option>
                                            <option value="Trade Show">Trade Show</option>
                                            <option value="Affiliate Marketing">Affiliate Marketing</option>
                                            <option value="Direct Marketing">Direct Marketing</option>
                                            <option value="Email Newsletter">Email Newsletter</option>
                                            <option value="Blog Post">Blog Post</option>
                                        </optgroup>
                                    </select>
                                    <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $editSalesLeadToken; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_email" class="bmd-label-floating"> Email *</label>
                                    <input type="email" class="form-control input-lg m-bot15" id="lead_email" name="lead_email" value="<?php echo $this_lead['lead_email']; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_phone" class="bmd-label-floating"> Lead Phone Number *</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="lead_phone" name="lead_phone" value="<?php echo $this_lead['lead_phone']; ?>" onkeypress="return IsNumeric(event);" ondrop="return false;" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead_type" class="bmd-label-floating"> Lead Type *
                                        <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="A sales lead is a person or business who may eventually become a client." style="cursor: pointer;">
                                            ?
                                        </span>
                                    </label>
                                    <select class="form-control mb-4" id="lead_type" name="lead_type">
                                        <optgroup label="Current lead type">
                                            <option value="<?php echo $this_lead['lead_type']; ?>"><?php echo $this_lead['lead_type']; ?></option>
                                        </optgroup>
                                        <optgroup label="Change Lead Type">
                                            <option value="Cold">Cold Lead</option>
                                            <option value="Warm">Warm Lead</option>
                                            <option value="Hot">Hot Lead</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="forecast_close" class="bmd-label-floating"> Forecast Close *

                                        <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Expected month to close deal." style="cursor: pointer;">
                                            ?
                                        </span>
                                    </label>
                                    <select class="form-control mb-4" id="wes-from1" id="forecast_close" name="forecast_close" required>
                                        <optgroup label="Current Forecast Close">
                                            <option value="<?php echo $this_lead['forecast_close']; ?>"><?php echo $this_lead['forecast_close']; ?></option>
                                        </optgroup>

                                        <optgroup label="Change Forecast Close">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="potential_opportunity" class="bmd-label-floating"> Potential Opportunity
                                        <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Sales Amount involved." style="cursor: pointer;">
                                            ?
                                        </span>
                                    </label>
                                    <input type="text" class="form-control input-lg m-bot15" id="potential_opportunity" name="potential_opportunity" 
                                    value="<?php echo $this_lead['potential_opportunity']; ?>" onkeypress="return IsNumeric(event);" ondrop="return false;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="chance_of_sales" class="bmd-label-floating"> Chance of Sales (%)

                                        <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Percentage Chance of closing this sales deal. For cold leas, you may set 10%; 25% for warm lead and 50% for hot lead" style="cursor: pointer;">
                                            ?
                                        </span>

                                    </label>
                                    <input type="text" class="form-control input-lg m-bot15" value="<?php echo $this_lead['chance_of_sales']; ?>" 
                                    id="chance_of_sales" name="chance_of_sales" value="10" max="100" onkeypress="return IsNumeric(event);" ondrop="return false;" style="font-weight:bolder;">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class=" row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighted_forecast" class="bmd-label-floating"> Weighted Forecast*</label>
                                    <input type="text" class="form-control input-lg m-bot15" id="weighted_forecast" value="<?php echo $this_lead['weighted_forecast']; ?>"  
                                    style="font-weight:bolder;" name="weighted_forecast" required onkeypress="return IsNumeric(event);" ondrop="return false;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weighted_forecast" class="bmd-label-floating"> Pipeline Stage*</label>
                                    <select class="form-control mb-4" id="wes-from1" id="pipeline_stage" name="pipeline_stage" required>
                                        <optgroup label="Current Pipeline Stage">
                                            <option value="<?php echo $this_lead['pipeline_stage']; ?>"><?php echo $this_lead['pipeline_stage']; ?></option>
                                        </optgroup>
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
</form>

<script>
    $("#customer_edit_frm").on("submit", function(e) {
        $("#saveBtn").prop("disabled", true);
        $("#loader").show();
        e.preventDefault();
        $.ajax({
            url: "crm/controller/UpdateCustomerDetailsController.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                $("#responseHere").fadeOut("slow", function() {
                    Snackbar.show({
                        text: data,
                        actionTextColor: "#fff",
                        backgroundColor: "#2196f3",
                    });

                    $("#loader").hide();

                    setInterval("location.reload()", 3000);
                });

                $("#saveBtn").prop("disabled", false);
            },
        });
    });