<?php
require_once '../../model/connection.php';

class SalesModel
{

    //create a new sales order
    static public function createSalesOrder($tbl, $tbl_b, $data, $data_b){
        $newPDO = Connection::connect();
        $newPDO->beginTransaction();
        try {
            $day = DATE('d');
            $month = DATE('m');
            $yr = DATE('Y');

            $stmt = Connection::connect() -> prepare("INSERT INTO $tbl(customer_ID, order_No, order_dt, delivery_dt, fob, currency, instruction_note, disc_pcnt, order_type) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt -> execute(array($data['cd'], $data['odn'], $data['odd'], $data['ddt'], $data['fb'], $data['curr'], $data['ins'], $data['dcn'], $data['odt']));

            $lastInsertedID = Connection::connect()-> lastInsertId();

            //sales order items
            for ($count = 0; $count < count($data['sales_items']); $count++) {

                $itName 	= $data['sales_items'][$count];
                $price 		= $data['sales_items'][$count];
                $qty 		= $data['sales_items'][$count];
                $subTotal 	= $data['sales_items'][$count];
                $itm_code 	= $data['sales_items'][$count];

                    $query = Connection::connect() -> prepare("INSERT INTO $tbl_b(sales_order_ID, itm_code, product_name, unit_price, qty, subtotal, amt_due)
		    	VALUES(?, ?, ?, ?, ?, ?, ?)");

                    $query -> execute(array($lastInsertedID, $itm_code, $itName, $price, $qty, $subTotal, $data['amt_due'], $day, $month, $yr, $data['adb']));

                }

            $activity_type  = "New Order Created";
            $activity = "New Order Created with id ".$lastInsertedID;
            // create an activity
            $u_act = Connection::connect()->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity ));

            $newPDO -> commit();

            return $stmt;
        } catch(PDOException $e) {
            $newPDO->rollBack();
            echo $e -> getMessage();
        }
    }
}