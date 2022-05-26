<?php


class AllCategoriesforModal
{
    static public function fetchCustomerCategory()
    {
        $tbl = 'customercategories';
        require_once('../../../../model/crm/AllCustomerCategories.php');
        $allCat = AllCustomerCategories::AllCustomerCat($tbl);

        return $allCat;
    }

}