<?php
session_start();    

require_once '../DoCustomerCors.php';

$page_name         = "edit_this_customer";

$editCustomerToken = DoCustomerCors::editCustomerCors($page_name);
$_SESSION['editCustomerToken'] = $editCustomerToken;


$customer_ID = $_REQUEST['id'];

?>
<form id="customer_delete_frm" class="section work-experience" action="" method="post" autocomplete="off">
    <div class="modal-body">
        <p class="">If you delete this customer it will be gone forever. Are you sure you want to proceed?</p>

        <input type="hidden" class="form-control input-lg m-bot15" id="customer_ID" name="customer_ID" value="<?php echo $customer_ID; ?>" readonly>
        <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $editCustomerToken; ?>" readonly>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="saveBtn">Delete</button>
        <!-- <button type="button" class="btn btn-danger" data-remove="task">Delete</button> -->
    </div>

    <p id="responseHere"></p>
</form>

<script>
    $("#customer_delete_frm").on("submit", function(e) {
        $("#saveBtn").prop("disabled", true);
        $("#loader").show();
        e.preventDefault();
        $.ajax({
            url: "crm/controller/DeleteCustomerController.php",
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
</script>