<?php

class ThisSupplierPurchaseController
{
    static public function thisSupplierPurchases($supplier_key){
        require_once('../../../model/purchases/ThisSupplierPurchasesModel.php');
        $getSales   = ThisSupplierPurchasesModel::thisSupplierPurchases($supplier_key);

        return $getSales;
    }
}