<?php

require_once '../../model/connection.php';

class SaveNewPurchaseOrder
{
    static public function newLocalPurchaseOrderModel($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                                                      $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                                      $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                                                      $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy,
                                                      $purchase_order_type, $nhsAmount, $getFundAmount, $covidAmount, $vatAmount, $totalBeforeVAT, $grandTotal,
                                                      $branch_owner)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy = Date('d');
                $mnt = Date('m');
                $yr = Date('Y');
                $stmt = $thisPDO->prepare("INSERT INTO $tbl(po_num, purchase_order_type, supp_ID, approval_limit, dy, mn, yr, ets, eta, sched_dt, 
                instruction_details, po_key, addedBy, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($sanitizePo_number, $purchase_order_type, $sanitizeSupplCode, $sanitizeTotal_approval, $tdy, $mnt, $yr, $sanitizeEts,
                    $sanitizeEta, $sanitizePo_date, $sanitizePO_Details, $po_Key, $addedBy, $branch_owner));

                $po_ID = $thisPDO->lastInsertId();

                // save po Financial
                $pfn = $thisPDO->prepare("INSERT INTO po_financials(po_ID, po_num, curr, pmt_terms, price_factor, freightType, freight_amt, 
                nhil, getFund, covidAmount, before_vat, vat, amtDue, amt_paid, grand_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $pfn->execute(array($po_ID, $sanitizePo_number, $sanitizeCurr, $sanitizeTerms, $sanitizeTpp, $sanitizeFreight_type, $sanitizeFreight_amt,
                    $nhsAmount, $getFundAmount, $covidAmount, $totalBeforeVAT, $vatAmount, $sanitizeTotalAfterTax, $sanitizeAmountPaid, $grandTotal));

                // save PFI Images
                $total_images = count($img_nm);
                $upload_error = $_FILES['add_pfi']['error'];
                //$can_pass = $upload_error == 0 ? true : false;
                $these_pfi = $_FILES['add_pfi']['tmp_name'];

                for ($i = 0; $i < $total_images; $i++) {

                    $filename = $_FILES['add_pfi']['name'][$i];
                    $file_size = $_FILES['add_pfi']['size'][$i];
                    $fileError = $_FILES['add_pfi']['error'][$i];
                    $photo = "";

                    if ($file_size != 0 && $fileError != 4) {

                        //$pfi_img    = $_FILES['add_pfi']['tmp_name'];
                        list($width, $height) = getimagesize($these_pfi[$i]);
                        $newImgWidth = 2048;
                        $newImgHeight = 1152;


                        //$file_a = $_FILES['add_pfi'];
                        $rand_dt = rand(1, date('Y')) * rand(1, date('Y'));
                        $n_a = md5($rand_dt);

                        if ($_FILES["add_pfi"]["type"][$i] == "image/jpeg") {

                            $photo .= "$folder/" . $n_a . ".jpg";

                            $srcImage = imagecreatefromjpeg($these_pfi[$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);


                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagejpeg($destination, $photo);


                        } elseif ($_FILES["add_pfi"]["type"][$i] == "image/png") {
                            $photo .= "$folder/" . $n_a . ".png";

                            $srcImage = imagecreatefrompng($_FILES["add_pfi"]["tmp_name"][$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);

                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagepng($destination, $photo);

                        }
                    }

                }


                // save PO Items
                for ($count = 0; $count < count($sanitizeProductCode); $count++) {

                    $itCode = $sanitizeProductCode[$count];
                    $itName = $sanitizeItemName[$count];
                    $cost = $sanitizePrice[$count];
                    $qqty = $sanitizeQty[$count];
                    $total = $sanitizeTotal[$count];

                    ################################# unit cost #####################
                    $unitFreightCost = number_format($cost / $sanitizeAmountDue * $sanitizeFreight_amt, 4);
                    $unitNhSCost = number_format($cost / $sanitizeAmountDue * $nhsAmount, 4);
                    $unitGetFundCost = number_format($cost / $sanitizeAmountDue * $getFundAmount, 4);
                    $unitCovid           = number_format($cost / $sanitizeAmountDue * $covidAmount, 4);
                    $unitVATCost = number_format($cost / $sanitizeAmountDue * $vatAmount, 4);

                    $unitCost = (float)$cost + $unitFreightCost + $unitNhSCost + $unitGetFundCost + $unitVATCost + $unitCovid;

                    if (!empty($itName) || !empty($itCode) || !empty($cost) || !empty($qqty) || !empty($subTotal)) {
                        $query = $thisPDO->prepare("INSERT INTO purchase_order_items(po_ID, po_num, inventory_code, inventory_name, orij_qty, qty, unit_price, 
                        sub_total, unit_cost)
		    	    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $query->execute(array($po_ID, $sanitizePo_number, $itCode, $itName, $qqty, $qqty, $cost, $total, $unitCost));
                    }
                }

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Failed";
            }
        }
    }





