<?php


class GetThisCategoryController
{
    static public function thisCustomerCategory($cat_ID)
    {
        $tbl = 'customercategories';
        require_once('../../../../model/crm/ThisCustomerCat.php');

        $allCat    = ThisCustomerCat::fetchThisCustomerCat($tbl, $cat_ID);

        return$allCat;
    }
}