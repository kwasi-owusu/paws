<?php


class SupplierPurchaseHistoryCtrl
{

    static public function getSupplierID($supp_key){
        $tbl        = 'suppliers';
        require_once '../../../model/suppliers/SupplierPurchaseHistoryMdl.php';
        $getID     = SupplierPurchaseHistoryMdl::getSuppID($tbl, $supp_key);

        return $getID;
    }

    static public function getSupplierPurchaseHistory($supp_ID){
        $tbl        = 'new_purch_oder';
        require_once '../../../model/suppliers/SupplierPurchaseHistoryMdl.php';
        $getRst     = SupplierPurchaseHistoryMdl::supplierHistory($tbl, $supp_ID);
        return $getRst;
    }
}