<?php


class SalesReportForChartMDL
{
    static public function chartReport(){
        require_once '../../model/connection.php';

        $salesYear  = Date('Y');
        $stmt   = Connection::connect()->prepare("SELECT sales_tbl.*, salesorderfinancial.sof_ID, salesorderfinancial.sales_order_ID, 
                salesorderfinancial.grandTotal, SUM(salesorderfinancial.grandTotal) AS totalSales FROM sales_tbl
                INNER JOIN salesorderfinancial ON sales_tbl.sales_order_ID = salesorderfinancial.sales_order_ID 
                WHERE sales_tbl.sales_yr = :sy
                GROUP BY sales_tbl.sales_month
                ");
        $stmt->bindParam('sy', $salesYear, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt;
    }
}