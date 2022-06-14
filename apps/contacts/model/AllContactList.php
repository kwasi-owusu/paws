<?php

require_once '../../template/statics/conn/connection.php';
class AllContactList
{
    static public function getContactLists($tbl, $tbl_b, $data)
    {

        if ($data['ust'] == 2) {

            $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.* FROM $tbl 
            INNER JOIN $tbl_b ON $tbl.contact_cat = $tbl_b.cnt_cat_ID
            WHERE $tbl.merchant_ID = :md ORDER BY $tbl.firstName ASC");
            $stmt->bindParam('md', $data['md'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        } else {
            $stmt = Connection::connect()->prepare("SELECT $tbl.*, $tbl_b.* FROM $tbl 
            INNER JOIN $tbl_b ON $tbl.contact_cat = $tbl_b.cnt_cat_ID
            WHERE $tbl.addedBy = :me ORDER BY $tbl.firstName ASC");
            $stmt->bindParam('me', $data['me'], PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        }
    }

    public static function contactCategories(){
        $stmt = Connection::connect()->prepare("SELECT * FROM contact_category ORDER BY cat_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
    
}