    static public function saveLocalPOWIthSpecialVAT($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                                                      $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                                      $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                                                      $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy,
                                                      $purchase_order_type, $covidAmount, $vatAmount, $grandTotal,
                                                      $branch_owner)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy = Date('d');
                $mnt = Date('m');
                $yr = Date('Y');
                $stmt = $thisPDO->prepare("INSERT INTO $tbl(po_num, purchase_order_type, supp_ID, approval_limit, dy, mn, yr, ets, eta, sched_dt, 
                instruction_details, po_key, addedBy, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($sanitizePo_number, $purchase_order_type, $sanitizeSupplCode, $sanitizeTotal_approval, $tdy, $mnt, $yr, $sanitizeEts,
                    $sanitizeEta, $sanitizePo_date, $sanitizePO_Details, $po_Key, $addedBy, $branch_owner));

                $po_ID = $thisPDO->lastInsertId();

                // save po Financial
                $pfn = $thisPDO->prepare("INSERT INTO po_financials(po_ID, po_num, curr, pmt_terms, price_factor, freightType, freight_amt, 
                covidAmount, vat, amtDue, amt_paid, grand_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $pfn->execute(array($po_ID, $sanitizePo_number, $sanitizeCurr, $sanitizeTerms, $sanitizeTpp, $sanitizeFreight_type, $sanitizeFreight_amt,
                    $covidAmount, $vatAmount, $sanitizeTotalAfterTax, $sanitizeAmountPaid, $grandTotal));

                // save PFI Images
                $total_images = count($img_nm);
                $upload_error = $_FILES['add_pfi']['error'];
                //$can_pass = $upload_error == 0 ? true : false;
                $these_pfi = $_FILES['add_pfi']['tmp_name'];

                for ($i = 0; $i < $total_images; $i++) {

                    $filename = $_FILES['add_pfi']['name'][$i];
                    $file_size = $_FILES['add_pfi']['size'][$i];
                    $fileError = $_FILES['add_pfi']['error'][$i];
                    $photo = "";

                    if ($file_size != 0 && $fileError != 4) {

                        //$pfi_img    = $_FILES['add_pfi']['tmp_name'];
                        list($width, $height) = getimagesize($these_pfi[$i]);
                        $newImgWidth = 2048;
                        $newImgHeight = 1152;


                        //$file_a = $_FILES['add_pfi'];
                        $rand_dt = rand(1, date('Y')) * rand(1, date('Y'));
                        $n_a = md5($rand_dt);

                        if ($_FILES["add_pfi"]["type"][$i] == "image/jpeg") {

                            $photo .= "$folder/" . $n_a . ".jpg";

                            $srcImage = imagecreatefromjpeg($these_pfi[$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);


                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagejpeg($destination, $photo);


                        } elseif ($_FILES["add_pfi"]["type"][$i] == "image/png") {
                            $photo .= "$folder/" . $n_a . ".png";

                            $srcImage = imagecreatefrompng($_FILES["add_pfi"]["tmp_name"][$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);

                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagepng($destination, $photo);

                        }
                    }

                }


                // save PO Items
                for ($count = 0; $count < count($sanitizeProductCode); $count++) {

                    $itCode = $sanitizeProductCode[$count];
                    $itName = $sanitizeItemName[$count];
                    $cost = $sanitizePrice[$count];
                    $qqty = $sanitizeQty[$count];
                    $total = $sanitizeTotal[$count];

                    ################################# unit cost #####################
                    $unitFreightCost    = number_format($cost / $sanitizeAmountDue * $sanitizeFreight_amt, 2);
                    $unitVATCost        = number_format($cost / $sanitizeAmountDue * $vatAmount, 2);
                    $unitCovid          = number_format($cost / $sanitizeAmountDue * $covidAmount, 2);

                    $unitCost = (float)$cost + $unitFreightCost + $unitVATCost + $unitCovid;

                    if (!empty($itName) || !empty($itCode) || !empty($cost) || !empty($qqty) || !empty($subTotal)) {
                        $query = $thisPDO->prepare("INSERT INTO purchase_order_items(po_ID, po_num, inventory_code, inventory_name, orij_qty, qty, unit_price, 
                        sub_total, unit_cost)
		    	    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $query->execute(array($po_ID, $sanitizePo_number, $itCode, $itName, $qqty, $qqty, $cost, $total, $unitCost));
                    }
                }

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo $e->getMessage();
                //echo "Failed";
            }
        }
    }


