<?php

session_start();
class POActionForPDFDownload
{
    static public function actionPO($po_ID){
        require_once('../../../model/purchases/POActionModel.php');
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
}