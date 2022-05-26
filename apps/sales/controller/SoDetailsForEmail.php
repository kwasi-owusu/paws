<?php


class SoDetailsForEmail
{
    static public function getSODetails($sales_order_ID){
        $tbl_a  = 'sales_tbl';
        $tbl_b  = 'sales_items';
        $tbl_c  = 'salesorderfinancial';
        $tbl_d  = 'customers';
        $tbl_e  = 'inventory_master';

        require_once '../../model/sales/SalesOrderDetailsForMailMDL.php';

        $getRst = SalesOrderDetailsForMailMDL::getThisSalesOrderDetails ($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $sales_order_ID);

        return $getRst;
    }
}