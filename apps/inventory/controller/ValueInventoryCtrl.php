<?php


class ValueInventoryCtrl
{
    static public function totalInventoryValue(){
        require_once '../../../model/inventory/InventoryValuation.php';

        $getRst     = InventoryValuation::valueInventory();

        return $getRst;
    }

    static public function totalWIPInventoryValue(){
        require_once '../../../model/inventory/InventoryValuation.php';

        $getRst     = InventoryValuation::wipValuation();

        return $getRst;
    }
}