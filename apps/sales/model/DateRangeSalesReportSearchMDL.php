<?php


class DateRangeSalesReportSearchMDL
{
    static public function loadApprovedSalesOrderWithDateRange ($branch, $start_date, $end_date, $tbl_a, $tbl_b, $tbl_c){
        require_once '../../../model/connection.php';
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
            FROM $tbl_a, $tbl_b, $tbl_c
            WHERE $tbl_a.approval_status = 1
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.branch_owner = :br
            AND $tbl_a.addedOn BETWEEN :sd AND :ed
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt->bindParam('br', $branch, PDO::PARAM_STR);
            $stmt->bindParam('sd', $start_date, PDO::PARAM_STR);
            $stmt->bindParam('ed', $end_date, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            //echo $e -> getMessage();
        }
    }
}