<?php


class GetAllTaxes
{
    static public function allTax(){
        require_once ('../../../model/settings/GetAllTaxModel.php');

        $tbl        = 'setup_tax';
        $getRst     = GetAllTaxModel::getAllTax($tbl);

        return $getRst;
    }
}