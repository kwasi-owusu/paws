<?php


class GetAllCustomerCategories
{
    static public function allCustomerCategory()
    {
        $tbl = 'customercategories';
        require_once('../../../model/crm/AllCustomerCat.php');
        $allCat    = AllCustomerCat::fetchAllCustomerCat($tbl);

        return$allCat;
    }
}