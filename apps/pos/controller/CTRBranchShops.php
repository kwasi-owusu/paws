<?php


class CTRBranchShops
{
    public static function callBranchShops($itemBranch){
        require_once ('../../../../model/pos/ListBranchShops.php');
        $tbl        = 'pos_store';

        $getRst     = ListBranchShops::loadBranchShops($tbl, $itemBranch);

        return $getRst;
    }
}