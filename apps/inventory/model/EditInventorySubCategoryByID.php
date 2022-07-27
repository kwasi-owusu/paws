<?php

require_once '../../template/statics/conn/connection.php';
class EditInventorySubCategoryByID
{
    public static function editSubCatByID($tbl, $data){
        $stmt = Connection::connect()->prepare("UPDATE $tbl SET cat_ID = :cid, sub_cat_name = :sccd WHERE sub_cat_ID = :iid");
        $stmt->bindParam('cid', $data['cid'], PDO::PARAM_STR);
        $stmt->bindParam('sccd', $data['sn'], PDO::PARAM_STR);
        $stmt->bindParam('iid', $data['scd'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }
}