<?php


class GetWIPItems
{
    static public function callWIPItems(){
        require_once '../../../model/inventory/WIPItems.php';
        $getRst     = WIPItems::thisWIPItems();

        return $getRst;
    }
}