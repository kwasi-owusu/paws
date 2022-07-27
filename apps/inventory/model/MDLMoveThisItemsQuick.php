<?php

require_once '../../template/statics/conn/connection.php';
class MDLMoveThisItemsQuick
{
    static public function moveThisToStoreQuick($tbl_a, $tbl_b, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

                    // 'pn'=> $product_name,
                    // 'pc'=> $product_code,
                    // 'rq'=> $received_qty,
                    // 'ict' => $inventory_cat,
                    // 'isc'=> $inventory_sub_cat,
                    // 'uc'=> $unit_cost,
                    // 'snm'=> $store_name,
                    // 'bn'=> $batch_num,
                    // 'd'=> $dy,
                    // 'm'=> $mn,
                    // 'y'=> $yr,
                    // 'adb'=> $addedBy,
                    // 'brn' => $branch,
                    // 'exp' => $expiry_dt,
                    // 'mnd'=> $manu_dt


        if ($thisPDO->beginTransaction()) {
            try {
                $stmt = $thisPDO->prepare("INSERT INTO $tbl_b(product_code, inventory_cat_ID, invenotory_sub_cat_ID, product_name, 
                unit_cost, recieved_qty, wh_stored, manu_dt, expiry_dt, addedBy, branch_owner, merchant_ID) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array(
                    $data['pc'],
                    $data['ict'],
                    $data['isc'],
                    $data['pn'],
                    $data['uc'],
                    $data['rq'],
                    $data['snm'],
                    $data['mnd'],
                    $data['exp'],
                    $data['adb'],
                    $data['snm'],
                    $data['md']
                ));

                $stmt_a = $thisPDO->prepare("INSERT INTO $tbl_a(product_code, inventory_cat, inventory_sub_cat, product_name, 
                unit_cost, recieved_qty, wh_stored, manu_dt, expiry_dt, addedBy, shop_ID, branch_owner, merchant_ID) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt_a->execute(array(
                    $data['pc'],
                    $data['ict'],
                    $data['isc'],
                    $data['pn'],
                    $data['uc'],
                    $data['rq'],
                    $data['snm'],
                    $data['mnd'],
                    $data['exp'],
                    $data['adb'],
                    $data['snm'],
                    $data['brn'],
                    $data['md']
                ));

                          

                //update inventory master
                $transferQty   = $data['rq'];
                $update_inventory_master  = $thisPDO->prepare("UPDATE inventory_master SET total_qty = total_qty + $transferQty 
                WHERE inventory_code = :ivc");
                $update_inventory_master->bindParam('ivc', $data['pc'], PDO::PARAM_STR);
                $update_inventory_master->execute();


                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Failed";
                echo $e->getMessage();
            }
        }
    }

    static public function updateShopItems($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {
            try {
                $thisReceivedQty = $data['trq'];
                $stmt = $thisPDO->prepare("UPDATE $tbl SET  recieved_qty = recieved_qty + $thisReceivedQty WHERE product_code = :pc");
                $stmt->bindParam('pc', $data['pc'], PDO::PARAM_STR);
                $stmt->execute();

                //insert into shop_transfer_records table
                $rcd = $thisPDO->prepare("INSERT INTO shop_transfer_records(product_code, inventory_cat, inventory_sub_cat, product_name, 
                unit_cost, barcode, recieved_qty, wh_stored, manu_dt, expiry_dt, addedBy, branch_owner) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $rcd->execute(array(
                    $data['pc'],
                    $data['ict'],
                    $data['isc'],
                    $data['pn'],
                    $data['uc'],
                    $data['brc'],
                    $data['trq'],
                    $data['dst'],
                    $data['mnd'],
                    $data['exp'],
                    $data['adb'],
                    $data['brn'],

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
                echo "Failed \n";
                //echo $e->getMessage();
            }
        }
    }

    static public function checkIfItemExist($tbl, $product_code){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE product_code = :pc");
        $stmt->bindParam('pc', $product_code, PDO::PARAM_STR);
        //$stmt->bindParam('wh', $destination_wh, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }
}
