<?php

require_once '../../model/connection.php';
class RequestInventoryMgtMdl
{
    static public function scrapRequest($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(product_name, storage_ID, product_code, batch_num, received_qty, scrap_qty, po_ID, unit_cost, 
                wh_stored, storage_address, scrap_reason, dy, mm, yr, addedBy, branch_owner) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['pn'],
                    $data['sd'],
                    $data['pc'],
                    $data['bn'],
                    $data['rq'],
                    $data['sq'],
                    $data['pd'],
                    $data['uc'],
                    $data['wh'],
                    $data['sad'],
                    $data['sr'],
                    $data['d'],
                    $data['m'],
                    $data['y'],
                    $data['adb'],
                    $data['brn']
                ));

                //update inventory master
                $scrapQty   = $data['sq'];
                $update_inventory_master  = $thisPDO->prepare("UPDATE inventory_master set total_qty = total_qty - $scrapQty 
                WHERE inventory_code = :ic");
                $update_inventory_master->bindParam('ic', $data['pc'], PDO::PARAM_STR);
                $update_inventory_master->execute();


                //update product_storage_tbl
                $storage_ID     = $data['sd'];
                $update_product_storage_tbl     = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = recieved_qty - $scrapQty WHERE storage_ID = :d");
                $update_product_storage_tbl->bindParam('d', $storage_ID, PDO::PARAM_STR);
                $update_product_storage_tbl->execute();


                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
            }
        }
    }


    static public function transferInvRequest($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(product_name, storage_ID, product_code, batch_num, received_qty, transfer_qty, po_ID, unit_cost, 
                wh_stored, destination_wh, transfer_reason, dy, mm, yr, addedBy, branch_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['pn'],
                    $data['sd'],
                    $data['pc'],
                    $data['bn'],
                    $data['rq'],
                    $data['trq'],
                    $data['pd'],
                    $data['uc'],
                    $data['wh'],
                    $data['dst'],
                    $data['tr'],
                    $data['d'],
                    $data['m'],
                    $data['y'],
                    $data['adb'],
                    $data['brn']
                ));

                //update inventory master
                $transferQty   = $data['trq'];
                $update_inventory_master  = $thisPDO->prepare("UPDATE inventory_master SET total_qty = total_qty - $transferQty 
                WHERE inventory_code = :ivc");
                $update_inventory_master->bindParam('ivc', $data['pc'], PDO::PARAM_STR);
                $update_inventory_master->execute();


                //update product_storage_tbl
                $storage_ID     = $data['sd'];
                $update_product_storage_tbl     = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = recieved_qty - $transferQty 
                WHERE storage_ID = :d");
                $update_product_storage_tbl->bindParam('d', $storage_ID, PDO::PARAM_STR);
                $update_product_storage_tbl->execute();

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //echo $e->getMessage();
                echo "Failed";
            }
        }
    }

    static public function countVarianceRequest($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(product_name, storage_ID, product_code, batch_num, received_qty, variance_qty, 
                adjustment_value, po_ID, unit_cost, total_affected_value, trans_action, wh_stored, storage_address, variance_reason, dy, mm, yr, addedBy, branch_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['pn'],
                    $data['sd'],
                    $data['pc'],
                    $data['bn'],
                    $data['rq'],
                    $data['vq'],
                    $data['adv'],
                    $data['pd'],
                    $data['uc'],
                    $data['tav'],
                    $data['tra'],
                    $data['wh'],
                    $data['sad'],
                    $data['vr'],
                    $data['d'],
                    $data['m'],
                    $data['y'],
                    $data['adb'],
                    $data['brn']
                ));

                $oldQty     = $data['rq'];
                $newQty     = $data['vq'];

                if ($newQty > $oldQty) {
                    //update inventory master
                    $adjustmentVal = (float)$newQty - (float)$oldQty;
                    $update_inventory_master = $thisPDO->prepare("UPDATE inventory_master set total_qty = total_qty + $adjustmentVal 
                WHERE inventory_code = :ic");
                    $update_inventory_master->bindParam('ic', $data['pc'], PDO::PARAM_STR);
                    $update_inventory_master->execute();


                    //update product_storage_tbl
                    $storage_ID = $data['sd'];
                    $update_product_storage_tbl = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = recieved_qty + $adjustmentVal 
                    WHERE storage_ID = :d");
                    $update_product_storage_tbl->bindParam('d', $storage_ID, PDO::PARAM_STR);
                    $update_product_storage_tbl->execute();

                }
                elseif ($newQty < $oldQty){
                    //update inventory master
                    $adjustmentVal = (float)$oldQty - (float)$newQty;
                    $update_inventory_master = $thisPDO->prepare("UPDATE inventory_master set total_qty = total_qty - $adjustmentVal 
                    WHERE inventory_code = :ic");
                    $update_inventory_master->bindParam('ic', $data['pc'], PDO::PARAM_STR);
                    $update_inventory_master->execute();


                    //update product_storage_tbl
                    $storage_ID = $data['sd'];
                    $update_product_storage_tbl = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = recieved_qty - $adjustmentVal 
                    WHERE storage_ID = :d");
                    $update_product_storage_tbl->bindParam('d', $storage_ID, PDO::PARAM_STR);
                    $update_product_storage_tbl->execute();
                }

                elseif ($newQty == 0){
                    //update inventory master
                    $adjustmentVal = (float)$oldQty - (float)$newQty;
                    $update_inventory_master = $thisPDO->prepare("UPDATE inventory_master set total_qty = 0
                    WHERE inventory_code = :ic");
                    $update_inventory_master->bindParam('ic', $data['pc'], PDO::PARAM_STR);
                    $update_inventory_master->execute();


                    //update product_storage_tbl
                    $storage_ID = $data['sd'];
                    $update_product_storage_tbl = $thisPDO->prepare("UPDATE product_storage_tbl SET recieved_qty = 0 
                    WHERE storage_ID = :d");
                    $update_product_storage_tbl->bindParam('d', $storage_ID, PDO::PARAM_STR);
                    $update_product_storage_tbl->execute();
                }

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
            }
        }
    }
}