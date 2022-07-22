<?php
require_once '../../../template/statics/conn/connection.php';
class BranchesForModalMDL{
    public static function allBranchesForModal() {
        $stmt = Connection::connect()->prepare("SELECT * FROM branches ORDER BY branch_name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}