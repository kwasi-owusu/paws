$("#input-search").on("keyup", function () {
  var rex = new RegExp($(this).val(), "i");
  $(".searchable-items .items:not(.items-header-section)").hide();
  $(".searchable-items .items:not(.items-header-section)")
    .filter(function () {
      return rex.test($(this).text());
    })
    .show();
});

function editContact(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "contacts/view/modals/modal.edit_contact.php?id=" + id,
    function (data) {
      $("#contactModalContentSM").html(data);
    }
  );
}

function deleteContact(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "contacts/view/modals/modal.delete_contact.php?id=" + id,
    function (data) {
      $("#contactModalContentSM").html(data);
    }
  );
}function viewThisContact(itm) {
  let id = $(itm).attr("data-id");
  $("<div>").load(
    "contacts/view/modals/modal.contact_details.php?id=" + id,
    function (data) {
      $("#contactModalContentSM").html(data);
    }
  );
}

