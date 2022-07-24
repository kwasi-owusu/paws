<?php


class InventoryReOrderReport
{
    public static function getReorderRuleReport(){
        require_once('../model/ReorderLimitReport.php');
        $tbl    = 'inventory_master';
        $tbl_b  = 'inventory_cat';
        $tbl_c  = 'inventory_sub_cat';
        $getRst = ReorderLimitReport::getReorderRuleRpt($tbl, $tbl_b, $tbl_c);

        return $getRst;
    }
}