<?php
require_once '../../template/index.php';

require_once 'DoCustomerCors.php';
$page_name         = "add_new_customer";
$token             = DoCustomerCors::addCustomer($page_name);

$_SESSION['addCustomerTkn']  = $token;

require_once('../controller/GetAllCustomers.php');
$getCustomers = GetAllCustomers::allCustomerListController();

?>

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="w-content">
                        <span class="w-value" style="padding: 15px; font-size:20px; font-weight:bolder;">Manage Customers</span>
                    </div>
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State/Region</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th class="dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State/Region</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            foreach ($getCustomers as $ac) {
                                $_status    = $ac['customerStatus'];
                                $thisStatus = '';
                                switch ($_status) {
                                    case 1:
                                        $thisStatus .= 'Active';
                                        break;
                                    case 2:
                                        $thisStatus .= 'Deactivated';
                                        break;
                                    default:
                                        $thisStatus .= '';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $ac['CCCode']; ?></td>
                                    <td><?php echo $ac['customa_name']; ?></td>
                                    <td><?php echo $ac['customa_email']; ?></td>
                                    <td><?php echo $ac['customa_phone']; ?></td>
                                    <td><?php echo $ac['customa_address1']; ?></td>
                                    <td><?php echo $ac['town_city']; ?></td>
                                    <td><?php echo $ac['name']; ?></td>
                                    <td><?php echo $ac['country_name']; ?></td>
                                    <td><?php echo $thisStatus; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ac['customa_ID']; ?>" onclick="editThisCustomer(this)" data-toggle="modal" data-target="#manageCustomerModalLG">
                                                    Edit Customer
                                                </a>

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ac['customa_ID']; ?>" onclick="deleteThisCustomer(this)" data-toggle="modal" data-target="#deleteConfirmation">
                                                    Delete Customer
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="manageCustomerModalLG" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="customerModalContentLG">

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="deleteConfirmationLabel">
            <div class="modal-header">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </div>
                <h5 class="modal-title" id="exampleModalLabel">Delete this Customer?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalContentHere">

            </div>
        </div>
    </div>
</div>

<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>
<script src="crm/js/extra.js"></script>

</body>

</html>