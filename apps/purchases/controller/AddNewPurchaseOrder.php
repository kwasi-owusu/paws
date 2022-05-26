<?php

session_start();

class AddNewPurchaseOrder
{
    static public function newPurchaseOrder()
    {
        $error = false;
        $getToken = trim($_POST['tkn']);

        if (isset($_SESSION['getPOCors']) && $_SESSION['getPOCors'] == $getToken) {

            $SupplCode = trim($_POST['supp_ID']);
            $sanitizeSupplCode = filter_var($SupplCode, FILTER_SANITIZE_STRING);

            $pmt_terms = trim($_POST['pmt_terms']);
            $sanitizeTerms = filter_var($pmt_terms, FILTER_SANITIZE_STRING);

            $ttp = trim($_POST['price_factor']);
            $sanitizeTpp = filter_var($ttp, FILTER_SANITIZE_STRING);

            $ets = trim($_POST['ets']);
            $sanitizeEts = filter_var($ets, FILTER_SANITIZE_STRING);

            $eta = trim($_POST['eta']);
            $sanitizeEta = filter_var($eta, FILTER_SANITIZE_STRING);

            $freight_type = trim($_POST['freightType']);
            $sanitizeFreight_type = filter_var($freight_type, FILTER_SANITIZE_STRING);

            $total_approval = trim($_POST['approval_limit']);
            $sanitizeTotal_approval = filter_var($total_approval, FILTER_SANITIZE_NUMBER_INT);

            $po_date = trim($_POST['sched_dt']);
            $sanitizePo_date = filter_var($po_date, FILTER_SANITIZE_STRING);

            $po_number = trim($_POST['po_num']);
            $sanitizePo_number = filter_var($po_number, FILTER_SANITIZE_STRING);

            $curr = trim($_POST['curr']);
            $sanitizeCurr = filter_var($curr, FILTER_SANITIZE_STRING);

            $amountDueTop = trim($_POST['amountDueTop']);
            $sanitizeAmountDueTop = filter_var($amountDueTop, FILTER_SANITIZE_NUMBER_FLOAT);

            $po_Key = hash_hmac('sha512', $SupplCode, $po_number);


            ####################### PO Item Details Here ####################################
            $sanitizeProductCode = $_POST['productCode'];
            //$sanitizeProductCode = filter_var_array($productCode, FILTER_SANITIZE_STRING);

            $sanitizeItemName = $_POST['itemName'];
            //$sanitizeItemName = filter_var_array($itemName, FILTER_SANITIZE_STRING);

            $sanitizePrice = $_POST['price'];
            //$sanitizePrice = filter_var_array($price, FILTER_SANITIZE_NUMBER_FLOAT);


            $sanitizeQty = $_POST['quantity'];
            //$sanitizeQty = filter_var_array($quantity, FILTER_SANITIZE_NUMBER_FLOAT);

            $sanitizeTotal = $_POST['total'];
            //$sanitizeTotal = filter_var_array($total, FILTER_SANITIZE_NUMBER_FLOAT);

            ############################## PO Item Details Ends Here ###################


            //////////////////////////// PO Financial /////////////////////////////
            $freight_amt = trim($_POST['freight_amt']);
            $sanitizeFreight_amt = filter_var($freight_amt, FILTER_SANITIZE_NUMBER_FLOAT);

            $sanitizeTotalAfterTax = trim($_POST['totalAfterTax']);
            //$sanitizeTotalAfterTax = filter_var($totalAfterTax, FILTER_SANITIZE_NUMBER_FLOAT);

            $sanitizeAmountPaid = trim($_POST['amt_paid']);
            //$sanitizeAmountPaid = filter_var($amountPaid, FILTER_SANITIZE_NUMBER_FLOAT);

            $sanitizeAmountDue = trim($_POST['amtDue']);
            //$sanitizeAmountDue = filter_var($amountDue, FILTER_SANITIZE_NUMBER_FLOAT);


            $po_details = trim($_POST['po_details']);
            $sanitizePO_Details = filter_var($po_details, FILTER_SANITIZE_STRING);

            $addedBy = $_SESSION['uid'];
            $branch_owner = $_SESSION['branch_name'];
            $purchase_order_type = trim($_POST['purchase_order_type']);


            $img_nm = $_FILES['add_pfi']['name'];

            $folder = 'pfis';

            $count = count($_FILES['add_pfi']['name']);
            for ($i = 0;
                 $i < $count;
                 $i++) {
                if (is_uploaded_file($_FILES['add_pfi']['tmp_name'][$i])) {
                    $mime_type = mime_content_type($_FILES['add_pfi']['tmp_name'][$i]);
                    $allowed_file_types = ['image/png', 'image/jpeg'];
                    if (!in_array($mime_type, $allowed_file_types)) {
                        $error = true;
                        echo '<br><div class="alert alert-danger" style="color: #f02e05;">Uploaded files not allowed</div>';
                    }
                }
            }

            for ($count = 0; $count < count($sanitizeProductCode); $count++) {

                $itCode = $sanitizeProductCode[$count];
                $itName = $sanitizeItemName[$count];
                $cost = $sanitizePrice[$count];
                $qqty = $sanitizeQty[$count];
                $subTotal = $sanitizeTotal[$count];

                if (empty($itName) || empty($itCode) || empty($cost) || empty($qqty) || empty($sanitizeTotal)) {
                    $error = true;
                    echo '<br><span style="color: #ffffff;">Item Name, Price, and Quantity are Required </span>';
                }
            }


            $tbl = 'new_purch_oder';
            require_once('../../model/purchases/SaveNewPurchaseOrder.php');
            if (!$error && $purchase_order_type == 1) {
                // Local Purchase Order 17.5%
                require_once ('../../model/settings/SelectAllTaxes.php');

                $txTbl              = 'setup_tax';
                $taxableAmount      = (float)$sanitizeAmountDue - $sanitizeFreight_amt;

                $fetchNHILTax       = SelectAllTaxes::getNHILTax($txTbl);
                $nhsFx              = $fetchNHILTax->fetch(PDO::FETCH_ASSOC);
                $nhsPercent         = (float)$nhsFx['tax_percent']/100;
                $nhsAmount          = (float)$nhsPercent * $taxableAmount;

                $fetchGetFundTax    = SelectAllTaxes::getFundTax($txTbl);
                $gfx                = $fetchGetFundTax->fetch(PDO::FETCH_ASSOC);
                $getFundPercent     = (float)$gfx['tax_percent']/100;
                $getFundAmount      = (float)$getFundPercent * $taxableAmount;

                $fetchCovidTax      = SelectAllTaxes::covidTax($txTbl);
                $cvd                = $fetchCovidTax->fetch(PDO::FETCH_ASSOC);
                $covidPercent     = (float)$cvd['tax_percent']/100;
                $covidAmount      = (float)$covidPercent * $taxableAmount;

                $totalBeforeVAT     = (float)$nhsAmount + $getFundAmount + $covidAmount + $taxableAmount;

                $fetchVatTax        = SelectAllTaxes::getVatTax($txTbl);
                $vfx                = $fetchVatTax->fetch(PDO::FETCH_ASSOC);
                $vatPercent         = (float)$vfx['tax_percent']/100;
                $vatAmount          = (float)$vatPercent * $totalBeforeVAT;


                $grandTotal         = (float)$nhsAmount + $getFundAmount + $covidAmount + $vatAmount + $taxableAmount + $freight_amt;


                if (SaveNewPurchaseOrder::newLocalPurchaseOrderModel($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta,
                    $sanitizeFreight_type, $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                    $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt, $sanitizeAmountPaid,
                    $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy, $purchase_order_type, $nhsAmount, $getFundAmount,
                    $covidAmount, $vatAmount, $totalBeforeVAT, $grandTotal, $branch_owner)) {

                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #ffffff'>Entry Unsuccessful</span>";
                }
            }


            elseif (!$error && $purchase_order_type == 99) {
                // Local Purchase Order 4%
                require_once ('../../model/settings/SelectAllTaxes.php');

                $txTbl              = 'setup_tax';
                $taxableAmount      = (float)$sanitizeAmountDue - $sanitizeFreight_amt;


                $fetchCovidTax      = SelectAllTaxes::covidTax($txTbl);
                $cvd                = $fetchCovidTax->fetch(PDO::FETCH_ASSOC);
                $covidPercent     = (float)$cvd['tax_percent']/100;
                $covidAmount      = (float)$covidPercent * $taxableAmount;

                $fetchVatTax        = SelectAllTaxes::specialVAT($txTbl);
                $vfx                = $fetchVatTax->fetch(PDO::FETCH_ASSOC);
                $vatPercent         = (float)$vfx['tax_percent']/100;
                $vatAmount          = (float)$vatPercent * $sanitizeAmountDue;

                $grandTotal         = (float)$covidAmount + $vatAmount + $taxableAmount + $freight_amt;


                if (SaveNewPurchaseOrder::saveLocalPOWIthSpecialVAT($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                    $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                    $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                    $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy,
                    $purchase_order_type, $covidAmount, $vatAmount, $grandTotal,
                    $branch_owner)) {

                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #ffffff'>Entry Unsuccessful</span>";
                }
            }
            elseif (!$error && $purchase_order_type == 2){
                // Non Taxable Purchase Order
                if (SaveNewPurchaseOrder::newForeignPurchaseOrderModel($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                    $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                    $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                    $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy, $purchase_order_type, $branch_owner)) {

                    echo "<span style='color: #ffffff'>Entry Successful.</span>";
                } else {
                    echo "<span style='color: #ffffff'>Entry Unsuccessful</span>";
                }

            }
        } else {
            echo "<span style='color: #ffffff'>Sorry. Action not permitted</span>";
        }
    }
}

$callClass = new AddNewPurchaseOrder();
$callMethod = $callClass->newPurchaseOrder();