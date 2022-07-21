var i = $('.pos_tbl tr').length;
function addMe(itm){

    let storage_ID  = $(itm).attr("data-id");


    let itemNm      = $(itm).attr("data-nm");
    let unit_cost   = parseFloat($(itm).attr("data-cst"));
    let itemCode    = $(itm).attr("data-code");
    let subTotal    = unit_cost;

    let stD = [];

    $('.storage_ID').each(function () {
        stD.push($(this).val());
    });

    //let checkForID  = $.inArray(stD, storage_ID)

    if ($.inArray(storage_ID, stD) === -1) {

        html = '<tr>';
        html += '<td><input class="case" type="checkbox"/></td>';
        html += '<td><input type="hidden" name="itemCode[]" id="itemCode" class="form-control input-lg m-bot15 itemCode" readonly value="' + itemCode + '"></td>';
        html += '<td><input type="hidden" name="storage_ID[]" id="storage_ID" class="form-control input-lg m-bot15 storage_ID" readonly value="' + storage_ID + '"></td>';
        html += '<td><input type="text" name="itemName[]" id="itemName_' + i + '" class="form-control input-lg m-bot15 search_itm chk_product" readonly value="' + itemNm + '"></td>';
        html += '<td><input type="text" name="price[]" id="price_' + i + '" class="form-control input-lg m-bot15 changesNo New_price for_Price unit_price" value="' + unit_cost + '" readonly ></td>';
        html += '<td><input type="text" name="quantity[]" id="quantity_' + i + '" class="form-control input-lg m-bot15 changesNo quantity" value="0" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
        html += '<td><input type="text" name="total[]" id="total_' + i + '" class="form-control input-lg m-bot15 totalLinePrice totalPrice" readonly></td>';
        html += '</tr>';
        $('.pos_tbl').append(html);
        i++;
        calculateAmountDue();
    }
    else {
        $.toast({
            heading: 'Rails ERP',
            text: itemNm + " already added",
            icon: 'info',
            loader: true,
            position: 'top-right',
            loaderBg: '#9EC600'
        });
    }
}

//to check all checkboxes
$(document).on('change', '#check_all', function () {
    $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function () {
    $('.case:checkbox:checked').parents("tr").remove();
    $('#check_all').prop("checked", false);
    calculateTotal();
});

//price change
$(document).on('change keyup blur', '.changesNo', function () {
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    quantity = $('#quantity_' + id[1]).val();
    price = $('#price_' + id[1]).val();
    if (quantity != '' && price != '') $('#total_' + id[1]).val((parseFloat(price) * parseFloat(quantity)).toFixed(2));
    calculateTotal();
});

$(document).on('change keyup blur', '#tax', function () {
    calculateTotal();
});

//total price calculation
// function calculateTotal() {
//     let subTotal = 0;
//     let total = 0;
//
//     $('.totalLinePrice').each(function () {
//         if ($(this).val() != '') subTotal += parseFloat($(this).val());
//     });
//
//     total = subTotal;
//
//     $('#totalAftertax').val(total.toFixed(2));
//     calculateAmountDue();
// }

function calculateTotal() {
    subTotal = 0;
    total = 0;
    $('.totalLinePrice').each(function () {
        if ($(this).val() != '') subTotal += parseFloat($(this).val());
    });

    $('#subTotal').val(subTotal.toFixed(2));
    tax = $('#tax').val();
    if (tax != '' && typeof (tax) != "undefined") {
        taxAmount = subTotal * (parseFloat(tax) / 100);
        $('#taxAmount').val(taxAmount.toFixed(2));
        total = subTotal + taxAmount;
    } else {
        $('#taxAmount').val(0);
        total = subTotal;
    }
    $('#totalAftertax').val(total.toFixed(2));
    calculateAmountDue();
}

$(document).on('change keyup blur', '#amountPaid', function () {
    calculateAmountDue();
});

//due amount calculation
function calculateAmountDue() {
    let amountPaid = $('#amountPaid').val();
    let total = $('#totalAftertax').val();
    //let totalAftertax = $('#totalAftertax').val();

    if (amountPaid != '' && typeof (amountPaid) != "undefined" && total != '' && typeof (total) != "undefined") {
        amountDue = parseFloat(total) - parseFloat(amountPaid);
        $('.amountDue').val(amountDue.toFixed(2));
    }

    // else {
    //     total = parseFloat(total).toFixed(2);
    //     $('.amountDue').val(total);
    // }
}

let specialKeys = Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
    let keyCode = e.which ? e.which : e.keyCode;
    console.log(keyCode);
    let ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);

    return ret;
}