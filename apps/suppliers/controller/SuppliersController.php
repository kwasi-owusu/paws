<?php


class SuppliersController
{
    static public function loadSupplierCategories(){
        require_once('../../../model/suppliers/GetAllSupplierCategories.php');
        $CallMethod     = GetAllSupplierCategories::loadAllSupplierCategories();

        return $CallMethod;
    }

}