<?php


class GetThisItemHistory
{
    public static function thisInventoryHistory(){
        require_once ('../model/GetThisItemHistoryModel.php');
        $tbl_a      = 'product_history';
        $tbl_b      = 'product_storage_tbl';
        $getRst     = GetThisItemHistoryModel::thisInventoryHistoryModel($tbl_a, $tbl_b);

        return $getRst;
    }
}