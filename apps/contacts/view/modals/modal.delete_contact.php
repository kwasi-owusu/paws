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


<h6>Do you really want to Delete this contact?</h6>
<p style="color:red;">You won't be able to reverse this.</p>

<form id="edit_contact_frm" class="section work-experience" action="" method="post" autocomplete="off">
    <div class="row">
        <div class="col-md-6">
            <div class="last-name">
                <input type="hidden" id="tkn" name="tkn" class="form-control" readonly required value="<?php echo $token; ?>">
                <input type="hidden" id="contact_ID" name="contact_ID" class="form-control" readonly required value="<?php echo $contact_ID; ?>">
                <span class="validation-text"></span>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="saveBtnModal">Yes, Delete</button>
    </div>
</form>

<div class="col-12">
    <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
</div>
<p id="responseHereModal"></p>


<script>
    $('#edit_contact_frm').on('submit', function(e) {
        $("#loader").show();
        $('#saveBtnModal').prop('disabled', true);
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