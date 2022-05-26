<?php

require_once '../../template/statics/conn/connection.php';
class AllContactList
{
    static public function getContactLists($tbl, $data)
    {

        if ($data['ust'] == 2) {

            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE merchant_ID = :md ORDER BY firstName ASC");
            $stmt->bindParam('md', $data['md'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        } else {
            $stmt = Connection::connect()->prepare("SELECT * FROM $tbl WHERE addedBy = :me ORDER BY firstName ASC");
            $stmt->bindParam('me', $data['me'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
    }
}
