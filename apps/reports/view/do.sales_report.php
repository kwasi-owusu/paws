<?php

require_once('../../../controller/accounting/GetSalesInvoiceCtrl.php');
$getOrders = GetSalesInvoiceCtrl::doSalesInvoice();

require_once('../../../controller/users/GetAllRolesController.php');
$getBrn = GetAllRolesController::getAllBranches();

if (isset($_POST['searchBtn'])) {
    //$error = false;
    //collect search form inputs
    $branch_name    = trim($_POST['branch_name']);
    $start_date     = trim($_POST['start_date']);
    $end_date       = trim($_POST['end_date']);
    //$end_date     = str_replace(" ", "-", $state_region);

    if ($branch_name != '' && $start_date != '' && $end_date != '') {
        header('Location: search_branch_sales_report/' . $branch_name . "/" . $start_date . "/" . $end_date);
        exit();
    }
}
require_once '../../../view/main.template.php';
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa fa-bar-chart-o"></i> Sales Report</h3>
            </div>
        </div>
        <!-- page start-->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <section class="panel">
                    <div style="border: 2px solid #666666; border-radius: 2px; padding: 10px; margin-bottom: 10px;">
                        <h4>Advance Date Range Search</h4>
                        <hr/>
                        <form id="search_supplier_po_history" action="" method="post" autocomplete="off"
                              role="form">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="firstName" class="bmd-label-floating"> Select a Branch</label>
                                        <select class="form-control input-lg m-bot15" data-size="7" data-style="btn btn-primary btn-round"
                                                name="branch_name" id="branch_name" required>
                                            <?php
                                            foreach ($getBrn as $br){
                                                ?>
                                                <option value="<?php echo $br['branch_name']; ?>"><?php echo $br['branch_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                        <input type="hidden" class="form-control input-lg m-bot15" id="select_suppliers"
                                               name="select_suppliers" required value="<?php echo $supp_ID; ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="firstName" class="bmd-label-floating"> Start Date *</label>
                                        <input type="date" class="form-control input-lg m-bot15" id="start_date"
                                               name="start_date" required value="<?php echo Date('Y-m-d'); ?>">

                                        <input type="hidden" class="form-control input-lg m-bot15" id="select_suppliers"
                                               name="select_suppliers" required value="<?php echo $supp_ID; ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="firstName" class="bmd-label-floating"> End Date *</label>
                                        <input type="date" class="form-control input-lg m-bot15" id="end_date"
                                               name="end_date" required value="<?php echo Date('Y-m-d'); ?>">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="firstName" class="bmd-label-floating"></label>
                                        <input type="submit" name="searchBtn" id="searchBtn"
                                               class="btn btn-primary form-control input-lg m-bot15" value="Search">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-no-bordered table-hover thisTable" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Order No</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Approval Status</th>
                                <th>Sales To</th>
                                <th>Instruction Note</th>
                                <th>Entry By</th>
                                <th>Entry On</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Order No</th>
                                <th>Customer Name</th>
                                <th>Order Date</th>
                                <th>Approval Status</th>
                                <th>Sales To</th>
                                <th>Instruction Note</th>
                                <th>Entry By</th>
                                <th>Entry On</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            foreach ($getOrders as $fd) {

                                $status = '';

                                $approval_status = $fd['approval_status'];
                                switch ($approval_status) {
                                    case 0:
                                        $status .= "Pending";
                                        break;

                                    case 1:
                                        $status .= "Approved";
                                        break;

                                    case 2:
                                        $status .= "Rejected";
                                        break;

                                    default:
                                        $status .= "";
                                }

                                $sales_to     = '';
                                $sales_to_production    = $fd['sales_to_production'];
                                switch ($sales_to_production){
                                    case 0:
                                        $sales_to .= "Unknown";
                                        break;

                                    case 1:
                                        $sales_to .= "Production";
                                        break;

                                    case 2:
                                        $sales_to .= "Store (Export)";
                                        break;

                                    case 3:
                                        $sales_to .= "Store (Local)";
                                        break;

                                    default:
                                        $sales_to .= "";
                                }
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $fd['order_No']; ?></td>
                                    <td><?php echo $fd['customa_name']; ?></td>
                                    <td><?php echo $fd['order_dt']; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $sales_to; ?></td>
                                    <td><?php echo $fd['instruction_note']; ?></td>
                                    <td><?php echo $fd['userEmail']; ?></td>
                                    <td><?php echo $fd['addedOn']; ?></td>
                                    <td class="text-right">

                                        <a href="javascript:void(0)"
                                           class="btn btn-link btn-danger btn-just-icon remove"
                                           title="Print Sales Invoice" data-id="<?php echo $fd['sales_order_ID']; ?>"
                                           onclick="printSalesInvoice(this)">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>

                                    </td>

                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
            <hr/>
            <div class="col-lg-10 col-lg-offset-1">
                <iframe width="100%" src="" id="putSOHere"
                        style="height:1000px; margin-top:10px; border-color: transparent;">

                </iframe>
            </div>

        </div>

    </section>

    </div>
    <!-- chart morris start -->
    </div>
    <!-- page end-->
</section>
</section>
<!--main content end-->
</section>
<!-- container section start -->
<?php
require_once '../footer.php';
?>

<script src="bamboo/view/modules/accounting/js/extra.js"></script>
</body>

</html>
