function createNewCustomer(itm) {
    $('<div>').load('bamboo/view/modules/pos/modals/createCustomer.php', function (data) {
        $("#loadModalHere").html(data);
    });

}


$(document).ready(function(){
    $("#searchProductHere").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#allItemsHere div").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


$('#point_of_sale_form').on('submit', function(e){
    //$('#saveBtn').prop('disabled', true);
    $("#loader").show(); 
    e.preventDefault();

    let str     = "Testing POS Printer";
    let enc_dt  = window.btoa(str);
    //let amountDue   = parseFloat($('#amountDue').val());
    //if (amountDue != '' && amountDue <= 0.00) {
    $.ajax({
        url: "pos/controller/AddNewPOSSales.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data){
            $("#loader").hide(); 

            let dat="";
            // window.onload = callFunction();

            // function callFunction()
            // {
            //     setInterval(ajax(),500);
            // }

            // function ajax()
            // {
            //     let rawdat= data;
            //     let xhttp = new XMLHttpRequest();

            //     url = 'http://localhost:9100/htbin/kp.py';
            //     xhttp.open("POST", url, false); //browser has to wait until the data finished loaded
            //     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //     xhttp.onreadystatechange = function(){
            //         if(this.readyState==4 && this.status == 200)
            //         {
            //             alert(this.responseText);
            //         }

            //     }

            //     xhttp.send("p=EPSONRECEIPT&data="+rawdat);
            // }


            // $.ajax({url:'http://127.0.0.1:9100/htbin/kp.py',
            //     data:{p:'EPSONRECEIPT', data:data},
            //     success:function(bytes){
            //         console.log(bytes);
            //     }
            // });

            //     $.ajax({url:'http://127.0.0.1:9100/htbin/kp.py',
            // 		data:{p:'EPSONRECEIPT'},
            // 		success:function(status){
            // 			console.log(status);
            // 		}
            // });

            //         $.ajax({url:'http://127.0.0.1:9100/htbin/kp.py',
            //    success:function(list_printers){
            //   console.log(list_printers);
            //      }
            //     });

            Snackbar.show({
                text: data,
                actionTextColor: '#fff',
                backgroundColor: '#2196f3'
            });
            //setInterval('location.reload()', 3000);
        }
    });
    // }
    // else {
    //     $("#pos_gif_loader").hide();
    //     $.toast({
    //         heading: 'Rails ERP',
    //         text: "Amount Paid cannot be less than Amount Due",
    //         icon: 'info',
    //         loader: true,
    //         position: 'top-right',
    //         loaderBg: '#9EC600'
    //     });
    // }
});

$('#store_setup_frm').on('submit', function(e){
    $("#save_gif_loader").show();
    e.preventDefault();
    $.ajax({
        url: "bamboo/controller/pos/AddNewStoreCtr.php",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            $("#save_gif_loader").hide();
            $.toast({
                heading: 'Rails ERP',
                text: data,
                icon: 'info',
                loader: true,
                position: 'top-right',
                loaderBg: '#9EC600'
            });
            setInterval('location.reload()', 3000);
        }
    });
});

function editThisShop(itm) {
    let id = $(itm).attr("data-id");
    $('#loadPageHere').load('bamboo/view/modules/pos/editThisShop.php?id=' + id, function (data) {
        $("#loadPageHere").html(data);
    });
}

function addSalesPerson(itm) {
    let id = $(itm).attr("data-id");
    $('<div>').load('bamboo/view/modules/pos/modals/addSalesPerson.php?id=' + id, function (data) {
        $("#loadModalHere").html(data);
    });

}

function transferToPOS(itm) {
    let id = $(itm).attr("data-id");
    $('<div>').load('bamboo/view/modules/pos/modals/transfer_to_shop.php?id=' + id, function (data) {
        $("#loadModalHere").html(data);
    });

}