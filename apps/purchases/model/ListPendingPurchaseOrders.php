<?php

require_once '../../../model/connection.php';

class ListPendingPurchaseOrders
{
    static public function AllPendingPO($tbl_a, $tbl_b, $branch_owner, $userRole)
    {
        if ($userRole != 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID, $tbl_a.approval_limit,ets, 
        $tbl_a.eta, $tbl_a.po_key, $tbl_a.approval_status, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_b.supp_ID, $tbl_b.supp_name
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.approval_status <> 1
        AND $tbl_a.supp_ID = $tbl_b.supp_ID
        AND $tbl_a.branch_owner = :ub
        AND $tbl_a.del_state = 0
        ");
            $stmt->bindParam('ub', $branch_owner, PDO::PARAM_STR);
            $stmt->execute();
        } elseif ($userRole == 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID, $tbl_a.approval_limit,ets, 
        $tbl_a.eta, $tbl_a.po_key, $tbl_a.approval_status, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_b.supp_ID, $tbl_b.supp_name
        FROM $tbl_a, $tbl_b 
        WHERE $tbl_a.approval_status <> 1
        AND $tbl_a.supp_ID = $tbl_b.supp_ID
        AND $tbl_a.del_state = 0
        ");
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }


    static public function AllPendingPurchases($tbl_a, $tbl_b, $tbl_c, $branch_owner, $userRole)
    {
        if ($userRole != 1) {
        $stmt = Connection::connect()->prepare("SELECT DISTINCT($tbl_a.po_ID), $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID, 
        $tbl_a.approval_limit, $tbl_a.ets, $tbl_a.eta, $tbl_a.approval_status, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_b.supp_ID, $tbl_b.supp_name
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.supp_ID = $tbl_b.supp_ID
        INNER JOIN $tbl_c ON $tbl_a.po_ID = $tbl_c.po_ID
        WHERE $tbl_a.approval_status = 1
        AND $tbl_a.del_state = 0
        AND $tbl_c.qty > 0
        AND $tbl_a.branch_owner = :ub
        ");
            $stmt->bindParam('ub', $branch_owner, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
        } elseif ($userRole == 1) {
            $stmt = Connection::connect()->prepare("SELECT DISTINCT($tbl_a.po_ID), $tbl_a.po_ID, $tbl_a.po_num, $tbl_a.purchase_order_type, $tbl_a.supp_ID, 
        $tbl_a.approval_limit, $tbl_a.ets, $tbl_a.eta, $tbl_a.approval_status, $tbl_a.addedBy, $tbl_a.AddedOn, $tbl_b.supp_ID, $tbl_b.supp_name
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.supp_ID = $tbl_b.supp_ID
        INNER JOIN $tbl_c ON $tbl_a.po_ID = $tbl_c.po_ID
        WHERE $tbl_a.approval_status = 1
        AND $tbl_a.del_state = 0
        AND $tbl_c.qty > 0
        ");
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }

    static public function ThisPendingPO($tbl_a, $tbl_b, $tbl_c, $tbl_d, $poKey, $branch_owner, $userRole)
    {
        if ($userRole != 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.po_ID = $tbl_b.po_ID
        INNER JOIN $tbl_c ON $tbl_a.po_ID = $tbl_c.po_ID
        INNER JOIN $tbl_d ON $tbl_a.supp_ID = $tbl_d.supp_ID
        WHERE $tbl_a.po_key = :k
        AND $tbl_a.del_state = 0
        AND $tbl_a.approval_status = 0
        AND $tbl_a.branch_owner = :ub
        ");
            $stmt->bindParam('k', $poKey, PDO::PARAM_STR);
            $stmt->bindParam('ub', $branch_owner, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
        elseif ($userRole == 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.po_ID = $tbl_b.po_ID
        INNER JOIN $tbl_c ON $tbl_a.po_ID = $tbl_c.po_ID
        INNER JOIN $tbl_d ON $tbl_a.supp_ID = $tbl_d.supp_ID
        WHERE $tbl_a.po_key = :k
        AND $tbl_a.del_state = 0
        AND $tbl_a.approval_status = 0
        ");
            $stmt->bindParam('k', $poKey, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }

    }


    static public function InboundFGToStore($tbl_a, $tbl_b, $tbl_c, $branch_owner, $userRole)
    {

        if ($userRole != 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.inventoy_code = $tbl_b.inventory_ID
        INNER JOIN $tbl_c ON $tbl_a.request_ID = $tbl_c.request_ID
        WHERE $tbl_a.qty <> 0
        AND $tbl_a.branch_owner = :ub
        ");
            $stmt->bindParam('ub', $branch_owner, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetchAll();
        }
        elseif ($userRole == 1) {
            $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*
        FROM $tbl_a
        INNER JOIN $tbl_b ON $tbl_a.inventoy_code = $tbl_b.inventory_ID
        INNER JOIN $tbl_c ON $tbl_a.request_ID = $tbl_c.request_ID
        WHERE $tbl_a.qty <> 0
        ");
            $stmt->execute();

            return $stmt->fetchAll();
        }
    }

    static public function checkPOStatus($me, $branch_owner, $userRole)
    {
        if ($userRole != 1) {
            $stmt = Connection::connect()->prepare("SELECT new_purch_oder.*, suppliers.* FROM new_purch_oder, suppliers 
        WHERE new_purch_oder.addedBy = :m 
        AND new_purch_oder.supp_ID = suppliers.supp_ID
        AND new_purch_oder.approval_status = 0
        AND new_purch_oder.branch_owner = :ub
        ");
            $stmt->bindParam('m', $me, PDO::PARAM_STR);
            $stmt->bindParam('ub', $branch_owner, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        } elseif ($userRole == 1) {
            $stmt = Connection::connect()->prepare("SELECT new_purch_oder.*, suppliers.* FROM new_purch_oder, suppliers 
        WHERE new_purch_oder.supp_ID = suppliers.supp_ID
        AND new_purch_oder.approval_status = 0
        ");
            $stmt->execute();

            return $stmt;
        }
    }

}