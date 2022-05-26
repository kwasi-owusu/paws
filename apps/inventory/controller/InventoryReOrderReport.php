<?php


class InventoryReOrderReport
{
    static public function getReorderRuleReport(){
        require_once('../../../model/inventory/ReorderLimitReport.php');
        $tbl    = 'inventory_master';
        $tbl_b  = 'inventory_cat';
        $tbl_c  = 'inventory_sub_cat';
        $getRst = ReorderLimitReport::getReorderRuleRpt($tbl, $tbl_b, $tbl_c);

        return $getRst;
    }
}