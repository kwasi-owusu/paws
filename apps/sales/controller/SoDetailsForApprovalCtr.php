<?php

class SoDetailsForApprovalCtr
{
    static public function getSODetails($sales_order_ID){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'sales_items';
        $tbl_c  = 'salesorderfinancial';
        $tbl_d  = 'customers';
        $tbl_e  = 'inventory_master';

        require_once '../../../model/sales/SoDetailsForApprovalMdl.php';

        $getRst = SoDetailsForApprovalMdl::getAllPendingSalesOrder ($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $sales_order_ID);

        return $getRst;
    }

    static public function getPlannedOrderDetails($sales_order_ID){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'sales_items';
        $tbl_c  = 'salesorderfinancial';
        $tbl_d  = 'customers';
        $tbl_e  = 'inventory_master';

        require_once '../../../model/sales/SoDetailsForApprovalMdl.php';

        $getRst = SoDetailsForApprovalMdl::getAllPlannedOrderItems ($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $sales_order_ID);

        return $getRst;
    }
}