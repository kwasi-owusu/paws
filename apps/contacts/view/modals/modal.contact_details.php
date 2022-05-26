<?php
session_start();

$contact_ID = $_REQUEST['id'];

require_once '../DoContactCors.php';

$page_name  = "editContact";
$contactEditCors = DoContactCors::editContact($page_name);
$_SESSION['contactEdit'] = $contactEditCors;

$token = $contactEditCors;

require_once('../../controller/GetThisContact.php');
$cst    = GetThisContact::thisContact($contact_ID);
?>

<h5 class="modal-title" id="myLargeModalLabel">Contact Details</h5>
<form id="edit_contact_frm" class="section work-experience" action="" method="post" autocomplete="off">
        <div class="row">
            <div class="col-md-6">
                <div class="first-name">
                    <i class="flaticon-user-11"></i>
                    <input type="text" id="first_name" class="form-control" name="firstName" placeholder="First Name" 
                    value="<?php echo $cst['firstName']; ?>" required readonly>
                    <span class="validation-text"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="last-name">
                    <i class="flaticon-mail-26"></i>
                    <input type="text" id="c-last_name" name="lastName" class="form-control" value="<?php echo $cst['lastName']; ?>" 
                    placeholder="Last Name" required readonly>
                    <input type="hidden" id="tkn" name="tkn" class="form-control" readonly required value="<?php echo $token; ?>">
                    <input type="hidden" id="contact_ID" name="contact_ID" class="form-control" readonly required value="<?php echo $contact_ID; ?>">
                    <span class="validation-text"></span>
                </div>
            </div>
        </div>
        <p></p>

        <div class="row">

            <div class="col-md-6">
                <div class="contact-location">
                    <i class="flaticon-telephone"></i>
                    <input type="email" id="emails" value="<?php echo $cst['contact_email'] ?>"  name="contact_email" class="form-control" 
                    placeholder="Email" required readonly>
                    <span class="validation-text"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-location">
                    <i class="flaticon-telephone"></i>
                    <input type="tel" id="phone" name="contact_phone" value="<?php echo $cst['contact_phone']; ?>"  
                    class="form-control" placeholder="Phone" required readonly>
                    <span class="validation-text"></span>
                </div>
            </div>
        </div>
        <p></p>

        <div class="row">
            <div class="col-md-6">
                <div class="contact-location">
                    <i class="flaticon-fill-area"></i>
                    <input type="text" id="company_name" name="company_name" value="<?php echo $cst['company_name']; ?>"  
                    class="form-control" placeholder="Organization" readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="contact-location">
                    <i class="flaticon-fill-area"></i>
                    <input type="text" id="job_title" name="job_title" class="form-control" value="<?php echo $cst['job_title']; ?>" 
                    placeholder="Job Title" readonly>
                </div>
            </div>

        </div>
        
        <p></p>

        <div class="row">
            <div class="col-md-12">
                <div class="contact-location">
                    <i class="flaticon-location-1"></i>
                    <textarea class="form-control" maxlength="150" id="contact_notes" readonly name="contact_notes" placeholder="Notes"><?php echo $cst['contact_notes']; ?></textarea>
                </div>
            </div>
        </div>
        
    </form>

    <div class="col-12">
        <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
    </div>
<p id="responseHereModal"></p>


<script>
    $('#edit_contact_frm').on('submit', function(e) {
        $("#loader").show();
        $('#saveBtn').prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "contacts/controller/UpdateContactDetailsController.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(data) {
                $('#responseHereModal').fadeOut('slow', function() {
                    $('#responseHereModal').fadeIn('slow').html(data);
                    $("#loader").hide();
                    setInterval('location.reload()', 3000);
                });
            }
        });
    });
</script>