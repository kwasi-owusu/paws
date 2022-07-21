<?php

require_once '../../model/connection.php';
class AddNewSalesQuoteMdl
{
    static public function saveNewSalesQuote($customer_ID, $so_terms, $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode, $itemName, $price, $quantity,
                                             $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $taxableAmount, $nhsAmount, $getFundAmount,
                                             $covidTaxAmount, $totalBeforeVAT, $vatAmount, $grandTotal, $addedBy, $data_owner, $my_branch){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy    = Date('d');
                $mnt    = Date('mm');
                $yr     = Date('Y');
                $order_dt   = Date('Y-m-d');
                $order_type     = 1; //1 => Sales Quote; 2 => Sales Order

                /*
                 pipeline_ID, customer_ID, order_No, order_dt, delivery_dt, fob, currency, instruction_note,
                fulfilled_status, approval_comment, approval_action_by, disc_pcnt, quote_status, sales_day, sales_month, sales_yr,
                addedBy, addedOn, lastUpdateBy, lastUpdateOn
                 */

                $stmt   = $thisPDO->prepare("INSERT INTO sales_pipeline(customer_ID, order_No, order_dt, delivery_dt, currency, instruction_note, 
                disc_pcnt, sales_day, sales_month, sales_yr, addedBy, data_owner, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($customer_ID, $quote_number, $order_dt, $delivery_dt, $curr, $so_terms, $discount_amount, $tdy, $mnt, $yr,
                    $addedBy, $data_owner, $my_branch));

                $sales_order_ID     = $thisPDO->lastInsertId();


                // save Sales Order Items
                for($count  = 0; $count < count($itemName); $count++) {

                    $itmCode = $itemCode[$count];
                    $itName = $itemName[$count];
                    $cost   = $price[$count];
                    $qqty   = $quantity[$count];
                    $subTotal  = $total[$count];


                    if (!empty($itmCode || !empty($itName) || !empty($cost) || !empty($qqty) || !empty($subTotal))) {
                        $query = $thisPDO->prepare("INSERT INTO sales_pipeline_items(sales_order_ID, itm_code, product_name, unit_price, qty, 
                        subtotal)
		    	    VALUES(?, ?, ?, ?, ?, ?)");
                        $query->execute(array($sales_order_ID, $itmCode, $itName, $qqty, $cost, $subTotal));
                    }
                }

                //insert Sales Order Financial salesOrderFinancial $totalAfterTax,
                $sof_query  = $thisPDO->prepare("INSERT INTO sales_pipeline_financials(sales_order_ID, sub_total, amountDueTop, amountPaid, amountDue, 
                taxableAmount, nhsAmount, getFundAmount, covidAmount, totalBeforeVAT, vatAmount, grandTotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sof_query->execute(array($sales_order_ID, $totalAftertax, $amountDueTop, $amountPaid, $amountDue, $taxableAmount, $nhsAmount, $getFundAmount,
                    $covidTaxAmount, $totalBeforeVAT, $vatAmount, $grandTotal));

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e -> getMessage();
            }
        }

    }

    static public function saveNewSalesQuoteNoTax($customer_ID, $so_terms,  $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode, $itemName, $price, $quantity,
                                                  $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $addedBy, $data_owner, $my_branch){

        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy    = Date('d');
                $mnt    = Date('mm');
                $yr     = Date('Y');
                $order_dt   = Date('Y-m-d');
                $order_type     = 2; //1 => Sales Quote; 2 => Sales Order


                $stmt   = $thisPDO->prepare("INSERT INTO sales_pipeline(customer_ID, order_No, order_dt, delivery_dt, currency, instruction_note, 
                disc_pcnt, sales_day, sales_month, sales_yr, addedBy, data_owner, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($customer_ID, $quote_number, $order_dt, $delivery_dt, $curr, $so_terms, $discount_amount, $tdy, $mnt, $yr,
                    $addedBy, $data_owner, $my_branch));

                $sales_order_ID     = $thisPDO->lastInsertId();


                // save Sales Order Items
                for($count  = 0; $count < count($itemName); $count++) {

                    $itmCode = $itemCode[$count];
                    $itName = $itemName[$count];
                    $cost   = $price[$count];
                    $qqty   = $quantity[$count];
                    $subTotal  = $total[$count];


                    if (!empty($itmCode || !empty($itName) || !empty($cost) || !empty($qqty) || !empty($subTotal))) {
                        $query = $thisPDO->prepare("INSERT INTO sales_pipeline_items(sales_order_ID, itm_code, product_name, unit_price, qty, 
                        subtotal)
		    	    VALUES(?, ?, ?, ?, ?, ?)");
                        $query->execute(array($sales_order_ID, $itmCode, $itName, $qqty, $cost, $subTotal));
                    }
                }

                //insert Sales Quote Financials salesOrderFinancial,
                $sof_query  = $thisPDO->prepare("INSERT INTO sales_pipeline_financials(sales_order_ID, sub_total, disc_pcnt, amountDueTop, amountPaid, 
                amountDue, grandTotal) 
                VALUES (?, ?, ?, ?, ?, ?, ?)");
                $sof_query->execute(array($sales_order_ID, $totalAftertax, $discount_amount, $amountDueTop, $amountPaid, $amountDue, $amountDue));

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }

    }
}