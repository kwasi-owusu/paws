<?php


class DoInventoryCors
{
    public static function inventoryCategoryCors($page_name)
    {
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $inventoryCat = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $inventoryCat;
    }


    public static function editInventoryCategoryCors()
    {
        $page_is        = "do.inventory.editInventoryCategoryCors.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $inventoryCat = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $inventoryCat;
    }

    public static function inventorySubCategoryCors()
    {
        $page_is        = "do.inventory.inventorySubCategoryCors.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $inventorySubCat = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $inventorySubCat;
    }

    public static function editInventorySubCategoryCors()
    {
        $page_is        = "do.inventory.editInventorySubCategoryCors.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $inventorySubCatEdit = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $inventorySubCatEdit;
    }


    public static function inventoryItemsCors($page_name)
    {
        $page_is        = $page_name;
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $inventoryItemCat = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $inventoryItemCat;
    }


    public static function editInventoryItemsCors()
    {
        $page_is        = "do.inventory.editInventoryItemsCors.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $editInventoryItemCat = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $editInventoryItemCat;
    }


    public static function scrapInventoryRequest()
    {
        $page_is        = "do.inventory.request_inventory_scrap.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $request_scrap = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $request_scrap;
    }


    public static function transferInventoryRequest()
    {
        $page_is        = "do.inventory.request_inventory_transfer.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $request_transfer = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $request_transfer;
    }

    public static function countVarianceToken()
    {
        $page_is        = "do.inventory.request_inventory_count_variance.php";
        $thi_is_is      = "[Developed by Bahrima InfoSystems with LOVE]";
        $rock_hash      = $page_is . $thi_is_is;

        $count_variance = hash_hmac('sha512', $rock_hash, $thi_is_is);

        return $count_variance;
    }
}
