function getThisInventory(itm) {
    let id = $(itm).attr("data-id");
    $('<div>').load('reports/view/do.get_inventory_items.php?id=' + id, function (data) {
        $("#salesDetailsModalContentLG").html(data);
    });
}

function getThisWIP(itm) {
    let id = $(itm).attr("data-id");
    $('<div>').load('reports/view/do.get_wip_items.php?id=' + id, function (data) {
        $("#salesDetailsModalContentLG").html(data);
    });
}

function salesDetails(itm) {
    let id = $(itm).attr("data-id");
    $('<div>').load('reports/view/do.pos_sales_items.php?id=' + id, function (data) {
        $("#salesDetailsModalContentLG").html(data);
    });
}


function downloadCostingDetails(itm) {
    let id = $(itm).attr("data-id");
    $('#putRMHere').attr("src", "bamboo/view/modules/reports/download_costing_details_pdf.php?id=" + id);
}

// function emailApprovedPO(itm) {
//     let id = $(itm).attr("data-id");
//     $('<div>').load('bamboo/view/modules/purchases/emailThisPO.php?id=' + id, function(data) {
//         $("#loadModalHere").html(data);
//     });
//
// }


// var minDate, maxDate;
//
// // Custom filtering function which will search data in column four between two values
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//         var min = minDate.val();
//         var max = maxDate.val();
//         var date = new Date( data[4] );
//
//         if (
//             ( min === null && max === null ) ||
//             ( min === null && date <= max ) ||
//             ( min <= date   && max === null ) ||
//             ( min <= date   && date <= max )
//         ) {
//             return true;
//         }
//         return false;
//     }
// );
//
// $(document).ready(function() {
//     // Create date inputs
//     minDate = new DateTime($('#min'), {
//         format: 'MMMM Do YYYY'
//     });
//     maxDate = new DateTime($('#max'), {
//         format: 'MMMM Do YYYY'
//     });
//
//     // DataTables initialisation
//     var table = $('#thisYearTable').DataTable();
//
//     // Refilter the table
//     $('#min, #max').on('change', function () {
//         table.draw();
//     });
// });