    static public function newForeignPurchaseOrderModel($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                                                        $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                                        $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                                                        $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $addedBy,
                                                        $purchase_order_type, $branch_owner)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy = Date('d');
                $mnt = Date('m');
                $yr = Date('Y');
                $stmt = $thisPDO->prepare("INSERT INTO $tbl(po_num, purchase_order_type, supp_ID, approval_limit, dy, mn, yr, ets, eta, sched_dt, 
                instruction_details, po_key, addedBy, branch_owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($sanitizePo_number, $purchase_order_type, $sanitizeSupplCode, $sanitizeTotal_approval, $tdy, $mnt, $yr, $sanitizeEts,
                    $sanitizeEta, $sanitizePo_date, $sanitizePO_Details, $po_Key, $addedBy, $branch_owner));

                $po_ID = $thisPDO->lastInsertId();

                // save po Financial
                $pfn = $thisPDO->prepare("INSERT INTO po_financials(po_ID, po_num, curr, pmt_terms, price_factor, freightType, freight_amt, 
                amtDue, amt_paid, grand_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $pfn->execute(array($po_ID, $sanitizePo_number, $sanitizeCurr, $sanitizeTerms, $sanitizeTpp, $sanitizeFreight_type, $sanitizeFreight_amt,
                    $sanitizeTotalAfterTax, $sanitizeAmountPaid, $sanitizeAmountDue));

                // save PFI Images
                $total_images = count($img_nm);
                //$total_images = count($img_nm);
                $upload_error = $_FILES['add_pfi']['error'];
                //$can_pass = $upload_error == 0 ? true : false;

                $these_pfi = $_FILES['add_pfi']['tmp_name'];
                for ($i = 0; $i < $total_images; $i++) {

                    $filename = $_FILES['add_pfi']['name'][$i];
                    $file_size = $_FILES['add_pfi']['size'][$i];
                    $fileError = $_FILES['add_pfi']['error'][$i];
                    $photo = "";

                    if ($file_size != 0 && $fileError != 4) {
                        list($width, $height) = getimagesize($these_pfi[$i]);
                        $newImgWidth = 1152;
                        $newImgHeight = 2048;


                        //$file_a = $_FILES['add_pfi'];
                        $rand_dt = rand(1, date('Y')) * rand(1, date('Y'));
                        $n_a = md5($rand_dt);

                        if ($_FILES["add_pfi"]["type"][$i] == "image/jpeg") {

                            $photo .= "$folder/" . $n_a . ".jpg";

                            $srcImage = imagecreatefromjpeg($_FILES["add_pfi"]["tmp_name"][$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);


                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagejpeg($destination, $photo);


                        } elseif ($_FILES["add_pfi"]["type"][$i] == "image/png") {
                            $photo .= "$folder/" . $n_a . ".png";

                            $srcImage = imagecreatefrompng($these_pfi[$i]);
                            $destination = imagecreatetruecolor($newImgWidth, $newImgHeight);
                            imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newImgWidth, $newImgHeight, $width, $height);

                            $stmt = $thisPDO->prepare("INSERT INTO pfi_images(po_ID, po_num, image_nm)
                                    VALUES(?, ?, ?)");
                            $stmt->execute(array($po_ID, $sanitizePo_number, $photo));

                            imagepng($destination, $photo);

                        }
                    }
                }


                // save PO Items
                for ($count = 0; $count < count($sanitizeProductCode); $count++) {

                    $itCode = $sanitizeProductCode[$count];
                    $itName = $sanitizeItemName[$count];
                    $cost = $sanitizePrice[$count];
                    $qqty = $sanitizeQty[$count];
                    $total = $sanitizeTotal[$count];

                    $unitFreightCost = number_format($cost / $sanitizeAmountDue * $sanitizeFreight_amt, 4);

                    $unitCost = (float)$cost + $unitFreightCost;


                    if (!empty($itName) || !empty($itCode) || !empty($cost) || !empty($qqty) || !empty($subTotal)) {
                        $query = $thisPDO->prepare("INSERT INTO purchase_order_items(po_ID, po_num, inventory_code, inventory_name, orij_qty, qty, unit_price, 
                        sub_total, unit_cost)
		    	    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $query->execute(array($po_ID, $sanitizePo_number, $itCode, $itName, $qqty, $qqty, $cost, $total, $unitCost));
                    }
                }

                $thisPDO->commit();

                return $stmt;

            } catch (PDOException $e) {
                $thisPDO->rollBack();
                echo "Failed";
            }
        }
    }
}