<?php
require_once '../../template/index.php';

require_once 'DoCustomerCors.php';
$page_name         = "add_new_sales_lead";
$getToken          = DoCustomerCors::addNewSalesLead($page_name);

$_SESSION['addSalesLeadTkn']  = $getToken;
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">

                        <div class="col-xl-8 col-lg-8 col-md-8 layout-spacing">
                            <form id="sales_leads_form" class="section work-experience" action="" method="post" autocomplete="off">
                                <div class="info">
                                    <h5 class="">New Sales Lead</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">

                                            <div class="work-section">
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_name" class="bmd-label-floating"> Lead (Customer) Name *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="lead_name" name="lead_name" placeholder="Lead (Customer)Name" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_source" class="bmd-label-floating"> Lead Source *</label>
                                                                <select class="form-control mb-4" id="wes-from1" id="lead_source" name="lead_source">
                                                                    <option value="referral">Referral</option>
                                                                    <option value="Viobu E-Commerce">Viobu E-commerce</option>
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
                                                                </select>
                                                                <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_email" class="bmd-label-floating"> Email *</label>
                                                                <input type="email" class="form-control input-lg m-bot15" id="lead_email" name="lead_email" placeholder="Lead Email" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lead_phone" class="bmd-label-floating"> Lead Phone Number *</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="lead_phone" name="lead_phone" placeholder="Lead Phone Number" onkeypress="return IsNumeric(event);" ondrop="return false;" required>
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
                                                                    <option value="Cold">Cold Lead</option>
                                                                    <option value="Warm">Warm Lead</option>
                                                                    <option value="Hot">Hot Lead</option>
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
                                                                    <option value="December">December">
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
                                                                <input type="text" class="form-control input-lg m-bot15" id="potential_opportunity" name="potential_opportunity" value="0"
                                                                placeholder="Potential Opportunity" onkeypress="return IsNumeric(event);" ondrop="return false;">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="chance_of_sales" class="bmd-label-floating"> Chance of Sales (%)

                                                                    <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Percentage Chance of closing this sales deal. For cold leas, you may set 10%; 25% for warm lead and 50% for hot lead" style="cursor: pointer;">
                                                                        ?
                                                                    </span>

                                                                </label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="chance_of_sales" name="chance_of_sales" value="10" max="100" onkeypress="return IsNumeric(event);" ondrop="return false;" style="font-weight:bolder;">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class=" row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="weighted_forecast" class="bmd-label-floating"> Weighted Forecast*</label>
                                                                <input type="text" class="form-control input-lg m-bot15" id="weighted_forecast" style="font-weight:bolder;" 
                                                                name="weighted_forecast" required onkeypress="return IsNumeric(event);" ondrop="return false;">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="weighted_forecast" class="bmd-label-floating"> Pipeline Stage*</label>
                                                                <select class="form-control mb-4" id="wes-from1" id="pipeline_stage" name="pipeline_stage" required>
                                                                    <option value="Prospecting" selected>Prospecting</option>
                                                                    <option value="Qualifying">Qualifying</option>
                                                                    <option value="Contacted">Contacted</option>
                                                                    <option value="Negotiation">Negotiation</option>
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
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 layout-spacing">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                                <div class="widget widget-content-area br-4">
                                    <div class="widget-one" style="padding: 10px;">

                                        <h6>Types of Leads</h6>

                                        <p class="mb-0 mt-3">
                                            <span style="font-weight:bolder;">A cold lead </span>is one that hasn't shown any interest in your product, yet perfectly fits your ideal customer.
                                        </p>

                                        <p class="mb-0 mt-3">
                                            <span style="font-weight:bolder;">A warm </span> is one that is already familiar with the way your business.
                                            These are the type of leads who happen to follow your blogs, watches your videos,
                                            or even gained familiarity through a past conversation with someone else.
                                            Any user that has your product in their wish list is automatically added to a warm lead
                                        </p>

                                        <p class="mb-0 mt-3">
                                            <span style="font-weight:bolder;">A Hot lead </span> the kind of lead that has shown interest in your product in one way or the other.
                                            Any user that has your product in their cart is automatically added to a hot lead
                                        </p>

                                    </div>
                                </div>
                            </div>
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

<script src="crm/js/extra.js"></script>

</body>

</html>