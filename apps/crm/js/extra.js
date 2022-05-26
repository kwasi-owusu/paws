$(document).on(
  "change keyup blur",
  "#potential_opportunity, #chance_of_sales",
  function () {
    let potential_opportunity = parseFloat($("#potential_opportunity").val());
    let chance_of_sales = parseFloat($("#chance_of_sales").val()) / 100;

    let wtf = chance_of_sales * potential_opportunity;

    if (potential_opportunity !== '' || chance_of_sales !== '') {
      $("#weighted_forecast").val(wtf).toFixed(2);
    }

    else{
        $("#weighted_forecast").val("000");
    }
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

$('#sales_leads_form').on('submit', function(e){

    $('#saveBtn').prop('disabled', true);
    $("#loader").show(); 
    e.preventDefault();
    $.ajax({
        url: "crm/controller/NewSalesLeads.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            $('#responseHere').fadeOut('slow', function(){
                Snackbar.show({
                    text: data,
                    actionTextColor: '#fff',
                    backgroundColor: '#2196f3'
                });

                $("#loader").hide(); 

                setInterval('location.reload()', 3000);
            });

            $('#saveBtn').prop('disabled', false);
        }
    });
});
