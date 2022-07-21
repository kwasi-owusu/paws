<?php


class SalesOrderDetailsForMailMDL
{
    static public function getThisSalesOrderDetails ($tbl_a, $tbl_b, $tbl_c, $tbl_d, $tbl_e, $sales_order_ID){
        require_once '../../model/connection.php';
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*, $tbl_e.*
            FROM $tbl_a
            INNER JOIN $tbl_b ON $tbl_a.sales_order_ID = $tbl_b.sales_order_ID
            INNER JOIN $tbl_c ON $tbl_a.sales_order_ID = $tbl_c.sales_order_ID
            INNER JOIN $tbl_d ON $tbl_a.customer_ID = $tbl_d.customa_ID
            INNER JOIN $tbl_e ON $tbl_b.itm_code = $tbl_e.inventory_code
            WHERE $tbl_a.sales_order_ID = :sd
            ");
            $stmt->bindParam('sd', $sales_order_ID, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt;
        } catch(PDOException $e) {
            //echo $e -> getMessage();
            echo "Failed";
        }
    }
}