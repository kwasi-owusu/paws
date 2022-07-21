<?php
require_once '../../template/index.php';

require_once 'DoEmailCors.php';
$page_name         = "addEmailList.php";
$getToken          = DoEmailCors::addEmailLists($page_name);

$_SESSION['addEmailContactList']  = $getToken;

$merchant_ID = $_SESSION['merchant_ID'];
?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">

                        <div class="col-xl-8 col-lg-8 col-md-8 layout-spacing">

                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Upload Email Contacts</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">

                                    <form id="upload_email_contacts_frm" class="section work-experience" action="" method="post" autocomplete="off">
                                        <div id="vertical_step">
                                            <h3>Keyboard</h3>
                                            <section>
                                                <p>Confirmation of Terms</p>
                                                <div class="n-chk">
                                                    <label class="new-control new-checkbox checkbox-primary">
                                                        <input type="checkbox" class="new-control-input" id="confirm_terms" name="confirm_terms" required checked>
                                                        <span class="new-control-indicator"></span>
                                                        I confirm these contacts have consented to receive my email communications
                                                    </label>
                                                    <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $getToken; ?>">
                                                </div>
                                            </section>
                                            <h3>Effects</h3>
                                            <section>
                                                <p>How do you want to upload contacts?</p>
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-primary">
                                                        <input type="radio" class="new-control-input contact_load_type" name="upload_format" id="zip_csv_json_upload" value="zip_csv_json_upload" checked>
                                                        <span class="new-control-indicator"></span>
                                                        Upload contacts from file (csv only)
                                                    </label>
                                                </div>

                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-primary">
                                                        <input type="radio" class="new-control-input contact_load_type" name="upload_format" id="paste_email" value="paste_email">
                                                        <span class="new-control-indicator"></span>
                                                        Type or copy and paste contacts
                                                    </label>
                                                </div>

                                            </section>
                                            <h3>Pager</h3>
                                            <section>
                                                <p>Add Contacts.</p>
                                                <div id="upload_email_content_here" class="zip_csv_json_upload upload_div">
                                                    <p>Upload contacts from file (csv only)</p>

                                                    <div class="custom-file mb-4">
                                                        <input type="file" class="custom-file-input" id="contactCSVFile" name="contactCSVFile">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                </div>

                                                <div id="paste_email_content_here" class="paste_email upload_div" style="display: none;">
                                                    <p>Type or copy and paste contacts. Email contacts must be separated by a comma.</p>

                                                    <div class="input-group mb-4">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Type or Paste here.</span>
                                                        </div>
                                                        <textarea class="form-control" rows="5" aria-label="With textarea" name="email_contact_list" id="email_contact_list"></textarea>
                                                    </div>

                                                </div>
                                            </section>

                                            <h3>Pager</h3>
                                            <section>
                                                <p>Contact Fields</p>

                                                <p id="responseHere"></p>
                                            </section>

                                            <h3>Pager</h3>
                                            <section>
                                                <p>Assign Contacts</p>

                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-classic-primary">
                                                        <input type="radio" class="new-control-input contact_list_div" name="contact_list" id="contact_list" value="as_an_existing_list" checked>
                                                        <span class="new-control-indicator"></span>To an Existing List
                                                    </label>

                                                    <label class="new-control new-radio radio-classic-primary">
                                                        <input type="radio" class="new-control-input contact_list_div" name="contact_list" id="contact_list_r2" value="as_a_new_list">
                                                        <span class="new-control-indicator"></span>As a new List
                                                    </label>

                                                </div>

                                                <hr />

                                                <div class="col-md-12">
                                                    <div class="list_div_here as_an_existing_list">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="select_list" class="bmd-label-floating"> Select List*</label>

                                                                    <select class="form-control mb-4" id="select_contact_list" name="select_contact_list" required>
                                                                        <optgroup label="Default List">
                                                                            <option value="all_contact_list" selected>All Contacts</option>
                                                                        </optgroup>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div style="display: none;" class="list_div_here as_a_new_list">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="bmd-label-floating"> Enter list name*</label>
                                                                    <input type="text" class="form-control input-lg m-bot15" id="enter_contact_list" name="enter_contact_list">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class=" row">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="weighted_forecast" class="bmd-label-floating"> Select list status*</label>
                                                                <select class="form-control mb-4" id="wes-from1" id="select_list_status" name="select_list_status" required>
                                                                    <option value="Transactional" selected>Transactional</option>
                                                                    <option value="Active" selected>Active</option>
                                                                    <option value="Favorites">Favorites</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                    <option value="Unsubscribed">Unsubscribed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 text-right mb-5">
                                                        <button type="submit" class="btn btn-dark mb-2" id="saveBtn">Save</button>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                                                    </div>

                                                </div>

                                            </section>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-4 layout-spacing">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                                <div class="widget widget-content-area br-4">
                                    <div class="widget-one" style="padding: 10px;">
                                        <p>
                                            We support various formats but for the smoothest performance we recommend .csv file.
                                            Make sure that the file has included field labeled 'email'.
                                        </p>

                                        <hr />

                                        <p>
                                        <h5>CSV email upload template</h5>
                                        Should you choose to upload a .csv file, kindly download a template
                                        <a href="email_csv_template.csv" target="_blank">here</a>. Be sure not to change the labels.
                                        </p>
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

    </div>

</div>
</div>
</div>

<?php
require_once '../../template/footer.php';
?>


<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>
<script src="template/statics/assets/plugins/jquery-step/jquery.steps.min.js"></script>
<script src="template/statics/assets/plugins/jquery-step/custom-jquery.steps.js"></script>s

<script src="emailing/js/extra.js"></script>

</body>

</html>