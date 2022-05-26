<?php


class DeleteThisPO
{
    static public function DeleteThisPurchaseOrder(){
        $po_ID  = strip_tags(trim($_POST['po_ID']));
        require_once '../../model/purchases/DeleteThisPOItem.php';

        $tbl    = 'new_purch_oder';

        if (DeleteThisPOItem::deleteThis($tbl, $po_ID)){
            echo "<span style='color: #ffffff;'>Action Successful</span>";
        }
        else{
            echo "<span style='color: #ffffff;'>Action Unsuccessful</span>";
        }
    }
}

$callClass  = new DeleteThisPO();
$callMethod = $callClass->DeleteThisPurchaseOrder();