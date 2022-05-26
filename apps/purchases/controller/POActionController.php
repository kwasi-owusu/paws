<?php
//session_start();
require_once('../../../model/purchases/POActionModel.php');
class POActionController
{
    static public function actionPO($po_ID){
        $tbl_a      = 'new_purch_oder';
        $tbl_c      = 'po_financials';
        $tbl_e      = 'users_tbl';
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];

        $data       = array(
            'po_ID'=>$po_ID,
            'ub'=> $branch_owner,
            'ur'=> $userRole
        );
        $getRst     = POActionModel::actOnPO($tbl_a, $tbl_c, $tbl_e, $data);

        return $getRst;
    }

    static public function getPOItems($po_ID){
        $tbl    = 'purchase_order_items';
        $getItms    = POActionModel::poDetails($tbl, $po_ID);

        return $getItms;
    }

    static public function loadPOItems($po_ID){
        $tbl    = 'purchase_order_items';
        $getItms    = POActionModel::poItemsDetails($tbl, $po_ID);

        return $getItms;
    }

    static public function pfi($po_ID){
        $tbl        = 'pfi_images';
        $getPFIs    = POActionModel::getPFIs($tbl, $po_ID);

        return $getPFIs;
    }
}