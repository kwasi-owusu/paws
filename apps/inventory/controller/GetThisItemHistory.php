<?php


class GetThisItemHistory
{
    static public function thisInventoryHistory(){
        require_once ('../../../model/inventory/GetThisItemHistoryModel.php');
        $tbl_a      = 'product_history';
        $tbl_b      = 'product_storage_tbl';
        $getRst     = GetThisItemHistoryModel::thisInventoryHistoryModel($tbl_a, $tbl_b);

        return $getRst;
    }
}