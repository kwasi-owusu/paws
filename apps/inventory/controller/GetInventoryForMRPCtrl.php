<?php

require_once '../model/GetInventoryForMRP.php';
class GetInventoryForMRPCtrl
{
    public static function loadFG(){
        $getRst     = GetInventoryForMRP::getFG();

        return $getRst;
    }

    public static function loadOtherMaterials(){
        $getRst     = GetInventoryForMRP::getOtherMaterialsG();

        return $getRst;
    }

    public static function getFGWithMRP(){
        $my_branch = $_SESSION['branch_name'];
        $userType     = $_SESSION['user_type'];
        $getRst     = GetInventoryForMRP::getFGItemsWithBOM($my_branch, $userType);

        return $getRst;
    }
}