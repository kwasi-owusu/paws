<?php


class ValueInventoryCtrl
{
    public static function totalInventoryValue(){
        require_once '../model/InventoryValuation.php';

        $getRst     = InventoryValuation::valueInventory();

        return $getRst;
    }

    public static function totalWIPInventoryValue(){
        require_once '../model/InventoryValuation.php';

        $getRst     = InventoryValuation::wipValuation();

        return $getRst;
    }
}