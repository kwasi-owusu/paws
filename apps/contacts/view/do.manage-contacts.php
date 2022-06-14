<?php
require_once '../../template/index.php';

require_once 'DoContactCors.php';
$page_name         = "add_new_contacts";
$token             = DoContactCors::addContactCors($page_name);
$_SESSION['contact_cors'] = $token;

require_once '../controller/GetAllContacts.php';

$loadContacts = GetAllContacts::callAllContacts();
$cntAllContacts = $loadContacts->rowCount();


// contact categories

?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-spacing layout-top-spacing" id="cancel-row">
            <div class="col-lg-12">
                <div class="widget-content searchable-container grid" style="height:800px; overflow-x:scroll;">

                    <div class="row">
                        <div class="col-xl-10 col-lg-10 col-md-7 col-sm-7 filtered-list-search layout-spacing align-self-center">
                            <form class="form-inline my-2 my-lg-0">
                                <div class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts...">
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-5 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                            <div class="d-flex justify-content-sm-end justify-content-center">
                                <svg id="btn-add-contact" onclick="addNewContact(this)" data-toggle="modal" data-target="#addContactModal" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                            <div class="add-contact-box">
                                                <div class="add-contact-content">
                                                    <form id="add_contact_frm" class="section work-experience" action="" method="post" autocomplete="off">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="first-name">
                                                                    <i class="flaticon-user-11"></i>
                                                                    <input type="text" id="first_name" class="form-control" name="firstName" placeholder="First Name" required>
                                                                    <span class="validation-text"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="last-name">
                                                                    <i class="flaticon-mail-26"></i>
                                                                    <input type="text" id="c-last_name" name="lastName" class="form-control" placeholder="Last Name" required>
                                                                    <input type="hidden" id="tkn" name="tkn" class="form-control" readonly required value="<?php echo $token; ?>">
                                                                    <span class="validation-text"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <div class="contact-location">
                                                                    <i class="flaticon-telephone"></i>
                                                                    <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email" required>
                                                                    <span class="validation-text"></span>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="contact-location">
                                                                    <i class="flaticon-telephone"></i>
                                                                    <input type="tel" id="phone" name="contact_phone" class="form-control" placeholder="Phone" required>
                                                                    <span class="validation-text"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="contact-location">
                                                                    <i class="flaticon-fill-area"></i>
                                                                    <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Organization">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="contact-location">
                                                                    <i class="flaticon-fill-area"></i>
                                                                    <input type="text" id="job_title" name="job_title" class="form-control" placeholder="Job Title">
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="contact-location">
                                                                <span> Select Contact Category*</span>
                                                                    <select class="form-control mb-4" id="wes-from1" id="customer_category" name="customer_category" required>
                                                                    
                                                                    <?php
                                                                    $contactCats = GetAllContacts::contactCats();

                                                                    foreach ($contactCats as $cts){
                                                                    ?>
                                                                    <option value="<?php echo $cts['cnt_cat_ID']; ?>" selected><?php echo $cts['cat_name']; ?></option>

                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </select>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="contact-location">
                                                                    <i class="flaticon-location-1"></i>
                                                                    <textarea class="form-control" maxlength="150" id="contact_notes" name="contact_notes" placeholder="Notes"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p></p>
                                                        <div class="col-md-12 text-right mb-5">
                                                            <button type="submit" class="btn btn-secondary" id="saveBtn">Add</button>
                                                        </div>
                                                        <p id="responseHere"></p>
                                                        <small id="errorResponseHere" style="color:red;"></small>
                                                    </form>

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

                    <div class="searchable-items grid">
                        <!-- <div class="items items-header-section">
                            <div class="item-content">
                                <div class="">
                                    <div class="n-chk align-self-center text-center">
                                        <label class="new-control new-checkbox checkbox-primary">
                                            <input type="checkbox" class="new-control-input" id="contact-check-all">
                                            <span class="new-control-indicator"></span>
                                        </label>
                                    </div>
                                    <h4>Name</h4>
                                </div>
                                <div class="user-email">
                                    <h4>Email</h4>
                                </div>
                                <div class="user-location">
                                    <h4 style="margin-left: 0;">Location</h4>
                                </div>
                                <div class="user-phone">
                                    <h4 style="margin-left: 3px;">Phone</h4>
                                </div>
                                <div class="action-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </div>
                            </div>
                        </div> -->

                        <?php
                        if ($cntAllContacts > 0) {
                            $fetchAllContacts = $loadContacts->fetchAll();

                            foreach ($fetchAllContacts as $cnt) {
                        ?>
                                <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                    <input type="checkbox" class="new-control-input contact-chkbox">
                                                    <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <div class="user-meta-info">
                                                <p class="user-name" data-name="Alan Green"><?php echo $cnt['firstName'] . " " . $cnt['lastName']; ?></p>
                                                <p class="user-work" data-occupation="Web Developer"><?php echo $cnt['job_title']; ?></p>
                                            </div>
                                        </div>
                                        <div class="user-email">
                                            <p class="info-title">Organization: </p>
                                            <p class="usr-email-addr" data-email="alan@mail.com"><?php echo $cnt['company_name']; ?></p>
                                        </div>
                                        <div class="user-location">
                                            <p class="info-title">Email: </p>
                                            <p class="usr-location" data-location="Boston, USA"><?php echo $cnt['contact_email']; ?></p>
                                        </div>
                                        <div class="user-phone">
                                            <p class="info-title">Phone: </p>
                                            <p class="usr-ph-no" data-phone=""><?php echo $cnt['contact_phone']; ?></p>
                                        </div>

                                        <div class="user-notes">
                                            <p class="info-title">Notes: </p>
                                            <p class="usr-ph-no" data-phone=""><?php echo $cnt['contact_notes']; ?></p>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit" onclick="editContact(this)" data-toggle="modal" data-target="#manageContactModalSM" data-id="<?php echo $cnt['contact_ID']; ?>">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus delete warning cancel" data-id="<?php echo $cnt['contact_ID']; ?>" data-toggle="modal" data-target="#manageContactModalSM" onclick="deleteContact(this)">
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="8.5" cy="7" r="4"></circle>
                                                <line x1="23" y1="11" x2="17" y2="11"></line>
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<h6>No Contacts Available. You may click on the add button to add a new contact</h6>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>

<!-- <div class="modal fade bd-example-modal-sm" tabindex="-1" id="manageContactModalSM" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body" id="contactModalContentSM">

                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="manageContactModalSM" tabindex="-1" role="dialog" aria-labelledby="deleteConformationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="deleteConformationLabel">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contactModalContentSM">

            </div>
        </div>
    </div>
</div>





<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<script>
    $('#add_contact_frm').on('submit', function(e) {
        $("#loader").show();
        e.preventDefault();
        $('#saveBtn').prop('disabled', true);
        $.ajax({
            url: "contacts/controller/AddNewContact.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(data) {
                $('#responseHere').fadeOut('slow', function() {
                    $('#responseHere').fadeIn('slow').html(data);
                    $("#loader").hide();
                    setInterval('location.reload(true)', 3000);
                });
            }
        });
    });
</script>

<script>
    $(document).on("change keyup blur", "#contact_email", function() {
        let email = $(this).val();
        let check_where = "contacts";

        $.ajax({
            url: "settings/controller/CheckEmails.php",
            type: "POST",
            //dataType:"json",
            data: {
                email: email,
                check_where: check_where
            },
            success: function(data) {

                if (data == "Email Exists") {
                    $("#saveBtn").prop("disabled", true);

                    $("#errorResponseHere").html(data);
                } else {
                    $("#saveBtn").prop("disabled", false);

                    $("#errorResponseHere").text("");
                }
            },
        });
    })
</script>
<script src="contacts/js/extra.js"></script>

</body>

</html>