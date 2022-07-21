<?php
require_once '../../../model/connection.php';

class AllSalesOrderModel
{
//get all sales order
    static public function getAllSalesOrder ($tbl_a, $tbl_b, $tbl_c, $my_branch, $data_owner, $my_role){
        try {

            if ($my_role == 1) {
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
                FROM $tbl_a, $tbl_b, $tbl_c
                WHERE $tbl_a.customer_ID = $tbl_b.customa_ID
                AND $tbl_a.addedBy = $tbl_c.user_ID
                AND $tbl_a.approval_status = 1
                AND $tbl_a.data_owner = :dow
                ORDER BY $tbl_a.addedOn ASC ");
                $stmt->bindParam('dow', $data_owner, PDO::PARAM_STR);
                $stmt->execute();
            }
            else{
                $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
                FROM $tbl_a, $tbl_b, $tbl_c
                WHERE $tbl_a.customer_ID = $tbl_b.customa_ID
                AND $tbl_a.addedBy = $tbl_c.user_ID
                AND $tbl_a.approval_status = 1
                AND $tbl_a.data_owner = :dow
                AND $tbl_a.branch_owner = :mb
                ORDER BY $tbl_a.addedOn ASC ");
                $stmt->bindParam('dow', $data_owner, PDO::PARAM_STR);
                $stmt->bindParam('mb', $my_branch, PDO::PARAM_STR);
                $stmt->execute();
            }

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllPendingSalesOrder ($tbl_a, $tbl_b, $tbl_c){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
            FROM $tbl_a, $tbl_b, $tbl_c
            WHERE $tbl_a.approval_status = 0
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllApprovedSalesOrder ($tbl_a, $tbl_b, $tbl_c){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.* 
            FROM $tbl_a, $tbl_b, $tbl_c
            WHERE $tbl_a.approval_status = 1
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllPendingSalesToProduction ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*
            FROM $tbl_a
            INNER  JOIN $tbl_b ON $tbl_a.customer_ID = $tbl_b.customa_ID
            INNER JOIN $tbl_c ON $tbl_a.addedBy = $tbl_c.user_ID
            WHERE $tbl_a.approval_status = 1
            AND $tbl_a.sales_to_production = 1
            AND $tbl_a.rm_materials_requested = 0
            ORDER BY $tbl_a.addedOn ASC 
            ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    ##################33333 pending ###########################################3
    static public function getAllPendingSalesQuote ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.* 
            FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d
            WHERE $tbl_a.approval_status = 0
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo "Failed";
        }
    }

    static public function getAllPendingSalesQuoteAmt ($tbl_a, $tbl_d){
        try {
            $this_month     = Date('m');
            $this_yr        = Date('Y');

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.pipeline_status, $tbl_a.sales_month, $tbl_a.sales_yr, 
            $tbl_d.sales_order_ID, $tbl_d.grandTotal, SUM($tbl_d.grandTotal) AS totalAmount 
            FROM $tbl_a
            INNER JOIN $tbl_d ON $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            WHERE $tbl_a.pipeline_status = 0
            AND $tbl_a.sales_yr = :yr
            ");
            $stmt->bindParam('yr', $this_yr, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed";
        }
    }



    #################### follow up #####################################
    static public function getAllFollowUpSalesQuote ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.* 
            FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d
            WHERE $tbl_a.pipeline_status = 1
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllFollowUpSalesQuoteAmt ($tbl_a, $tbl_d){
        try {
            $this_month     = Date('m');
            $this_yr        = Date('Y');

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.pipeline_status, $tbl_a.sales_month, $tbl_a.sales_yr, 
            $tbl_d.sales_order_ID, $tbl_d.grandTotal, SUM($tbl_d.grandTotal) AS totalAmount 
            FROM $tbl_a
            INNER JOIN $tbl_d ON $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            WHERE $tbl_a.pipeline_status = 1
            AND $tbl_a.sales_yr = :yr
            ");
            $stmt->bindParam('yr', $this_yr, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed";
        }
    }


    ###################### negotiations #############################
    static public function getAllNegotiationsSalesQuote ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.* 
            FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d
            WHERE $tbl_a.pipeline_status = 2
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllNegotiationsSalesQuoteAmt ($tbl_a, $tbl_d){
        try {
            $this_month     = Date('m');
            $this_yr        = Date('Y');

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.pipeline_status, $tbl_a.sales_month, $tbl_a.sales_yr, 
            $tbl_d.sales_order_ID, $tbl_d.grandTotal, SUM($tbl_d.grandTotal) AS totalAmount 
            FROM $tbl_a
            INNER JOIN $tbl_d ON $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            WHERE $tbl_a.pipeline_status = 2
            AND $tbl_a.sales_yr = :yr
            ");
            $stmt->bindParam('yr', $this_yr, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed";
        }
    }


    ##################### won ###########################
    static public function getAllWonSalesQuote ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.* 
            FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d
            WHERE $tbl_a.pipeline_status = 3
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllWonSalesQuoteAmt ($tbl_a, $tbl_d){
        try {
            $this_month     = Date('m');
            $this_yr        = Date('Y');

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.pipeline_status, $tbl_a.sales_month, $tbl_a.sales_yr, 
            $tbl_d.sales_order_ID, $tbl_d.grandTotal, SUM($tbl_d.grandTotal) AS totalAmount 
            FROM $tbl_a
            INNER JOIN $tbl_d ON $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            WHERE $tbl_a.pipeline_status = 3
            AND $tbl_a.sales_yr = :yr
            ");
            $stmt->bindParam('yr', $this_yr, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed";
        }
    }


    ###################3 lost ########################3
    static public function getAllLostSalesQuote ($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.* 
            FROM $tbl_a, $tbl_b, $tbl_c, $tbl_d
            WHERE $tbl_a.pipeline_status = 4
            AND $tbl_a.customer_ID = $tbl_b.customa_ID
            AND $tbl_a.addedBy = $tbl_c.user_ID
            AND $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            ORDER BY $tbl_a.addedOn ASC ");
            $stmt -> execute();

            return $stmt->fetchAll();
        } catch(PDOException $e) {
            echo $e -> getMessage();
        }
    }

    static public function getAllLostSalesQuoteAmt ($tbl_a, $tbl_d){
        try {
            $this_month     = Date('m');
            $this_yr        = Date('Y');

            $stmt = Connection::connect() -> prepare("SELECT $tbl_a.pipeline_ID, $tbl_a.pipeline_status, $tbl_a.sales_month, $tbl_a.sales_yr, 
            $tbl_d.sales_order_ID, $tbl_d.grandTotal, SUM($tbl_d.grandTotal) AS totalAmount 
            FROM $tbl_a
            INNER JOIN $tbl_d ON $tbl_a.pipeline_ID = $tbl_d.sales_order_ID
            WHERE $tbl_a.pipeline_status = 4
            AND $tbl_a.sales_yr = :yr
            ");
            $stmt->bindParam('yr', $this_yr, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Failed";
        }
    }
}