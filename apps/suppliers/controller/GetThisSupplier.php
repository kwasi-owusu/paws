<?php

require_once('../../../model/suppliers/GetThisSupplierModel.php');
class GetThisSupplier
{
    static public function loadThisSupplier($supplier_ID){
        $loadSupplier = GetThisSupplierModel::callThisSupplier($supplier_ID);

        return $loadSupplier;
    }
}