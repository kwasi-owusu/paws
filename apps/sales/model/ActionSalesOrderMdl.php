<?php

require_once '../../model/connection.php';
class ActionSalesOrderMdl
{
    static public function doActionSO($tbl, $tbl_b, $tbl_c, $tbl_d, $data)
    {
        $approvalAction = $data['sa'];
        $amountPaid = $data['amtPaid'];

        if ($approvalAction != '1') {
            $stmt = Connection::connect()->prepare("UPDATE $tbl SET approval_status = :aps, approval_comment = :apc, approval_action_by = :acb
        WHERE sales_order_ID = :od
        ");
            $stmt->bindParam('aps', $data['sa'], PDO::PARAM_STR);
            $stmt->bindParam('apc', $data['ac'], PDO::PARAM_STR);
            $stmt->bindParam('acb', $data['adb'], PDO::PARAM_STR);
            $stmt->bindParam('od', $data['sd'], PDO::PARAM_STR);

            $stmt->execute();

            return $stmt;
        } elseif ($approvalAction == '1') {
            $newPDO = new Connection();
            $thisPDO = $newPDO->Connect();

            if ($thisPDO->beginTransaction()) {

                try {
                    $stmt = $thisPDO->prepare("UPDATE $tbl SET approval_status = :aps, approval_comment = :apc, approval_action_by = :acb
                    WHERE sales_order_ID = :od
                    ");
                    $stmt->bindParam('aps', $data['sa'], PDO::PARAM_STR);
                    $stmt->bindParam('apc', $data['ac'], PDO::PARAM_STR);
                    $stmt->bindParam('acb', $data['adb'], PDO::PARAM_STR);
                    $stmt->bindParam('od', $data['sd'], PDO::PARAM_STR);

                    $stmt->execute();

                    //create an invoice
                    // invoice type 1 => from supplier\n2 => to customer

                    $invoiceSave = $thisPDO->prepare("INSERT INTO $tbl_c(invoice_number, invoice_type, invoice_date, total_amt, invoice_terms, 
                                                    Customer_ID, addedBy) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $invoiceSave->execute(array(
                        $data['orderNum'],
                        2,
                        $data['financeAdded'],
                        $data['totalAmount'],
                        $data['terms'],
                        $data['customer'],
                        $data['adb']
                    ));

                    //create a receivable ledger
                    $paymentSave = $thisPDO->prepare("INSERT INTO $tbl_d(invoice_number, invoice_date, total_amount, customer_ID, 
                                    outstanding_balance, payment_amount, payment_date, addedBy)VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $paymentSave->execute(array(
                        $data['orderNum'],
                        $data['financeAdded'],
                        $data['totalAmount'],
                        $data['customer'],
                        $data['bal'],
                        $data['amtPaid'],
                        $data['financeAdded'],
                        $data['adb']
                    ));


                    $thisPDO->commit();

                    return $stmt;
                } catch (PDOException $e) {
                    $thisPDO->rollBack();
                    //echo $e -> getMessage();
                    echo "Posting Not Successful";
                }
            }
        }
    }

    static public function getThisSalesOrderFinancialDetails($tbl, $tbl_b, $sales_order_ID){
        try {

            $stmt = Connection::connect() -> prepare("SELECT $tbl.*, $tbl_b.* FROM $tbl, $tbl_b
            WHERE $tbl.sales_order_ID = :ssd
            AND $tbl_b.sales_order_ID = :sd
            ");
            $stmt->bindParam('ssd', $sales_order_ID, PDO::PARAM_STR);
            $stmt->bindParam('sd', $sales_order_ID, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt;
        } catch(PDOException $e) {
            //echo $e -> getMessage();
        }
    }
}
