<?php

require_once '../../model/connection.php';
class ShortLandingCount
{
    static public function totalShortLanding($tbl){
    $stmt   = Connection::connect()->prepare("SELECT new_purch_oder.*, inbound_hold.*, purchase_order_items.*
        FROM new_purch_oder 
        INNER JOIN inbound_hold ON new_purch_oder.po_ID = inbound_hold.po_ID
        INNER JOIN purchase_order_items ON new_purch_oder.po_ID = purchase_order_items.po_ID
        WHERE inbound_hold.received_qty > 0
        AND (purchase_order_items.orij_qty - purchase_order_items.current_received_qty) > 0
        ");
    $stmt->execute();

    return $stmt->rowCount();
}

}