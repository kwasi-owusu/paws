function weighted_forecast() {
  let potential_opportunity = parseFloat($("#potential_opportunity").val());
  let chance_of_sales = parseFloat($("#chance_of_sales").val()) / 100;

  let wtf = chance_of_sales * potential_opportunity;

  if (potential_opportunity !== "" || chance_of_sales !== "") {
    $("#weighted_forecast").val(wtf).toFixed(2);
  } else {
    $("#weighted_forecast").val("000");
  }
}

$(document).on(
  "change keyup blur",
  "#potential_opportunity, #chance_of_sales",
  function (e) {
    weighted_forecast();
  }
)
// apportion chance of sale depending on the lead_type
function lead_type_percent() {
  let lead_type = $("#lead_type").val();

  let cold_percent = 10;
  let warm_percent = 25;
  let hot_percent = 50;

  if (lead_type == "Cold") {
    $("#chance_of_sales").val(cold_percent);
  } else if (lead_type == "Warm") {
    $("#chance_of_sales").val(warm_percent);
  } else if (lead_type == "Hot") {
    $("#chance_of_sales").val(hot_percent);
  }
}

$(document).on("change", "#lead_type", function () {
  lead_type_percent();
  weighted_forecast();
}
);


let specialKeys = new Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
  let keyCode = e.which ? e.which : e.keyCode;
  console.log(keyCode);
  let ret =
    (keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1;
  return ret;
}

$("#sales_leads_form").on("submit", function (e) {
  $("#saveBtn").prop("disabled", true);
  $("#loader").show();
  e.preventDefault();
  $.ajax({
    url: "crm/controller/NewSalesLeads.php",
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

        $("#loader").hide();

        setInterval("location.reload()", 3000);
      });

      $("#saveBtn").prop("disabled", false);
    },
  });
});

$("#customer_add_frm").on("submit", function (e) {
  $("#saveBtn").prop("disabled", true);
  $("#loader").show();
  e.preventDefault();
  $.ajax({
    url: "crm/controller/AddNewCustomer.php",
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

        $("#loader").hide();

        setInterval("location.reload()", 3000);
      });

      $("#saveBtn").prop("disabled", false);
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

//check if customer email exists
$(document).on("change keyup blur", "#customa_email", function () {
  let email = $(this).val();
  let check_where = "customers";

  $.ajax({
    url: "settings/controller/CheckEmails.php",
    type: "POST",
    //dataType:"json",
    data: { email: email, check_where: check_where },
    success: function (data) {
      if (data == "Email Exists") {
        $("#saveBtn").prop("disabled", true);

        $("#responseHere").html(data);
      } else {
        $("#saveBtn").prop("disabled", false);

        $("#responseHere").text("");
      }
    },
  });
});

//fill contact person
$(document).on("change keyup blur", "#customa_name", function () {
  let customer_name = $(this).val();

  $("#contact_person").val(customer_name);
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
