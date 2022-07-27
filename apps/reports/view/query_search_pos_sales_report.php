<?php
$start_date = $_REQUEST['sd'];
$end_date   = $_REQUEST['ed'];

if (isset($start_date)) {
    require_once '../../../controller/sales/DateRangePOSSearch.php';

    //all time total
    $rangeRst = DateRangePOSSearch::totalRange($start_date, $end_date);

    //range sum
    $totalRangeSum = DateRangePOSSearch::totalRangeSum($start_date, $end_date);
}
require_once '../../../view/main.template.php';
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    <i class="fa fa fa-user"></i>POS Sales Report
                </h3>
            </div>
        </div>
        <!-- page start-->
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <section class="panel">
                    <div class="panel-body">
                        <div style="border: 2px solid #666666; border-radius: 2px; padding: 10px; margin-bottom: 10px;">
                            <h4>
                                Advance Date Range Search from <?php echo $start_date ." to ". $end_date; ?>
                            </h4>
                            <h4>
                                Total Sum GHS<?php echo number_format($totalRangeSum['sumTotal'], 2); ?>
                            </h4>
                        </div>
                        <hr/>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-no-bordered table-hover thisTable"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Transaction No</th>
                                    <th>Customer Name</th>
                                    <th>Order Day</th>
                                    <th>Order Month</th>
                                    <th>Order Year</th>
                                    <th>Payment Type</th>
                                    <th>Cost Point</th>
                                    <th>Total Amount</th>
                                    <th>Sales Person</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Transaction No</th>
                                    <th>Customer Name</th>
                                    <th>Order Day</th>
                                    <th>Order Month</th>
                                    <th>Order Year</th>
                                    <th>Payment Type</th>
                                    <th>Cost Point</th>
                                    <th>Total Amount</th>
                                    <th>Sales Person</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                foreach ($rangeRst as $alt){
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $alt['transaction_code']; ?></td>
                                    <td><?php echo $alt['customer']; ?></td>
                                    <td><?php echo $alt['sales_day']; ?></td>
                                    <td><?php echo $alt['sales_month']; ?></td>
                                    <td><?php echo $alt['sales_yr']; ?></td>
                                    <td><?php echo $alt['pmt_type']; ?></td>
                                    <td><?php echo $alt['branch_owner']; ?></td>
                                    <td><?php echo $alt['final_total']; ?></td>
                                    <td><?php echo $alt['firstName'] . " " . $alt['lastName']; ?></td>
                                    <td class="text-right">
                                        <a href="javascript:void(0)"
                                           class="btn btn-link btn-warning btn-just-icon edit"
                                           title="Sales Details"
                                           data-id="<?php echo $alt['transaction_ID']; ?>"
                                           onclick="salesDetails(this)" data-toggle="modal" data-target="#salesDetails">
                                            <i class="fa fa-bars"></i>
                                        </a>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr/>
                    <div class="modal fade" id="salesDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-body" id="loadModalHere">


                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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

<script src="bamboo/view/modules/reports/js/extra.js"></script>
<script src="bamboo/view/assets/zoomify/zoomify.js"></script>
</body>

</html>
