let specialKeys = new Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
  let keyCode = e.which ? e.which : e.keyCode;
  console.log(keyCode);
  let ret =
    (keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1;
  return ret;
}

$("#spam_test_frm").on("submit", function (e) {
  $("#saveBtn").prop("disabled", true);

  $("#loader").show();

  e.preventDefault();
  $.ajax({
    url: "emailing/controller/SpamTestCheck.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,

    success: function (data) {
      $("#responseHere").fadeOut("slow", function () {
        $("#responseHere").fadeIn("slow").html(data);
        $("#saveBtn").prop("disabled", false);
        //$("#spam_test_frm").trigger("reset");
      });
      $("#loader").hide();
    },
  });
});

$("#upload_email_contacts_frm").on("submit", function (e) {
  $("#saveBtn").prop("disabled", true);

  $("#loader").show();

  e.preventDefault();
  $.ajax({
    url: "emailing/controller/AddEmailContacts.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,

    success: function (data) {
      $("#responseHere").fadeOut("slow", function () {
        Snackbar.show({
          text: data,
          actionTextColor: "#fff",
          backgroundColor: "#2196f3",
        });
        
        $("#saveBtn").prop("disabled", false);
      });
      $("#loader").hide();
    },
  });
});

//get all states_regions from selected country
$(document).on("change", "#thisCountry", function () {
  let cty = $(this).val();

  $.ajax({
    url: "settings/controller/States.php",
    type: "POST",
    //dataType:"json",
    data: { country: cty },
    success: function (data) {
      $("#states_here").html(data);
    },
  });
});

//get all cities
$(document).on("change", "#state_region", function () {
  let stt = $(this).val();

  $.ajax({
    url: "settings/controller/Cities.php",
    type: "POST",
    //dataType:"json",
    data: { region: stt },
    success: function (data) {
      $("#cities_here").html(data);
    },
  });
});

//generate customer code
let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
let code_length = 6;
let customer_code = "";
for (var i = 0; i < code_length; i++) {
  let gen_code = Math.floor(Math.random() * chars.length);

  customer_code += chars.substring(gen_code, gen_code + 1);
}
$("#CCCode").val(customer_code);

//edit customer modal
function editThisCustomer(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "crm/view/modals/modal.edit_customer.php?id=" + id,
    function (data) {
      $("#customerModalContentLG").html(data);
    }
  );
}

//delete customer
function deleteThisCustomer(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "crm/view/modals/modal.delete_customer.php?id=" + id,
    function (data) {
      $("#modalContentHere").html(data);
    }
  );
}

function editThisLead(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "crm/view/modals/modal.edit_lead.php?id=" + id,
    function (data) {
      $("#salesLeadModalContentLG").html(data);
    }
  );
}

//converts the textarea input into an array

$("#email_contact_list").keyup(function () {
  let contentVal = $(this).val().split(",");

  let totalContacts = contentVal.length;

  $("#responseHere").html("We found " + totalContacts + " contacts");
});

$(document).ready(function () {
  $(".contact_load_type").click(function () {
    let inputValue = $(this).attr("value");
    let targetBox = $("." + inputValue);
    $(".upload_div").not(targetBox).hide();
    $(targetBox).show();
  });
});

$(document).ready(function () {
  $(".contact_list_div").click(function () {
    let radioValue = $(this).attr("value");

    //$('#radio_value_here').html(radioValue);

    let targetDiv = $("." + radioValue);
    $(".list_div_here").not(targetDiv).hide();
    $(targetDiv).show();
  });
});
