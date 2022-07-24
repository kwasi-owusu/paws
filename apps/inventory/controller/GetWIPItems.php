<?php


class GetWIPItems
{
    public static function callWIPItems(){
        require_once '../model/WIPItems.php';
        $getRst     = WIPItems::thisWIPItems();

        return $getRst;
    }
}