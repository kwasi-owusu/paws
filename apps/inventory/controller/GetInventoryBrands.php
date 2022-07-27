<?php
class GetInventoryBrands{
    public static function loadAllBrands(){
        require_once ('../model/GetAllBrands.php');
        $tbl        = 'brands';
        $getRst     = GetAllBrands::getAllBrands($tbl);

        return $getRst;
    }
}