<?php

require_once '../../template/statics/conn/connection.php';
class GetTotalOrderForToday
{
    public static function todayOrders($tbl)
    {

        $dy = Date('d');
        $mn = Date('m');
        $yr = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT * FROM  $tbl WHERE sales_day = :td AND sales_month = :m AND sales_yr = :y");
        $stmt->bindParam('td', $dy, PDO::PARAM_STR);
        $stmt->bindParam('m', $mn, PDO::PARAM_STR);
        $stmt->bindParam('y', $yr, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function thisMonthOrders($tbl)
    {

        $dy = Date('d');
        $mn = Date('m');
        $yr = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT * FROM  $tbl WHERE MONTH(order_dt) = :mn");
        $stmt->bindParam('mn', $mn, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function totalSalesToday($tbl, $tbl_b)
    {
        $tdy = Date('Y-m-d');
        $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.sales_order_ID, $tbl_b.sub_total,$tbl_b. amountDueTop, $tbl_b.amountPaid, 
        $tbl_b.amountDue, $tbl_b.taxableAmount, $tbl_b.nhsAmount, $tbl_b.getFundAmount, $tbl_b.covidAmount, $tbl_b.totalBeforeVAT, $tbl_b.vatAmount, $tbl_b.grandTotal, 
        SUM( $tbl_b.grandTotal) AS totalSales
        FROM  $tbl 
        INNER JOIN $tbl_b ON $tbl.sales_order_ID = $tbl_b.sales_order_ID
        WHERE $tbl.order_dt = :td AND $tbl.approval_status = 1");
        $stmt->bindParam('td', $tdy, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    public static function fulfilledOrdersToday($tbl, $tbl_b)
    {
        $tdy = Date('Y-m-d');
        $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.* FROM  $tbl 
        INNER JOIN $tbl_b ON $tbl.sales_order_ID = $tbl_b.sales_order_ID
        WHERE $tbl.order_dt = :td AND $tbl.fulfilled_status = 1");
        $stmt->bindParam('td', $tdy, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }

    public static function todayOrdersForDashboard($tbl_a, $tbl_b){
        $ddy = Date('Y-m-d');
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM  $tbl_a, $tbl_b 
        WHERE $tbl_a.customer_ID = $tbl_b.customa_ID
        AND $tbl_a.order_dt = :td 
        AND approval_status = 1
        ");
        $stmt->bindParam('td', $ddy, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }
    
    public static function thisMonthOrdersForDashboard($tbl_a, $tbl_b){
        $mn = Date('m');
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*
        FROM  $tbl_a, $tbl_b 
        WHERE $tbl_a.customer_ID = $tbl_b.customa_ID
        AND MONTH($tbl_a.order_dt) = :mn 
        AND approval_status = 1
        ");
        $stmt->bindParam('mn', $mn, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }
       

    public static function topSellingItemsThisMonth($tbl_a, $tbl_b, $tbl_c, $tbl_d){
        $mn = Date('m');
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.*, $tbl_b.*, $tbl_c.*, $tbl_d.*, 
        SUM($tbl_c.grand_total) AS grandTotal
        FROM  $tbl_a, $tbl_b, $tbl_c, $tbl_d
        WHERE $tbl_a.inventory_code = $tbl_b.inventory_code
        AND $tbl_a.itm_transaction_ID = $tbl_c.fin_transaction_ID
        AND MONTH($tbl_d.system_date) = :mn 
        ORDER BY grandTotal ASC
        LIMIT 5
        ");
        $stmt->bindParam('mn', $mn, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}