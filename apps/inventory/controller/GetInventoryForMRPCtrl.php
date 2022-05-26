<?php

require_once '../../../model/inventory/GetInventoryForMRP.php';
class GetInventoryForMRPCtrl
{
    static public function loadFG(){
        $getRst     = GetInventoryForMRP::getFG();

        return $getRst;
    }

    static public function loadOtherMaterials(){
        $getRst     = GetInventoryForMRP::getOtherMaterialsG();

        return $getRst;
    }

    static public function getFGWithMRP(){
        $my_branch = $_SESSION['branch_name'];
        $userType     = $_SESSION['user_type'];
        $getRst     = GetInventoryForMRP::getFGItemsWithBOM($my_branch, $userType);

        return $getRst;
    }
}