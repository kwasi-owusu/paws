<?php


class SalesForTodayMDL
{
    static public function todayOrdersForDashboard(){
        require_once '../../model/connection.php';

        $tbl_a      = 'sales_tbl';
        $tbl_b      = 'customers';
        //for jqgrid pagination
        $page   = $_REQUEST['page'];
        $limit  = $_REQUEST['rows'];
        $sidx   = $_REQUEST['sidx'];
        $sord   = $_REQUEST['sord'];

        if(!$sidx) $sidx =1;

        $rst = Connection::connect()->prepare( "SELECT COUNT(*) AS count FROM $tbl_a");
        $rst->execute();
        $rr = $rst->fetch(PDO::FETCH_ASSOC);

        $count = $rr['count'];

        if( $count > 0 && $limit > 0) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) $page=$total_pages;
        $start = $limit*$page - $limit;
        if($start <0) $start = 0;



        $ddy = Date('d');
        $mmn = Date('m');
        $yyr = Date('Y');
        $stmt = Connection::connect()->prepare("SELECT $tbl_a.sales_order_ID, $tbl_a.customer_ID, $tbl_a.order_No, $tbl_a.delivery_dt, $tbl_a.approval_status, 
        $tbl_a.fulfilled_status, $tbl_b.customa_ID, $tbl_b.CCCode, $tbl_b.customa_name
        FROM  $tbl_a, $tbl_b 
        WHERE $tbl_a.customer_ID = $tbl_b.customa_ID
        AND sales_day = :td 
        AND sales_month = :m 
        AND sales_yr = :y
        ORDER BY $sidx $sord LIMIT $start , $limit
        ");
        $stmt->bindParam('td', $ddy, PDO::PARAM_STR);
        $stmt->bindParam('m', $mmn, PDO::PARAM_STR);
        $stmt->bindParam('y', $yyr, PDO::PARAM_STR);

        $stmt->execute();

        $response = new \stdClass();
        $i=0;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response->rows[$i]['id']=$row['userId'];
            $response->rows[$i]['cell']=array($row['userId'],$row['userName'],$row['firstName'],$row['lastName']);
            $i++;
        }
        echo json_encode($response);

        //return $stmt->fetchAll();
    }
}

$callClass  = new SalesForTodayMDL();
$callMethod = $callClass->todayOrdersForDashboard();