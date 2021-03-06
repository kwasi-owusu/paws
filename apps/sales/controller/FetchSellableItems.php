<?php

class FetchSellableItems
{
    public static function callSellableItems(){
        require_once('../../settings/controller/ExpiryCheckDuration.php');
        $expiryDays     = ExpiryCheckDuration::checkExpiry();
        $fetchArrayType = $expiryDays->fetch(PDO::FETCH_ASSOC);
        $noDays         = $fetchArrayType['expiryDays'];

        $userType       = $_SESSION['user_type'];

        require_once('../../sales/model/GetSellableItems.php');
        $tbl_a      = 'inventory_master';
        $tbl_b      = 'sales_stock';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'sales_persons';
        $tbl_e      = 'pos_store';

        $me         = $_SESSION['uid'];   
        $myBranch   = $_SESSION['branch_name'];
        $getRst     = GetSellableItems::allSellableItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e , $myBranch, $noDays, $userType, $me);

        return $getRst;
    }

    public static function branchSellableItems($branchName){
        require_once('../../settings/controller/ExpiryCheckDuration.php');
        $expiryDays     = ExpiryCheckDuration::checkExpiry();
        $fetchArrayType = $expiryDays->fetch(PDO::FETCH_ASSOC);
        $noDays         = $fetchArrayType['expiryDays'];

        $userType       = $_SESSION['user_type'];

        require_once('../model/sales/GetSellableItems.php');
        $tbl_b      = 'inventory_master';
        $tbl_a      = 'product_storage_tbl';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'inventory_sub_cat';
        $tbl_e      = 'warehouse';

        //$myBranch   = $_SESSION['branch_name'];
        $getRst     = GetSellableItems::branchStockLevels($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $branchName, $userType);

        return $getRst;
    }

    public static function getAllSellableItems(){
        require_once('../../settings/controller/ExpiryCheckDuration.php');
        $expiryDays     = ExpiryCheckDuration::checkExpiry();
        $fetchArrayType = $expiryDays->fetch(PDO::FETCH_ASSOC);
        $noDays         = $fetchArrayType['expiryDays'];

        $userType       = $_SESSION['user_type'];

        require_once('../../sales/model/sales/GetSellableItems.php');
        $tbl_b      = 'inventory_master';
        $tbl_a      = 'product_storage_tbl';
        $tbl_c      = 'inventory_cat';
        $tbl_d      = 'inventory_sub_cat';
        $tbl_e      = 'warehouse';

        $myBranch   = $_SESSION['branch_name'];
        $getRst     = GetSellableItems::LoadAllSellableItems($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e);

        return $getRst;
    }

    public static function costAllSellableItems(){
        require_once('../../settings/controller/ExpiryCheckDuration.php');
        $expiryDays     = ExpiryCheckDuration::checkExpiry();
        $fetchArrayType = $expiryDays->fetch(PDO::FETCH_ASSOC);
        $noDays         = $fetchArrayType['expiryDays'];

        $userType       = $_SESSION['user_type'];

        require_once('../model/GetSellableItems.php');
        $tbl_a      = 'sales_stock';

        $myBranch   = $_SESSION['branch_name'];
        $getRst     = GetSellableItems::costThisSellableItems($tbl_a);

        return $getRst;
    }
}