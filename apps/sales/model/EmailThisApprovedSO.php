<?php


class EmailThisApprovedSO
{
    static public function thisApprovedSO($po_ID)
    {
        require_once '../../../model/connection.php';
        $stmt = Connection::connect()->prepare("SELECT new_purch_oder.*, purchase_order_items.*, po_financials.*, suppliers.* 
        FROM new_purch_oder
        INNER JOIN purchase_order_items ON new_purch_oder.po_ID = purchase_order_items.po_ID
        INNER JOIN  po_financials ON new_purch_oder.po_ID = po_financials.po_ID
        INNER JOIN suppliers ON new_purch_oder.supp_ID = suppliers.supp_ID
        WHERE new_purch_oder.po_ID = :id
        ");

        $stmt->bindParam('id', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}