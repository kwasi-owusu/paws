<?php

require_once '../../template/statics/conn/connection.php';
class EditInventoryCategoryByID
{
    public static function editCatByID($tbl, $data){
        $stmt = Connection::connect()->prepare("UPDATE $tbl SET cat_name = :ccn, cat_desc = :ccd WHERE cat_ID = :iid");
        $stmt->bindParam('ccn', $data['cn'], PDO::PARAM_STR);
        $stmt->bindParam('ccd', $data['cd'], PDO::PARAM_STR);
        $stmt->bindParam('iid', $data['id'], PDO::PARAM_STR);

        $stmt->execute();

        return $stmt;
    }
}