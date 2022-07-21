<?php

require_once '../../../model/connection.php';
class ThisSupplierPurchasesModel
{
    static public function thisSupplierPurchases($supplier_key){
        $stmt = Connection::connect()->prepare("SELECT new_purch_oder.po_ID, new_purch_oder.po_num, new_purch_oder.supp_ID, 
        new_purch_oder.sched_dt, new_purch_oder.approval_status, new_purch_oder.dy, new_purch_oder.mn, new_purch_oder.yr, new_purch_oder.ets, new_purch_oder.eta, 
        new_purch_oder.del_state, new_purch_oder.addedBy, new_purch_oder.AddedOn, new_purch_oder.lastUpdateBy, new_purch_oder.lastUpdateOn, suppliers.supp_ID, 
        suppliers.SupplCode, suppliers.supp_name, suppliers.supplier_key, users_tbl.user_ID, users_tbl.userEmail
        FROM new_purch_oder, suppliers, users_tbl
        WHERE suppliers.supplier_key = :sk
        AND new_purch_oder.supp_ID = suppliers.supp_ID
        AND new_purch_oder.addedBy = users_tbl.user_ID");
        $stmt->bindParam('sk', $supplier_key, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}