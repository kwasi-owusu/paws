<?php


class SalesForToday
{
    static public function getSalesForTodayForDashboard(){
        require_once('../../model/sales/GetTotalOrderForToday.php');

        $tbl_a      = 'sales_tbl';
        $tbl_b      = 'customers';
        $getRst     = GetTotalOrderForToday::todayOrdersForDashboard($tbl_a, $tbl_b);

        $responce = new \stdClass();

        $i=0;

        foreach ($getRst as $row){
            $responce->rows[$i]['id']=$row['sales_order_ID'];
            $responce->rows[$i]['cell']=array($row['sales_order_ID'],$row['customa_name'],$row['status'],$row['delivery_dt'], $row['del_status']);
            $i++;
        }

        echo json_encode($responce);

        //return      $getRst;
    }
}

$callClass  = new SalesForToday();
$callMethod = $callClass->getSalesForTodayForDashboard();