<?php

require_once('../../../model/suppliers/AllSuppliersList.php');
class GetAllSuppliersController
{
    static public function fetchSuppliers(){
        $allSuppliers = AllSuppliersList::getAllSuppliers();

        return $allSuppliers;
    }
}