<?php

require_once '../../../model/connection.php';
class ThisCustomerSalesModel
{
    static public function thisCustomerSales($customer_key){
        $stmt = Connection::connect()->prepare("SELECT customers.customa_ID, customers.CCCode, customers.customa_name, customers.customer_key, 
        sales_tbl.sales_order_ID, sales_tbl.customer_ID, sales_tbl.sales_order_ID, sales_tbl.order_No, sales_tbl.order_dt, sales_tbl.delivery_dt, sales_tbl.instruction_note, 
        sales_tbl.approval_status, sales_tbl.fulfilled_status, sales_tbl.addedBy, sales_tbl.addedOn, users_tbl.user_ID, users_tbl.userEmail 
        FROM customers, sales_tbl, users_tbl
        WHERE customers.customer_key = :ck
        AND sales_tbl.addedBy = users_tbl.user_ID
        AND customers.customa_ID = sales_tbl.customer_ID
        ");
        $stmt->bindParam('ck', $customer_key, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}