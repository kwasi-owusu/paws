<?php

require_once '../../template/statics/conn/connection.php';
class ShortLandingMdl
{
    public static function getShortLanding()
    {
        $stmt = Connection::connect()->prepare("SELECT purchase_order_items.*, inbound_hold.*
        FROM purchase_order_items 
        INNER JOIN inbound_hold ON purchase_order_items.po_ID = inbound_hold.po_ID
        WHERE inbound_hold.received_qty > 0
        AND (purchase_order_items.orij_qty - purchase_order_items.current_received_qty) > 0
        ");
        $stmt->execute();

        return $stmt;
    }
}