<?php

require_once('../../model/purchases/PODetailsModel.php');
require_once('../../model/purchases/GetPOTaxes.php');
class PODetailsForEmail
{
    static public function detailPO($po_ID){
        $tbl_a      = 'new_purch_oder';
        $tbl_c      = 'po_financials';
        $tbl_e      = 'users_tbl';

        $data       = array(
            'po_ID'=>$po_ID
        );
        $getRst     = PODetailsModel::loadPODetails($tbl_a, $tbl_c, $tbl_e, $data);

        return $getRst;
    }

    static public function loadPOTaxes(){
        $soTaxes    = GetPOTaxes::soTaxes();

        return $soTaxes;
    }

    //call Taxes

    static public function doCallVAT(){
        $vt     = GetPOTaxes::doGetVAT();

        return $vt;
    }


    static public function doCallNHIL(){
        $nh     = GetPOTaxes::doGetNHIL();

        return $nh;
    }

    static public function doCallGetFund(){
        $gtf     = GetPOTaxes::doGetFund();

        return $gtf;
    }
}