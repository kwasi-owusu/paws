<?php

require_once '../../../model/connection.php';
class EmailThisApprovedPO
{
    static public function thisApprovedPO($so_ID)
    {
        $stmt = Connection::connect()->prepare("SELECT sales_tbl.*, sales_items.*, salesorderfinancial.*, customers.* 
        FROM sales_tbl
        INNER JOIN sales_items ON sales_tbl.sales_order_ID = sales_items.sales_order_ID
        INNER JOIN  salesorderfinancial ON sales_tbl.sales_order_ID = salesorderfinancial.sales_order_ID
        INNER JOIN customers ON sales_tbl.customer_ID = customers.customa_ID
        WHERE sales_tbl.sales_order_ID = :id
        ");

        $stmt->bindParam('id', $so_ID, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }

}