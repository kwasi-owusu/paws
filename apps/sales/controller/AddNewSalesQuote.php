<?php

session_start();
class AddNewSalesQuote
{
    static public function saveNewSalesQuote(){
        $getToken   = $_POST['tkn'];
        $error      = false;

        if (isset($_SESSION['salesOrderToken']) && $_SESSION['salesOrderToken'] == $getToken){
            $customer_ID        = strip_tags(trim($_POST['customer_ID']));
            $so_terms           = strip_tags(trim($_POST['so_terms']));
            $quote_number       = strip_tags(trim($_POST['quote_number']));
            $curr               = strip_tags(trim($_POST['curr']));
            $amountDueTop       = strip_tags($_POST['amountDueTop']);

            $itemCode           = $_POST['productCode'];
            $itemName           = $_POST['itemName'];
            $price              = $_POST['price'];
            $quantity           = $_POST['quantity'];
            $total              = $_POST['total'];

            $delivery_dt        = $_POST['order_dt'];

            $data_owner         = $_SESSION['data_owner'];
            $my_branch          = $_SESSION['branch_name'];
            $addedBy            = $_SESSION['uid'];


            $totalAftertax      = trim($_POST['totalAftertax']);
            $amountPaid         = trim($_POST['amountPaid']);
            $amountDue          = trim($_POST['amountDue']);
            $discount_amount    = strip_tags(trim($_POST['discount_amount']));

            for ($count = 0; $count < count($itemName); $count++) {

                $itmCode = $itemCode[$count];
                $itName = $itemName[$count];
                $cost   = $price[$count];
                $qqty   = $quantity[$count];
                $subTotal = $total[$count];

                if (empty($itmCode || $itName) || empty($cost) || empty($qqty) || empty($subTotal)) {
                    $error = true;
                    echo '<br><span style="color: #ffffff;">Item Name, Price, and Quantity are Required </span>';
                }
            }

            $local_tax          = trim($_POST['local_tax']);

            require_once('../../model/sales/AddNewSalesQuoteMdl.php');

            if (!$error && $local_tax == 1){
                require_once ('../../model/settings/SelectAllTaxes.php');
                $txTbl              = 'setup_tax';
                $taxableAmount      = (float)$amountDue;

                $fetchNHILTax       = SelectAllTaxes::getNHILTax($txTbl);
                $nhsFx              = $fetchNHILTax->fetch(PDO::FETCH_ASSOC);
                $nhsPercent         = (float)$nhsFx['tax_percent']/100;
                $nhsAmount          = (float)$nhsPercent * $taxableAmount;

                $fetchGetFundTax    = SelectAllTaxes::getFundTax($txTbl);
                $gfx                = $fetchGetFundTax->fetch(PDO::FETCH_ASSOC);
                $getFundPercent     = (float)$gfx['tax_percent']/100;
                $getFundAmount      = (float)$getFundPercent * $taxableAmount;


                $fetchCovidTax    = SelectAllTaxes::covidTax($txTbl);
                $cvfx                = $fetchCovidTax->fetch(PDO::FETCH_ASSOC);
                $covidTaxPercent     = (float)$cvfx['tax_percent']/100;
                $covidTaxAmount      = (float)$covidTaxPercent * $taxableAmount;

                $totalBeforeVAT     = (float)$nhsAmount + $getFundAmount + $taxableAmount + $covidTaxAmount;

                $fetchVatTax        = SelectAllTaxes::getVatTax($txTbl);
                $vfx                = $fetchVatTax->fetch(PDO::FETCH_ASSOC);
                $vatPercent         = (float)$vfx['tax_percent']/100;
                $vatAmount          = (float)$vatPercent * $totalBeforeVAT;

                $grandTotal         = (float)$nhsAmount + $getFundAmount + $vatAmount + $covidTaxAmount + $taxableAmount;

                if (AddNewSalesQuoteMdl::saveNewSalesQuote($customer_ID, $so_terms, $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode, $itemName, $price,
                    $quantity, $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $taxableAmount, $nhsAmount, $getFundAmount, $covidTaxAmount,
                    $totalBeforeVAT, $vatAmount, $grandTotal, $addedBy, $data_owner, $my_branch)){
                    echo "<span style='color: #ffffff;'>Entry Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Entry Unsuccessful</span>";
                }

            }
            elseif (!$error && $local_tax == 0){
                if (AddNewSalesQuoteMdl::saveNewSalesQuoteNoTax($customer_ID, $so_terms,  $delivery_dt, $quote_number, $curr, $amountDueTop, $itemCode,
                    $itemName, $price, $quantity, $total, $totalAftertax, $amountPaid, $amountDue, $discount_amount, $addedBy, $data_owner, $my_branch)){
                    echo "<span style='color: #ffffff;'>Entry Successful</span>";
                }
                else{
                    echo "<span style='color: #ffffff;'>Entry Unsuccessful</span>";
                }
            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted</span>";
        }

    }
}

$calClass   = new AddNewSalesQuote();
$callMethod = $calClass->saveNewSalesQuote();