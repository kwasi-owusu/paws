<?php

require_once '../../../../model/connection.php';
class GetThisSupplierCategoryModel
{
static public function thisSupplierCategory($cat_ID){
    $stmt = Connection::connect()->prepare("SELECT * FROM suppliercategories WHERE sup_cat_ID = :sp");
    $stmt->bindParam('sp', $cat_ID, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}