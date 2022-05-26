<?php


class ListPendingPOController
{

    static public function pendingPurchaseOrders(){
        require_once('../../../model/purchases/ListPendingPurchaseOrders.php');

        $tbl_a        = 'new_purch_oder';
        $tbl_b        = 'suppliers';
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];
        $getRst     = ListPendingPurchaseOrders::AllPendingPO($tbl_a, $tbl_b, $branch_owner, $userRole);

        return      $getRst;
    }

    static public function pendingPOForEdit($poKey){
        require_once('../../../model/purchases/ListPendingPurchaseOrders.php');

        $tbl_a      = 'new_purch_oder';
        $tbl_b      = 'purchase_order_items';
        $tbl_c      = 'po_financials';
        $tbl_d      = 'suppliers';
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];
        $getRst     = ListPendingPurchaseOrders::ThisPendingPO($tbl_a, $tbl_b, $tbl_c, $tbl_d, $poKey, $branch_owner, $userRole);

        return      $getRst;
    }

    static public function inboundPurchases(){
        require_once('../../../model/purchases/ListPendingPurchaseOrders.php');

        $tbl_a        = 'new_purch_oder';
        $tbl_b        = 'suppliers';
        $tbl_c        = 'purchase_order_items';
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];
        $getRst     = ListPendingPurchaseOrders::AllPendingPurchases($tbl_a, $tbl_b, $tbl_c, $branch_owner, $userRole);

        return      $getRst;
    }

    static public function inboundFG(){
        require_once('../../../model/purchases/ListPendingPurchaseOrders.php');

        $tbl_a        = 'fg_to_stores';
        $tbl_b        = 'inventory_master';
        $tbl_c        = 'rm_request';
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];
        $getRst     = ListPendingPurchaseOrders::InboundFGToStore($tbl_a, $tbl_b, $tbl_c, $branch_owner, $userRole);

        return      $getRst;
    }


    static public function checkPOStatus(){
        require_once('../../../model/purchases/ListPendingPurchaseOrders.php');
        $me = $_SESSION['uid'];
        $branch_owner = $_SESSION['branch_name'];
        $userRole     = $_SESSION['user_type'];
        $getRst = ListPendingPurchaseOrders::checkPOStatus($me, $branch_owner, $userRole);

        return $getRst;

    }
}