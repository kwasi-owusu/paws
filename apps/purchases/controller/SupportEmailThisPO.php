<?php


class SupportEmailThisPO
{
    static public function supportThisApprovedPOToEmail($po_ID){
        require_once '../../model/purchases/SupportPOToEmail.php';
        $getRst     = SupportPOToEmail::SupportThisApprovedPOToEmail($po_ID);

        return $getRst;

    }
}