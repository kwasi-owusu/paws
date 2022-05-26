<?php

require_once '../../model/connection.php';
class AddNewSalesOrderMdl
{
    static public function saveNewSalesOrder($customer_ID, $so_terms, $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode, $itemName, $price,
                                             $quantity, $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $taxableAmount, $nhsAmount,
                                             $getFundAmount, $covidTaxAmount, $totalBeforeVAT, $vatAmount, $grandTotal, $addedBy, $data_owner, $my_branch,
                                             $sales_to_production){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy    = Date('d');
                $mnt    = Date('M');
                $yr     = Date('Y');
                $order_dt   = Date('Y-m-d');
                $order_type     = 2; //1 => Sales Quote; 2 => Sales Order


                $stmt   = $thisPDO->prepare("INSERT INTO sales_tbl(customer_ID, order_No, order_dt, delivery_dt, currency, instruction_note, 
                disc_pcnt, order_type, sales_day, sales_month, sales_yr, sales_to_production, addedBy, data_owner, branch_owner) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($customer_ID, $quote_number, $order_dt, $delivery_dt, $curr, $so_terms, $discount_amount, $order_type, $tdy, $mnt, $yr,
                    $sales_to_production, $addedBy, $data_owner, $my_branch));

                $sales_order_ID     = $thisPDO->lastInsertId();


                // save Sales Order Items
                for($count  = 0; $count < count($itemName); $count++) {

                    $itmCode = $itemCode[$count];
                    $itName = $itemName[$count];
                    $cost   = $price[$count];
                    $qqty   = $quantity[$count];
                    $subTotal  = $total[$count];


                    if (!empty($itmCode || !empty($itName) || !empty($cost) || !empty($qqty) || !empty($subTotal))) {
                        $query = $thisPDO->prepare("INSERT INTO sales_items(sales_order_ID, itm_code, product_name, unit_price, qty, 
                        subtotal)
		    	    VALUES(?, ?, ?, ?, ?, ?)");
                        $query->execute(array($sales_order_ID, $itmCode, $itName, $cost, $qqty, $subTotal));
                    }
                }

                //insert Sales Order Financial salesOrderFinancial $totalAfterTax,
                $sof_query  = $thisPDO->prepare("INSERT INTO salesorderfinancial(sales_order_ID, sub_total, amountDueTop, amountPaid, amountDue, 
                taxableAmount, nhsAmount, getFundAmount, covidAmount, totalBeforeVAT, vatAmount, grandTotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sof_query->execute(array($sales_order_ID, $totalAftertax, $amountDueTop, $amountPaid, $amountDue, $taxableAmount, $nhsAmount,
                    $getFundAmount, $covidTaxAmount, $totalBeforeVAT, $vatAmount, $grandTotal));

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //echo $e -> getMessage();
            }
        }

    }

    static public function saveNewSalesOrderNoTax($customer_ID, $so_terms,  $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode, $itemName,
                                                  $price, $quantity, $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $addedBy,
                                                  $data_owner, $my_branch, $sales_to_production){

        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy    = Date('d');
                $mnt    = Date('M');
                $yr     = Date('Y');
                $order_dt   = Date('Y-m-d');
                $order_type     = 2; //1 => Sales Quote; 2 => Sales Order


                $stmt   = $thisPDO->prepare("INSERT INTO sales_tbl(customer_ID, order_No, order_dt, delivery_dt, currency, instruction_note, 
                disc_pcnt, order_type, sales_day, sales_month, sales_yr, sales_to_production, addedBy, data_owner, branch_owner) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($customer_ID, $quote_number, $order_dt, $delivery_dt, $curr, $so_terms, $discount_amount, $order_type, $tdy, $mnt, $yr,
                    $sales_to_production, $addedBy, $data_owner, $my_branch));

                $sales_order_ID     = $thisPDO->lastInsertId();


                // save Sales Order Items
                for($count  = 0; $count < count($itemName); $count++) {

                    $itmCode = $itemCode[$count];
                    $itName = $itemName[$count];
                    $cost   = $price[$count];
                    $qqty   = $quantity[$count];
                    $subTotal  = $total[$count];


                    if (!empty($itmCode || $itName) || !empty($cost) || !empty($qqty) || !empty($subTotal)) {
                        $query = $thisPDO->prepare("INSERT INTO sales_items(sales_order_ID, itm_code, product_name, unit_price, qty, subtotal)
		    	    VALUES(?, ?, ?, ?, ?, ?)");
                        $query->execute(array($sales_order_ID, $itmCode, $itName, $cost, $qqty, $total));
                    }
                }

                //insert Sales Order Financial salesOrderFinancial $totalAftertax,
                $sof_query  = $thisPDO->prepare("INSERT INTO salesorderfinancial(sales_order_ID, sub_total, amountDueTop, amountPaid, amountDue) 
                VALUES (?, ?, ?, ?, ?)");
                $sof_query->execute(array($sales_order_ID, $totalAftertax, $amountDueTop, $amountPaid, $amountDue));

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //echo $e -> getMessage();
            }
        }

    }
}