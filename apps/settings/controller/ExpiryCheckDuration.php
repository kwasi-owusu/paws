<?php

class ExpiryCheckDuration
{
    public static function checkExpiry(){
        require_once('../../settings/model/ExpiryCheckMdl.php');

        $tbl        = 'expirysetting';
        $getRst     = ExpiryCheckMle::checkNoOfMonths($tbl);

        return $getRst;
    }
}