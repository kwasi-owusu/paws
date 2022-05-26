<?php


class GetThisSupplierCategory
{
    static public function loadThisSupplierCategory($cat_ID){
        require_once('../../../../model/suppliers/GetThisSupplierCategoryModel.php');
        $CallMethod     = GetThisSupplierCategoryModel::thisSupplierCategory($cat_ID);

        return $CallMethod;
    }
}