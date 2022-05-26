<?php


class CustomerCategoryController
{
    static public function getCustomerCategory()
    {
        $tbl = 'customercategories';
        require_once('../../../../model/crm/fetchAllCustomerCat.php');
        $allCat    = fetchAllCustomerCat::loadAllCustomerCat($tbl);

        return$allCat;
    }
}