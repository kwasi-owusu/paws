<?php
require_once '../../template/index.php';

require_once 'DoInventoryCors.php';
$page_name         = "do.inventory_control";
$token             = DoInventoryCors::inventoryCategoryCors($page_name);

$_SESSION['inventory_control_token']  = $token;


//get all categories
require_once('../controller/GetAllInventoryCategories.php');
$allInventoryCat = GetAllInventoryCategories::allCategories();

//get all inventory master
require_once('../controller/GetAllInventoryMaster.php');
$inventoryMaster = GetAllInventoryMaster::loadInventoryMaster();


//get all UOM
require_once('../../settings/controller/GetAllUOMController.php');
$uom = GetAllUOMController::allUOM();
?>

<div id="content" class="main-content">
    <div class="row">
        <div id="tabsVerticalWithIcon" class="col-lg-10 col-10 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Inventory Control</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area rounded-vertical-pills-icon">

                    <div class="row mb-4 mt-3">
                        <div class="col-sm-4 col-12">
                            <div class="nav flex-column nav-pills mb-sm-0 mb-3" id="rounded-vertical-pills-tab" role="tablist" aria-orientation="vertical">

                                <a class="nav-link mb-2 active mx-auto" id="rounded-vertical-pills-brands-tab" data-toggle="pill" href="#rounded-vertical-pills-brands" role="tab" aria-controls="rounded-vertical-pills-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> Inventory Brands
                                </a>

                                <a class="nav-link mb-2 mx-auto" id="rounded-vertical-pills-home-tab" data-toggle="pill" href="#rounded-vertical-pills-category" role="tab" aria-controls="rounded-vertical-pills-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> Inventory Category
                                </a>
                                <a class="nav-link mb-2 mx-auto" id="rounded-vertical-pills-profile-tab" data-toggle="pill" href="#rounded-vertical-pills-sub-category" role="tab" aria-controls="rounded-vertical-pills-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> Inventory Sub Category
                                </a>
                                <a class="nav-link mb-2 mx-auto" id="rounded-vertical-pills-messages-tab" data-toggle="pill" href="#rounded-vertical-pills-item" role="tab" aria-controls="rounded-vertical-pills-messages" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg> Inventory Items
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-8 col-12">
                            <div class="tab-content" id="rounded-vertical-pills-tabContent">
                                <div class="tab-pane fade show active" id="rounded-vertical-pills-brands" role="tabpanel" aria-labelledby="rounded-vertical-pills-brands-tab">
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                        <form id="inv_brands_form" class="section work-experience" action="" method="post" autocomplete="off">
                                            <div class="info">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating"> Brand Name *</label>
                                                            <input type="text" class="form-control input-lg m-bot15" id="brand_name" name="brand_name" required="true">
                                                            <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $token; ?>" required="true" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating">Brand
                                                                Description</label>
                                                            <input type="text" class="form-control input-lg m-bot15" id="meta_description" name="meta_description">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating">Brand Logo</label>
                                                            <input type="file" class="form-control" name="brand_img" id="brand_img">
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-info pull-right" name="saveBtn_" id="saveBtn_">Save
                                                    </button>
                                                </div>

                                                <div class="col-12">
                                                    <div class="loader multi-loader mx-auto" style="display: none;" id="loader_"></div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="rounded-vertical-pills-category" role="tabpanel" aria-labelledby="rounded-vertical-pills-home-tab">
                                    <form id="inv_cat_form" action="" method="post" autocomplete="off">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Category Name *</label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="cat_name" name="cat_name" required="true">
                                                        <input type="hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $token; ?>" required="true" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Category
                                                            Description</label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="cat_desc" name="cat_desc">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-info pull-right" name="saveBtn_a" id="saveBtn_a">Save
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <div class="loader multi-loader mx-auto" style="display: none;" id="loader"></div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="rounded-vertical-pills-sub-category" role="tabpanel" aria-labelledby="rounded-vertical-pills-profile-tab">
                                    <form id="inv_sub_cat_form" action="" method="post" autocomplete="off">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Select Category Name
                                                            *</label>
                                                        <select class="form-control input-lg m-bot15" name="inventory_cat" id="inventory_cat">
                                                            <?php
                                                            foreach ($allInventoryCat as $ic) {
                                                            ?>
                                                                <option value="<?php echo $ic['cat_ID']; ?>"><?php echo $ic['cat_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Sub Category Name
                                                            *</label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="sub_cat_name" name="sub_cat_name" required>
                                                        <input type="hidden" class="form-control input-lg m-bot15" id="tkn" name="tkn" value="<?php echo $token; ?>" required readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-info pull-right" name="save_qir" id="saveBtn_b">Save
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <div class="loader multi-loader mx-auto" style="display: none;" id="loader_b"></div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="rounded-vertical-pills-item" role="tabpanel" aria-labelledby="rounded-vertical-pills-messages-tab">
                                    <form id="inventory_itm_frm" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Inventory Category</label>
                                                        <select class="form-control input-lg m-bot15" name="product_cat" id="product_cat">
                                                            <option value="999">--Select Inventory Category--
                                                            </option>
                                                            <?php
                                                            foreach ($allInventoryCat as $nic) {
                                                            ?>
                                                                <option value="<?php echo $nic['cat_ID']; ?>"><?php echo $nic['cat_name']; ?></option>">
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Inventory Sub
                                                            Category</label>
                                                        <select class="form-control input-lg m-bot15" name="inventory_sub_cat" id="get_inv_sub">
                                                            <option value="999">N/A</option>
                                                            <optgroup label="Choose Sub Category" id="sub_ca_here">

                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Inventory Brand</label>
                                                        <select class="form-control input-lg m-bot15" name="get_itm_brand">
                                                            <option value="999">Not Applicable</option>
                                                            <option value="1">Guinness</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Inventory Code *</label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="inventory_code" name="inventory_code" required ">
                                                        <input type=" hidden" class="form-control" id="tkn" name="tkn" value="<?php echo $token; ?>" required readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Inventory Name *</label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="inventory_name" name="inventory_name" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Internal Reference
                                                            <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="What is this product named among yourselves." style="cursor: pointer;">
                                                                ?
                                                            </span>
                                                        </label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="Internal_ref" name="Internal_ref" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Rea-order Rule *
                                                            <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="What quantity should you be prompted for restocking." style="cursor: pointer;">
                                                                ?
                                                            </span>
                                                        </label>
                                                        <input type="text" class="form-control input-lg m-bot15" id="re_order_rule" name="re_order_rule" required onkeypress="return IsNumeric(event);" ondrop="return false;">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label> UOM
                                                            <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Unit of Measurement" style="cursor: pointer;">
                                                                ?
                                                            </span>
                                                        </label>
                                                        <select class="form-control input-lg m-bot15" name="uom">
                                                            <?php
                                                            foreach ($uom as $u) {
                                                            ?>
                                                                <option value="<?php echo $u['uom']; ?>" selected><?php echo $u['uom']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label> Inventory Prefix</label>
                                                        <select class="form-control input-lg m-bot15" name="prod_prefix">
                                                            <?php
                                                            foreach ($uom as $u) {
                                                            ?>
                                                                <option value="<?php echo $u['uom']; ?>" selected><?php echo $u['uom']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--                                                    <div class="col-md-6">-->
                                                <!--                                                        <label for="formFile" class="form-label">Upload Institution Logo</label>-->
                                                <!--                                                        <input class="form-control" type="file" id="inst_logo" name="inst_logo" required>-->
                                                <!--                                                    </div>-->

                                            </div>

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating"> Inventory Item
                                                            Image</label>
                                                        <input type="file" class="form-control" name="item_img" id="item_img">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <label>Sellable
                                                        <span class="bs-popover rounded" data-container="body" data-trigger="hover" data-content="Sellable inventory are those that are sold on the POS." style="cursor: pointer;">
                                                            ?
                                                        </span>
                                                    </label>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="sellable" value="1">
                                                                If checked, product will be displayed in the POS
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <label> Enable Description </label>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" value="1" name="enable_desc">
                                                                If checked, Item will display with Description in
                                                                POS
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label> Inventory Description </label>
                                                    <div class="form-group">
                                                        <textarea class="WYSIWYG" name="inventory_desc" cols="40" rows="3" id="item_desc" spellcheck="true"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-info pull-right" name="saveBtn_" id="saveBtn_c">Save
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <div class="loader multi-loader mx-auto" style="display: none;" id="loader_c"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>

<script src="template/statics/assets/plugins/editors/quill/quill.js"></script>
<script src="template/statics/assets/plugins/editors/quill/custom-quill.js"></script>

<script src="template/statics/assets/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/functions.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/mtiny.js"></script>
<script src="template/statics/assets/tinymce/js/tinymce/tinymce.min.js"></script>


<script>
    tinymce.init({
        selector: '#item_desc',
        height: 400,
        menubar: true,

        plugins: ['advlist autolink lists link charmap print preview anchor textcolor', 'searchreplace visualblocks code fullscreen', 'insertdatetime table paste code help wordcount'],
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',


    });
</script>

<script src="inventory/js/extra.js"></script>

</body>

</html>