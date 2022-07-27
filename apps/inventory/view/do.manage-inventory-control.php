<?php
require_once '../../template/index.php';

require_once 'DoInventoryCors.php';
$page_name         = "do.inventory_control";
$token             = DoInventoryCors::inventoryCategoryCors($page_name);

$_SESSION['inventory_control_token']  = $token;


//get all brands
require_once('../controller/GetInventoryBrands.php');
$all_brands = GetInventoryBrands::loadAllBrands();


//get all categories
require_once('../controller/GetAllInventoryCategories.php');
$allInventoryCat = GetAllInventoryCategories::allCategories();

//get all categories
require_once('../controller/LoadInventorySubCat.php');
$doInventorySubCat = LoadInventorySubCat::loadSubCat();

//get all inventory master
require_once('../controller/GetAllInventoryMaster.php');
$inventoryMaster = GetAllInventoryMaster::loadInventoryMaster();


//get all UOM
require_once('../../settings/controller/GetAllUOMController.php');
$uom = GetAllUOMController::allUOM();
?>

<div id="content" class="main-content">
    <div class="row">
        <div id="tabsVerticalWithIcon" class="col-lg-10 col-10  offset-1 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Edit Inventory Control</h4>
                        </div>
                    </div>
                </div>

                <div class="statbox widget box box-shadow">

                    <div class="widget-content widget-content-area border-top-tab">
                        <ul class="nav nav-tabs mb-3 mt-3" id="borderTop" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="border-top-home-tab" data-toggle="tab" href="#border-top-home" role="tab" aria-controls="border-top-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg> Edit Brands</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-profile-tab" data-toggle="tab" href="#border-top-profile" role="tab" aria-controls="border-top-profile" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg> Inventory Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-contact-tab" data-toggle="tab" href="#border-top-contact" role="tab" aria-controls="border-top-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg> Inventory Sub Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="border-top-setting-tab" data-toggle="tab" href="#border-top-setting" role="tab" aria-controls="border-top-setting" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg> Inventory Master Items</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="borderTopContent">
                            <div class="tab-pane fade show active" id="border-top-home" role="tabpanel" aria-labelledby="border-top-home-tab">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Brand Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Brand Name</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($all_brands as $abd) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $abd['name']; ?></td>
                                                <td><?php echo $abd['meta_title']; ?></td>
                                                <td><?php echo $abd['meta_description']; ?></td>
                                                <td><?php echo Date('Y-m-d', strtotime($abd['created_at'])); ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $abd['id']; ?>" onclick="editInventoryBrands(this)" data-toggle="modal" data-target="#editInventoryMasterModal" title="Edit Inventory Category">
                                                                Edit Brand
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="border-top-profile" role="tabpanel" aria-labelledby="border-top-profile-tab">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($allInventoryCat as $ict) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $ict['cat_name']; ?></td>
                                                <td><?php echo $ict['cat_desc']; ?></td>
                                                <td><?php echo Date('Y-m-d', strtotime($ict['system_date'])); ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ict['cat_ID']; ?>" onclick="editInventoryCategory(this)" data-toggle="modal" data-target="#editInventoryMasterModal" title="Edit Inventory Category">
                                                                Edit Inventory Category
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="border-top-contact" role="tabpanel" aria-labelledby="border-top-contact-tab">

                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Date Added</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($doInventorySubCat as $isc) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $isc['cat_name']; ?></td>
                                                <td><?php echo $isc['sub_cat_name']; ?></td>
                                                <td><?php echo Date('Y-m-d', strtotime($isc['system_date'])); ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $isc['sub_cat_ID']; ?>" onclick="editInventorySubCat(this)" data-toggle="modal" data-target="#editInventoryMasterModal" title="Edit Inventory Sub Category">
                                                                Edit Sub Category
                                                            </a>

                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="border-top-setting" role="tabpanel" aria-labelledby="border-top-setting-tab">
                                <table id="html5-extension" class="table table-hover non-hover html5-extension" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Internal Reference</th>
                                            <th>Re-Order Rule</th>
                                            <th>Unit Price</th>
                                            <th>Inventory Description</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Internal Reference</th>
                                            <th>Re-Order Rule</th>
                                            <th>Unit Price</th>
                                            <th>Inventory Description</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach ($inventoryMaster as $im) {
                                        ?>
                                            <tr>
                                                <td></td>
                                                <td><?php echo $im['inventory_code']; ?></td>
                                                <td><?php echo $im['inventory_name']; ?></td>
                                                <td><?php echo $im['Internal_ref']; ?></td>
                                                <td><?php echo $im['re_order_rule']; ?></td>
                                                <td><?php echo isset($im['unit_cost']) ? number_format($im['unit_cost'], 2) : "0.00"; ?></td>
                                                <td><?php echo $im['inventory_desc']; ?></td>
                                                <td class="text-right">

                                                    <div class="btn-group">
                                                        <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                                <polyline points="6 9 12 15 18 9"></polyline>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                            <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $im['inventory_ID']; ?>" onclick="editInventoryMaster(this)" data-toggle="modal" data-target="#editInventoryMasterOnly" title="Edit Inventory Master">
                                                                Edit Inventory Master
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editInventoryMasterModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Manage Inventory Control</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body" id="inventoryModalContentLG">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-xl" tabindex="-1" id="editInventoryMasterOnly" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Manage Inventory Control</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body" id="inventoryMasterItemModalContentLG">

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