<?php

session_start();
date_default_timezone_set('Africa/Accra');

require_once "print/vendor/autoload.php";

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\EscposImage;
//use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;

class AddNewPOSSales
{
    public static function addPOSTransaction()
    {
        $getToken   = strip_tags(trim($_POST['tkn']));
        if (isset($_SESSION['pos_token']) && $_SESSION['pos_token'] == $getToken) {

            if (isset($_POST['itemCode'])) {

                $error = false;

                $getCurrency = strip_tags(trim("GHS"));
                $customer = "";
                $addedBy = $_SESSION['uid'];
                $branch_owner = $_SESSION['branch_name'];
                $totalAftertax = strip_tags(trim($_POST['totalAftertax']));
                $amountPaid = strip_tags(trim($_POST['amountPaid']));
                $amountDue = strip_tags(trim($_POST['amountDue']));

                $taxableSales = strip_tags(trim($_POST['taxableSales']));

                $itemCode = $_POST['itemCode'];
                $storage_ID = $_POST['storage_ID'];
                $itemName = $_POST['itemName'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $_POST['total'];

                $tdy = Date('d');
                $mnt = Date('m');
                $yr = Date('Y');

                $pmt_type = isset($_POST['pmt_type']) ? strip_tags(trim($_POST['pmt_type'])) : "Cash";

                $initialTransactionCode = '10000000';
                $thisTransactionCode = '';

                $tbl_a = 'pos_trans';
                $tbl_b = 'pos_trans_items';
                $tbl_c = 'pos_trans_financials';

                require_once('../../settings/model/SelectAllTaxes.php');
                require_once('../model/POSTransactionsMdl.php');

                $callTransCode = POSTransactionsMdl::getLatestTransaction($tbl_a);
                $cntTransCode = $callTransCode->rowCount();
                if ($cntTransCode > 0) {
                    $fetchTransactionCode = POSTransactionsMdl::getLatestTransaction($tbl_a);
                    $fetchCode = $fetchTransactionCode->fetch(PDO::FETCH_ASSOC);
                    $lastCode = $fetchCode['transaction_code'];
                    $thisTransactionCode = $lastCode + 1;
                } else {
                    $thisTransactionCode = $initialTransactionCode;
                }

                for ($count = 0; $count < count($itemCode); $count++) {

                    $std = $storage_ID[$count];
                    $itCode = $itemCode[$count];
                    $itName = $itemName[$count];
                    $cost = $price[$count];
                    $qty = $quantity[$count];
                    $subTotal = $total[$count];

                    if (empty($itName) || empty($itCode) || empty($cost) || empty($qty) || empty($subTotal) || empty($std)) {
                        $error = true;
                        echo '<br><span style="color: #ffffff;">Item Name, Price, and Quantity are Required </span>' . $itName;
                    }
                }

                if (!$error && $taxableSales == 1) {

                    $txTbl = 'setup_tax';
                    $taxableAmount = (float)$totalAftertax;


                    $fetchCovidTax = SelectAllTaxes::covidTax($txTbl);
                    $cvd = $fetchCovidTax->fetch(PDO::FETCH_ASSOC);
                    $covidPercent = (float)$cvd['tax_percent'] / 100;
                    $covidAmount = (float)$covidPercent * $taxableAmount;

                    $totalBeforeVAT = (float)$covidAmount + $taxableAmount;

                    $fetchVatTax = SelectAllTaxes::getVatTax($txTbl);
                    $vfx = $fetchVatTax->fetch(PDO::FETCH_ASSOC);
                    $vatPercent = (float)$vfx['tax_percent'] / 100;
                    $vatAmount = (float)$vatPercent * $totalBeforeVAT;

                    //                    $grandTotal = (float)$covidAmount + $vatAmount + $taxableAmount;
                    $grandTotal = $totalAftertax;

                    $merchant_ID    = $_SESSION['merchant_ID'];

                    $data = array(
                        'curr' => $getCurrency,
                        'cst' => $customer,
                        'adb' => $addedBy,
                        'brn' => $branch_owner,
                        'totalAT' => $totalAftertax,
                        'amP' => $amountPaid,
                        'amd' => $amountDue,
                        'salesType' => $taxableSales,
                        'std' => $storage_ID,
                        'itc' => $itemCode,
                        'itn' => $itemName,
                        'prc' => $price,
                        'qt' => $quantity,
                        'sub' => $total,
                        'cvd' => $covidAmount,
                        'bfv' => $totalBeforeVAT,
                        'vt' => $vatAmount,
                        'grd' => $grandTotal,
                        'trnCode' => $thisTransactionCode,
                        'ptp' => $pmt_type,
                        'tdy' => $tdy,
                        'mnt' => $mnt,
                        'yr' => $yr,
                        'md'=> $merchant_ID
                    );

                    if (POSTransactionsMdl::saveTaxableTransactions($tbl_a, $tbl_b, $tbl_c, $data)) {

                        //setup printer
                        $connector = new DummyPrintConnector();
                        $profile = CapabilityProfile::load("TSP600");
                        $printer = new Printer($connector);

                        //$printer = new Printer($connectWindows);

                        $printer->setJustification(Printer::JUSTIFY_CENTER);

                        $printer->text(Date("Y-m-d H:i:s") . "\n"); //Invoice date

                        $printer->feed(1); //We feed paper 1 time*/

                        $img = EscposImage::load("logo.png");
                        $printer->graphics($img);

                        $printer->text("Atlantic Catering & Logistics" . "\n");

                        $printer->text("Receipt No." . $thisTransactionCode . "\n");
                        $printer->text("-------------------------------\n");

                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->text("Customer: " . $customer . "\n"); //Customer's name

                        $printer->setJustification(Printer::JUSTIFY_LEFT);
                        $printer->text("Description ");
                        $printer->setJustification(Printer::JUSTIFY_RIGHT);
                        $printer->text(" Quantity ");
                        $printer->text(" Price ");
                        $printer->text(" Total \n");


                        for ($countPrint = 0; $countPrint < count($itemCode); $countPrint++) {

                            $printer->setJustification(Printer::JUSTIFY_LEFT);

                            $printer->text($itemName[$countPrint] . " "); //Product's name

                            $printer->setJustification(Printer::JUSTIFY_RIGHT);
                            $printer->text(" " . number_format($quantity[$countPrint], 2) . " " . $price[$countPrint] . " " . number_format($total[$countPrint], 2) . "\n");
                        }


                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->setJustification(Printer::JUSTIFY_RIGHT);
                        $printer->text("Total: " . number_format($taxableAmount, 2) . "\n"); //net price

                        $printer->text("COVID Tax:" . number_format($covidAmount, 2) . "\n"); //tax value
                        $printer->text("VAT Tax: " . number_format($vatAmount, 2) . "\n"); //tax value

                        $printer->text("----------------------------\n");

                        $printer->text("GRAND TOTAL:  " . number_format($grandTotal, 2) . "\n"); //ahora va el total

                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->setJustification(Printer::JUSTIFY_CENTER);

                        $printer->text("Thank you for your purchase \n"); //We can add a footer

                        $printer->text("====================== \n"); //We can add a footer

                        $printer->text("Rails ERP- Point of Sale" . "\n"); //Software name


                        $printer->feed(3); //We feed paper 3 times*/

                        $printer->cut(); //We cut the paper, if the printer has the option


                        $data = $connector->getData();
                        $base64data = base64_encode($data);

                        echo $base64data;

                        $printer->pulse();
                        $printer->close();
                    } else {
                        echo "<span style='color: #ffffff;'>Transaction Unsuccessful</span> ";
                    }
                } elseif (!$error && $taxableSales == 0) {
                    $data = array(
                        'curr' => $getCurrency,
                        'std' => $storage_ID,
                        'cst' => $customer,
                        'adb' => $addedBy,
                        'brn' => $branch_owner,
                        'totalAT' => $totalAftertax,
                        'amP' => $amountPaid,
                        'amd' => $amountDue,
                        'salesType' => $taxableSales,
                        'itc' => $itemCode,
                        'itn' => $itemName,
                        'prc' => $price,
                        'qt' => $quantity,
                        'sub' => $total,
                        'trnCode' => $thisTransactionCode,
                        'ptp' => $pmt_type
                    );

                    if (POSTransactionsMdl::saveNonTaxableTransactions($tbl_a, $tbl_b, $tbl_c, $data)) {


                        //setup printer
                        $connector = new DummyPrintConnector();
                        $profile = CapabilityProfile::load("TSP600");
                        $printer = new Printer($connector);

                        //$printer = new Printer($connectWindows);

                        $printer->setJustification(Printer::JUSTIFY_CENTER);

                        $printer->text(Date("Y-m-d H:i:s") . "\n"); //Invoice date

                        $printer->feed(1); //We feed paper 1 time*/

                        $img = EscposImage::load("logo.png");
                        $printer->graphics($img);

                        $printer->text("Atlantic Catering & Logistics" . "\n");

                        $printer->setJustification(Printer::JUSTIFY_LEFT);

                        $printer->text("Receipt No." . $thisTransactionCode . "\n"); //Invoice number

                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->text("Customer: " . $customer . "\n"); //Customer's name

                        $printer->setJustification(Printer::JUSTIFY_LEFT);
                        $printer->text("Item ");
                        $printer->setJustification(Printer::JUSTIFY_RIGHT);
                        $printer->text(" Quantity ");
                        $printer->text(" Price ");
                        $printer->text(" Total ");


                        for ($countPrint = 0; $countPrint < count($itemCode); $countPrint++) {

                            $printer->setJustification(Printer::JUSTIFY_LEFT);

                            $printer->text($itemName[$countPrint] . " "); //Product's name

                            $printer->setJustification(Printer::JUSTIFY_RIGHT);
                            $printer->text(" " . number_format($quantity[$countPrint], 2) . " " . $price[$countPrint] . " " . number_format($total[$countPrint], 2) . "\n");
                        }


                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->setJustification(Printer::JUSTIFY_RIGHT);

                        $printer->text("----------------------------\n");

                        $printer->text("GRAND TOTAL:  " . $getCurrency . number_format($amountDue, 2) . "\n");

                        $printer->feed(1); //We feed paper 1 time*/

                        $printer->setJustification(Printer::JUSTIFY_CENTER);

                        $printer->text("Thank you for your purchase \n"); //We can add a footer

                        $printer->text("====================== \n"); //We can add a footer

                        $printer->text("Rails ERP- Point of Sale" . "\n"); //Software name


                        $printer->feed(3); //We feed paper 3 times*/

                        $printer->cut(); //We cut the paper, if the printer has the option


                        $data = $connector->getData();
                        $base64data = base64_encode($data);

                        echo $base64data;

                        $printer->pulse();
                        $printer->close();
                    }
                }
            } else {
                echo "<span style='color: #ffffff;'>Action Not Permitted</span> ";
            }
        } else {
            echo "Action Not Permitted";
        }
    }
}

AddNewPOSSales::addPOSTransaction();
