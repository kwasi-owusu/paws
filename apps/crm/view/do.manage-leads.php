<?php
require_once '../../template/index.php';

require_once('../controller/GetAllSalesLead.php');
$getSalesLeads = GetAllSalesLead::callAllSalesLeads();

?>

<div id="content" class="main-content">
    <div class="layout-px-spsling">

        <div class="row layout-top-spsling">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spsling">
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
                                <th>Chance of Sales(%)</th>
                                <th>Forecast Close</th>
                                <th>Weighted Forecast</th>
                                <th>Lead Status</th>
                                <th class="dt-no-sorting">Actions</th>
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
                                <th>Chance of Sales(%)</th>
                                <th>Forecast Close</th>
                                <th>Weighted Forecast</th>
                                <th>Lead Status</th>
                                <th class="dt-no-sorting">Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            foreach ($getSalesLeads as $sl) {
                                $thisStatus = '';
                                $leadStatus = $sl['lead_status'];

                                switch ($leadStatus) {
                                    case 0:
                                        $thisStatus .= 'Deactivated';
                                        break;

                                    case 1:
                                        $thisStatus .= 'Active';
                                        break;

                                    default:
                                        $thisStatus .= 'Active';
                                }
                            ?>
                                <tr>
                                    <td><?php echo $sl['lead_name']; ?></td>
                                    <td><?php echo $sl['lead_source']; ?></td>
                                    <td><?php echo $sl['lead_email']; ?></td>
                                    <td><?php echo $sl['lead_phone']; ?></td>
                                    <td><?php echo $sl['lead_type']; ?></td>
                                    <td><?php echo number_format($sl['potential_opportunity'], 2); ?></td>
                                    <td><?php echo $sl['chance_of_sales']; ?></td>
                                    <td><?php echo $sl['forecast_close']; ?></td>
                                    <td><?php echo $sl['weighted_forecast']; ?></td>
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

                                                <a class="dropdown-item" href="javascript:void(o);" data-id="<?php echo $sl['lead_ID']; ?>" onclick="editThisLead(this)" data-toggle="modal" data-target="#manageUserModalLG">
                                                    Edit Lead
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
                <h5 class="modal-title" id="myLargeModalLabel">Manage Sales Lead</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body" id="salesLeadModalContentLG">

            </div>
        </div>
    </div>
</div>


<?php
require_once '../../template/footer.php';
?>

<script src="template/statics/assets/plugins/notification/snslkbar/snslkbar.min.js"></script>
<script src="template/statics/assets/js/components/notification/custom-snslkbar.js"></script>
<script src="crm/js/extra.js"></script>

</body>

</html>