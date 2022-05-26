<?php

require_once '../../../model/connection.php';
class PrintThisApprovedPO
{
    static public function thisApprovedPO($po_ID)
    {
        $stmt = Connection::connect()->prepare("SELECT new_purch_oder.*, purchase_order_items.*, po_financials.*, suppliers.*, 
        inventory_master.* 
        FROM new_purch_oder
        INNER JOIN purchase_order_items ON new_purch_oder.po_ID = purchase_order_items.po_ID
        INNER JOIN po_financials ON new_purch_oder.po_ID = po_financials.po_ID
        INNER JOIN suppliers ON new_purch_oder.supp_ID = suppliers.supp_ID
        INNER JOIN inventory_master ON purchase_order_items.inventory_code = inventory_master.inventory_code
        WHERE new_purch_oder.po_ID = :id
        ");

        $stmt->bindParam('id', $po_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}