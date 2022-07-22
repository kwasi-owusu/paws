<?php

require_once '../../template/statics/conn/connection.php';
class POSTransactionsMdl
{
    static public function saveTaxableTransactions($tbl_a, $tbl_b, $tbl_c, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        $data_owner = 1;

        if ($thisPDO->beginTransaction()) {

            try {

                //save transaction record
                $stmt = $thisPDO->prepare("INSERT INTO $tbl_a(transaction_code, customer, pmt_type, sales_day, sales_month, sales_yr, 
                addedBy, merchant_ID, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['trnCode'],
                    $data['cst'],
                    $data['ptp'],
                    $data['tdy'],
                    $data['mnt'],
                    $data['yr'],
                    $data['adb'],
                    $data['md'],
                    $data['brn']
                ));

                $pos_ID = $thisPDO->lastInsertId();

                //save POS Financial
                $pfn = $thisPDO->prepare("INSERT INTO $tbl_c(fin_transaction_ID, curr, covidAmount, before_vat, vat, amtDue, 
                amt_paid, grand_total, final_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $pfn->execute(array(
                    $pos_ID,
                    $data['curr'],
                    $data['cvd'],
                    $data['bfv'],
                    $data['vt'],
                    $data['amd'],
                    $data['amP'],
                    $data['totalAT'],
                    $data['grd']
                ));

                //save POS items
                for ($count = 0; $count < count($data['itn']); $count++) {

                    $std        = $data['std'][$count];
                    $itCode     = $data['itc'][$count];
                    $itName     = $data['itn'][$count];
                    $cost       = $data['prc'][$count];
                    $qty        = $data['qt'][$count];
                    $subTotal   = $data['sub'][$count];


                    if (!empty($itName) || !empty($itCode) || !empty($cost) || !empty($qty) || !empty($subTotal) || !empty($std)) {
                        $query = $thisPDO->prepare("INSERT INTO $tbl_b(itm_transaction_ID, item_storage_ID, inventory_code, inventory_name, unit_price, qty, sub_total)
		    	        VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $query->execute(array(
                            $pos_ID,
                            $std,
                            $itCode,
                            $itName,
                            $cost,
                            $qty,
                            $subTotal
                        ));
                    }

                    //update update product_storage qty
                    $pst    = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = recieved_qty - $qty WHERE storage_ID = :d");
                    $pst->bindParam('d', $std, PDO::PARAM_STR);
                    $pst->execute();

                    //update inventory_master
                    $ivm    = $thisPDO->prepare("UPDATE inventory_master SET total_qty = total_qty - $qty WHERE inventory_code = :v");
                    $ivm->bindParam('v', $itCode, PDO::PARAM_STR);
                    $ivm->execute();
                }

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
                //echo "Failed";
            }
        }
    }


    static public function saveNonTaxableTransactions($tbl_a, $tbl_b, $tbl_c, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        $tdy = Date('d');
        $mnt = Date('m');
        $yr = Date('Y');
        $data_owner = 1;

        if ($thisPDO->beginTransaction()) {

            try {
                //save transaction record
                $stmt = $thisPDO->prepare("INSERT INTO $tbl_a(transaction_code, customer, pmt_type, sales_day, sales_month, sales_yr, 
                addedBy, merchant_ID, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['trnCode'],
                    $data['cst'],
                    $data['ptp'],
                    $data['tdy'],
                    $data['mnt'],
                    $data['yr'],
                    $data['adb'],
                    $data['md'],
                    $data['brn']
                ));

                $pos_ID = $thisPDO->lastInsertId();

                //save POS Financial
                $pfn = $thisPDO->prepare("INSERT INTO $tbl_c(fin_transaction_ID, curr, amtDue, amt_paid, grand_total, final_total) 
                VALUES (?, ?, ?, ?, ?, ?)");
                $pfn->execute(array(
                    $pos_ID,
                    $data['curr'],
                    $data['amd'],
                    $data['amP'],
                    $data['totalAT'],
                    $data['amd']
                ));

                //save POS items
                for ($count = 0; $count < count($data['itn']); $count++) {

                    $std        = $data['std'][$count];
                    $itCode     = $data['itc'][$count];
                    $itName     = $data['itn'][$count];
                    $cost       = $data['prc'][$count];
                    $qty        = $data['qt'][$count];
                    $subTotal   = $data['sub'][$count];


                    if (!empty($itName) || !empty($itCode) || !empty($cost) || !empty($qty) || !empty($subTotal) || !empty($std)) {
                        $query = $thisPDO->prepare("INSERT INTO $tbl_b(itm_transaction_ID, item_storage_ID, inventory_code, inventory_name, unit_price, qty, sub_total)
		    	        VALUES(?, ?, ?, ?, ?, ?, ?)");
                        $query->execute(array(
                            $pos_ID,
                            $std,
                            $itCode,
                            $itName,
                            $cost,
                            $qty,
                            $subTotal
                        ));
                    }
                }

                $thisPDO->commit();

                return $stmt;


            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
                //echo "Failed";
            }
        }
    }

    static public function getLatestTransaction($tbl_a){
        $stmt   = Connection::connect()->prepare("SELECT transaction_code FROM $tbl_a ORDER BY transaction_ID DESC");
        $stmt->execute();

        return $stmt;

    }
}