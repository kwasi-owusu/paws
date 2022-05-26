<?php
session_start();

$contact_ID = $_REQUEST['id'];

require_once '../DoContactCors.php';

$page_name  = "deleteContact";
$contactEditCors = DoContactCors::deleteContact($page_name);
$_SESSION['contactEdit'] = $contactEditCors;

$token = $contactEditCors;

require_once('../../controller/GetThisContact.php');
$cst    = GetThisContact::thisContact($contact_ID);
?>
<h5 class="modal-title" id="myLargeModalLabel">Delete Contact</h5>

<form id="edit_contact_frm" class="section work-experience" action="" method="post" autocomplete="off">
    <div class ="row">
        <div class ="col-md-12">
            <h4>You won't be able to reverse this.</h4>
            <p style="text-align:center; color: #ff0000;">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="last-name">
                <input type="hidden" id="tkn" name="tkn" class="form-control" readonly required value="<?php echo $token; ?>">
                <input type="hidden" id="contact_ID" name="contact_ID" class="form-control" readonly required value="<?php echo $contact_ID; ?>">
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
    <p></p>

    <hr />
    <div class="row">
        <div class="col-md-12 text-right mb-5">
            <button class="btn btn-danger btn-rounded mr-3" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
            <button type="submit" class="btn btn-success btn-rounded" id="saveBtn">Yes, Delete</button>
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
            url: "contacts/controller/DeleteThisContactDetailsController.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,

            success: function(data) {
                $('#responseHereModal').fadeOut('slow', function() {
                    $('#responseHereModal').fadeIn('slow').html(data);
                    $("#loader").hide();
                    setInterval('location.reload()', 4000);
                });
            }
        });
    });
</script>