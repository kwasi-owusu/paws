<?php


class GetThisSupplierStatus
{
    static public function supplierStatus($supplier_ID){
        require_once('../../../../model/suppliers/GetThisSupplierStatusModel.php');
        $tbl        = 'suppliers';
        $getStatus  = GetThisSupplierStatusModel::getStatus($tbl, $supplier_ID);

        return $getStatus;
    }
}