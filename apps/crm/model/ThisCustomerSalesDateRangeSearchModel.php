<?php


class ThisCustomerSalesDateRangeSearchModel
{
    static public function thisCustomerSalesDateRange($customer_key, $start_date, $end_date){
        require_once '../../../model/connection.php';
        $stmt = Connection::connect()->prepare("SELECT customers.*, sales_tbl.*, users_tbl.*
        FROM customers
        INNER JOIN sales_tbl ON customers.customa_ID = sales_tbl.customer_ID
        INNER JOIN users_tbl ON sales_tbl.addedBy = users_tbl.user_ID
        WHERE customers.customer_key = :ck
        AND sales_tbl.order_dt BETWEEN :sd AND :ed
        ");
        $stmt->bindParam('ck', $customer_key, PDO::PARAM_STR);
        $stmt->bindParam('sd', $start_date, PDO::PARAM_STR);
        $stmt->bindParam('ed', $end_date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}