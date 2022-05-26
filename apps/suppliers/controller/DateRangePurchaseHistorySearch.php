<?php


class DateRangePurchaseHistorySearch
{
    static public function ctrSearchPurchaseHistory($supplierID, $start_date, $end_date){
        $tbl        = 'new_purch_oder';
        require_once '../../../model/suppliers/SupplierPurchaseHistoryMdl.php';
        $getRst     = SupplierPurchaseHistoryMdl::supplierHistoryWithDateRange($tbl, $supplierID, $start_date, $end_date);

        return $getRst;
    }
}