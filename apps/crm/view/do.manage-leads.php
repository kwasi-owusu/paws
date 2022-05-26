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
                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Lead Name</th>
                                <th>Lead Source</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Lead Type</th>
                                <th>Potential Opportunity</th>
                                <th>Chance of Sales</th>
                                <th>Forecast Close/th>
                                <th>Weighted Forecast</th>
                                <th class="dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Lead Name</th>
                                <th>Lead Source</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Lead Type</th>
                                <th>Potential Opportunity</th>
                                <th>Chance of Sales</th>
                                <th>Forecast Close/th>
                                <th>Weighted Forecast</th>
                                <th class="dt-no-sorting">Action</th>
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
                                    <td><?php echo $ac['cat_name']; ?></td>
                                    <td><?php echo $ac['CCCode']; ?></td>
                                    <td><?php echo $ac['customa_name']; ?></td>
                                    <td><?php echo $ac['customa_email']; ?></td>
                                    <td><?php echo $ac['customa_phone']; ?></td>
                                    <td><?php echo $ac['customa_address1']; ?></td>
                                    <td><?php echo $thisStatus; ?></td>
                                    <td><?php echo $ac['contact_person']; ?></td>
                                    <td><?php echo $ac['contact_person_phone']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- <button type="button" class="btn btn-dark btn-sm">Open</button> -->
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference28" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuReference28">

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ac['customa_ID']; ?>" onclick="editThisUser(this)" data-toggle="modal" data-target="#manageUserModalLG">
                                                    Edit Customer
                                                </a>

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ac['customa_ID']; ?>" onclick="changePassword(this)" data-toggle="modal" data-target="#manageUserModalSM">
                                                    Delete Customer
                                                </a>

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $ac['customa_ID']; ?>" onclick="deactivateUser(this)" data-toggle="modal" data-target="#manageUserModalSM">
                                                    Change Status
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="manageUserModalLG" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Manage User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="userModalContentLG">

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" id="manageUserModalSM" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Manage User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="userModalContentSM">

            </div>
        </div>
    </div>
</div>

<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snackbar.js"></script>
<script src="auth/js/extra.js"></script>

</body>

</html>