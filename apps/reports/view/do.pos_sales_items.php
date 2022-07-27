<?php

$saleID     = $_REQUEST['id'];

/// get category by ID
require_once('../../pos/controller/CTRPOSSalesReport.php');
$rst         = CTRPOSSalesReport::thisYrSalesDetails($saleID);
$fetchRst    = $rst->fetchAll();
?>
<table class="table table-striped table-no-bordered table-hover thisTable"
       style="width:100%">
    <thead>
    <tr>
        <th></th>
        <th>Transaction No</th>
        <th>Item Code</th>
        <th>Item Name</th>
        <th>Unit Price</th>
        <th>Qty</th>
        <th>Sub Total</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($fetchRst as $thm){
    ?>
    <tr>
        <td></td>
        <td><?php echo $thm['transaction_code']; ?></td>
        <td><?php echo $thm['inventory_code']; ?></td>
        <td><?php echo $thm['inventory_name']; ?></td>
        <td><?php echo $thm['unit_price']; ?></td>
        <td><?php echo $thm['qty']; ?></td>
        <td><?php echo $thm['sub_total']; ?></td>
        <?php
        }
        ?>
    </tbody>
</table>
