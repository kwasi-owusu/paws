let specialKeys = new Array();
specialKeys.push(8, 46); //Backspace
function IsNumeric(e) {
  let keyCode = e.which ? e.which : e.keyCode;
  console.log(keyCode);
  let ret =
    (keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1;
  return ret;
}

//inventory category
$("#inv_brands_form").on("submit", function (e) {
  $("#saveBtn_").prop("disabled", true);
  $("#loader_").show();
  e.preventDefault();
  $.ajax({
    url: "inventory/controller/SaveInventoryBrandsCTRL.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
        $("#loader").hide();
        Snackbar.show({
          text: data,
          actionTextColor: "#fff",
          backgroundColor: "#2196f3",
        });
        setInterval("location.reload()", 3000);
    },
  });
});


$("#inv_cat_form").on("submit", function (e) {
  $("#saveBtn_a").prop("disabled", true);
  $("#loader").show();
  e.preventDefault();
  $.ajax({
    url: "inventory/controller/AddInventoryCategory.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
        $("#loader").hide();
        Snackbar.show({
          text: data,
          actionTextColor: "#fff",
          backgroundColor: "#2196f3",
        });
        setInterval("location.reload()", 3000);
    },
  });
});

//inventory sub category
$("#inv_sub_cat_form").on("submit", function (e) {
    $("#saveBtn_b").prop("disabled", true);
    $("#loader_b").show();
  e.preventDefault();
  $.ajax({
    url: "inventory/controller/InventorySubCategories.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
        $("#loader_b").hide();
        Snackbar.show({
          text: data,
          actionTextColor: "#fff",
          backgroundColor: "#2196f3",
        });
        setInterval("location.reload()", 3000);
    },
  });
});

//inventory items
$("#inventory_itm_frm").on("submit", function (e) {
  tinyMCE.triggerSave();
  $("#saveBtn_c").prop("disabled", true);
    $("#loader_c").show();
  e.preventDefault();
  $.ajax({
    url: "inventory/controller/SaveInventoryItems.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
        $("#loader_c").hide();
        Snackbar.show({
          text: data,
          actionTextColor: "#fff",
          backgroundColor: "#2196f3",
        });
        setInterval("location.reload()", 3000);
    },
  });
});

$(document).ready(function () {
  $(".thisUomTable").DataTable({
    processing: false,
    serverSide: false,
    // 'ajax': {
    //     'url':'bamboo/view/modules/settings/dataTableServerSide.php',
    // },
    // "columns": [
    //     { "data": "um" },
    //     { "data": "ds" },
    //     { "data": "da" }
    // ],
    // pageLength: 5,

    pagingType: "full_numbers",
    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ],
    buttons: ["copy", "csv", "excel", "pdf", "print"],

    order: [[1, "asc"]],
  });
});

// get all sub category
$(document).on("change", "#product_cat", function () {
  let sbc = $("#product_cat").val();

  $.ajax({
    url: "inventory/controller/GetSubCatController.php",
    type: "POST",
    //dataType:"json",
    data: { sbc: sbc },
    success: function (data) {
      $("#sub_ca_here").html(data);
    },
  });
});

$("#inventory_name").on("keyup", function () {
  let invName = $(this).val();
  $("#Internal_ref").val(invName);
});

function inventoryHistory(itm) {
    let id = $(itm).attr("data-id");
    $("#historyHere").load(
      "inventory/view/check.inventory_history.php?id=" + id,
      function (data) {
        $("#historyHere").html(data);
      }
    );
  }

function editInventoryMaster(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/edit.inventory_items.php?id=" + id,
    function (data) {
      $("#inventoryMasterItemModalContentLG").html(data);
    }
  );
}


function editInventoryCategory(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/edit.inventory_category.php?id=" + id,
    function (data) {
      $("#inventoryModalContentLG").html(data);
    }
  );
}

function editInventorySubCat(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/edit.inventory_sub_category.php?id=" +
      id,
    function (data) {
      $("#inventoryModalContentLG").html(data);
    }
  );
}

function editInventoryBrands(itm) {
    let id = $(itm).attr("data-id");
    $("<div>").load(
      "inventory/view/modals/edit.inventory_sub_category.php?id=" +
        id,
      function (data) {
        $("#inventoryModalContentLG").html(data);
      }
    );
  }

function scrapInventoryRequest(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/scrap_inventory_request.php?id=" + id,
    function (data) {
      $("#loadModalHere").html(data);
    }
  );
}

function transferInventory(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/transfer_inventory_request.php?id=" +
      id,
    function (data) {
      $("#loadModalHere").html(data);
    }
  );
}

function inventoryCountVariance(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/count_inventory_request.php?id=" + id,
    function (data) {
      $("#loadModalHere").html(data);
    }
  );
}

function stockShopQuick(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "inventory/view/modals/stock_shop_quick.php?id=" + id,
    function (data) {
      $("#ModalContentLG").html(data);
    }
  );
}

let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
let string_length = 10;
var item_code = "";
for (var i = 0; i < string_length; i++) {
  var rnum = Math.floor(Math.random() * chars.length);
  item_code += chars.substring(rnum, rnum + 1);
}
document.getElementById("inventory_code").value = item_code;