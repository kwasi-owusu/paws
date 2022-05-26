<?php

require_once '../../model/connection.php';
class InventoryModel
{
    static public function addCategory($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {

                $stmt = $thisPDO->prepare("INSERT INTO $tbl(cat_name, cat_desc, addedBy) VALUES(?, ?, ?)");
                $stmt->execute(array($data['ctn'], $data['ctd'], $data['adb']));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "New Inventory Category Added";
                $activity = "New Inventory Category added with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //$e->getMessage();
                echo "Failed";
            }
        }
    }


    static public function addSubCategory($tbl, $data)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $stmt = $thisPDO->prepare("INSERT INTO $tbl(cat_ID, sub_cat_name, addedBy) VALUES(?, ?, ?)");
                $stmt->execute(array($data['cn'], $data['sbc'], $data['adb']));

                $lastInserted_ID = $thisPDO->lastInsertId();

                $activity_type = "New Inventory Sub Category Added";
                $activity = "New Inventory Sub Category added with id " . $lastInserted_ID;
                // create an activity
                $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                $u_act->execute(array($activity_type, $activity));

                $thisPDO->commit();

                return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //$e->getMessage();
                echo "Failed";
            }
        }
    }


    static public function addInventoryItem($tbl, $data){
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

        try {

            $stmt = $thisPDO->prepare("INSERT INTO $tbl(inventory_code, inventory_cat, invenotory_sub_cat, inventory_brand, inventory_name, 
            prod_prefix, Internal_ref, re_order_rule, sellable, inventory_desc, enable_desc, item_img, base_uom, addedBy) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($data['ivc'], $data['pct'], $data['isc'], $data['itb'], $data['ivn'], $data['pp'], $data['inr'], $data['ror'], $data['sll'],
                $data['ivd'], $data['edc'],$data['ig'], $data['uo'], $data['adb']));

            $lastInserted_ID = $thisPDO->lastInsertId();

            $activity_type = "New Inventory Item Added";
            $activity = "New Inventory Item added with id " . $lastInserted_ID;
            // create an activity
            $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
            $u_act->execute(array($activity_type, $activity));

            $thisPDO->commit();

            return $stmt;

        } catch (PDOException $e) {
            $thisPDO->rollBack();
            //$e->getMessage();
            echo "Failed";
            }
        }
    }


    static public function editInventoryItem($tbl, $data, $folder, $edited_trail_tbl, $original_data)
    {

        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $stt    = $thisPDO->prepare("INSERT INTO $edited_trail_tbl(inventory_ID, inventory_code, inventory_cat, invenotory_sub_cat, inventory_brand, 
                        inventory_name, Internal_ref, re_order_rule, sellable, enable_desc, item_img, base_uom, addedBy, data_owner, branch_owner) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stt->execute(array(
                    $original_data['ind'],
                    $original_data['ivc'],
                    $original_data['oct'],
                    $original_data['osb'],
                    $original_data['obr'],
                    $original_data['onm'],
                    $original_data['inf'],
                    $original_data['rr'],
                    $original_data['slb'],
                    $original_data['dcs'],
                    $original_data['itg'],
                    $original_data['um'],
                    $original_data['adb'],
                    $original_data['dto'],
                    $original_data['bro'],
                ));

                    $stmt = $thisPDO->prepare("UPDATE $tbl SET inventory_cat = :inv_ct, invenotory_sub_cat = :inv_sc, inventory_brand = :inv_brand, 
            inventory_name = :inv_nm, Internal_ref = :int_ref, re_order_rule = :rr_r, sellable = :sllb, enable_desc = :en_dsc, item_img = :itg, base_uom = :u, 
            InventoryStatus = 0, lastUpdateBy = :llb, lastUpdateOn = :lln WHERE inventory_ID = :inv_ID");
                    $stmt->bindParam('inv_ct', $data['pct'], PDO::PARAM_STR);
                    $stmt->bindParam('inv_sc', $data['isc'], PDO::PARAM_STR);
                    $stmt->bindParam('inv_brand', $data['itb'], PDO::PARAM_STR);
                    $stmt->bindParam('inv_nm', $data['ivn'], PDO::PARAM_STR);
                    $stmt->bindParam('int_ref', $data['inr'], PDO::PARAM_STR);
                    $stmt->bindParam('rr_r', $data['ror'], PDO::PARAM_STR);
                    $stmt->bindParam('sllb', $data['sll'], PDO::PARAM_STR);
                    $stmt->bindParam('en_dsc', $data['edc'], PDO::PARAM_STR);
                    $stmt->bindParam('itg', $data['ig'], PDO::PARAM_STR);
                    $stmt->bindParam('u', $data['uo'], PDO::PARAM_STR);
                    $stmt->bindParam('llb', $data['lb'], PDO::PARAM_STR);
                    $stmt->bindParam('lln', $data['ln'], PDO::PARAM_STR);
                    $stmt->bindParam('inv_ID', $data['ind'], PDO::PARAM_STR);
                    $stmt->execute();

                    $lastInserted_ID = Connection::connect()->lastInsertId();

                    $activity_type = "Inventory Item Updated";
                    $activity = "New Inventory Item added with id " . $lastInserted_ID;
                    // create an activity
                    $u_act = $thisPDO->prepare("INSERT INTO user_activity(activity_type, activity_details) VALUES(?, ?)");
                    $u_act->execute(array($activity_type, $activity));

                    $thisPDO->commit();

                    return $stmt;
            } catch (PDOException $e) {
                $thisPDO->rollBack();
                //$e->getMessage();
                echo "Failed";
            }
        }
    }

    static public function loadThisInventoryItem($tbl, $data){
        $stmt   = Connection::connect()->prepare("SELECT * FROM $tbl WHERE inventory_ID = :d AND inventory_code = :ic ORDER BY inventory_name ASC");
        $stmt->bindParam("d", $data['ind'], PDO::FETCH_ASSOC);
        $stmt->bindParam("ic", $data['ivc'], PDO::FETCH_ASSOC);
        $stmt->execute();

        return $stmt;
    }

}