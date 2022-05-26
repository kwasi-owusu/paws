<?php

require_once '../../model/connection.php';

class UpdateThisPurchaseOrder
{
    static public function UpdateTaxablePO($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                                           $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                           $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                                           $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder,
                                           $purchase_order_type, $nhsAmount, $getFundAmount, $covidAmount, $vatAmount, $totalBeforeVAT,
                                           $grandTotal, $po_ID, $lastUpdateBy)
    {

            $newPDO = new Connection();
            $thisPDO = $newPDO->Connect();

            if ($thisPDO->beginTransaction()) {

                try {
                    $tdy = Date('d');
                    $mnt = Date('m');
                    $yr = Date('Y');
                    $stmt = $thisPDO->prepare("UPDATE $tbl SET purchase_order_type = :pt, supp_ID = :sid, approval_limit = :apl, dy = :dy, mn = :mn, 
                    yr = :yr, ets = :ets, eta = :eta, sched_dt = :scd, instruction_details = :inst, lastUpdateBy = :lbd
                    WHERE po_ID = :pd
                   ");
                    $stmt->bindParam('pt', $purchase_order_type, PDO::PARAM_STR);
                    $stmt->bindParam('sid', $sanitizeSupplCode, PDO::PARAM_STR);
                    $stmt->bindParam('apl', $sanitizeTotal_approval, PDO::PARAM_STR);
                    $stmt->bindParam('dy', $tdy, PDO::PARAM_STR);
                    $stmt->bindParam('mn', $mnt, PDO::PARAM_STR);
                    $stmt->bindParam('yr', $yr, PDO::PARAM_STR);
                    $stmt->bindParam('ets', $sanitizeEts, PDO::PARAM_STR);
                    $stmt->bindParam('eta', $sanitizeEta, PDO::PARAM_STR);
                    $stmt->bindParam('scd', $sanitizePo_date, PDO::PARAM_STR);
                    $stmt->bindParam('scd', $sanitizePO_Details, PDO::PARAM_STR);
                    $stmt->bindParam('inst', $sanitizePO_Details, PDO::PARAM_STR);
                    $stmt->bindParam('lbd', $lastUpdateBy, PDO::PARAM_STR);
                    $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
                    $stmt->execute();


                    $pfn = $thisPDO->prepare("UPDATE po_financials SET curr = :cur, pmt_terms = :ptm, price_factor = :prf, freightType = :frt, 
                    freight_amt = :fra, nhil = :nh, getFund = :gf, covidAmount = :cvd, before_vat = :bfv, vat = :v, amtDue = :amtd, amt_paid = :amtp, 
                    grand_total = :grt
                    WHERE po_ID = :pd
                    ");
                    $pfn->bindParam('cur', $sanitizeCurr, PDO::PARAM_STR);
                    $pfn->bindParam('ptm', $sanitizeTerms, PDO::PARAM_STR);
                    $pfn->bindParam('prf', $sanitizeTpp, PDO::PARAM_STR);
                    $pfn->bindParam('frt', $sanitizeFreight_type, PDO::PARAM_STR);
                    $pfn->bindParam('fra', $sanitizeFreight_amt, PDO::PARAM_STR);
                    $pfn->bindParam('nh', $nhsAmount, PDO::PARAM_STR);
                    $pfn->bindParam('gf', $getFundAmount, PDO::PARAM_STR);
                    $pfn->bindParam('cvd', $covidAmount, PDO::PARAM_STR);
                    $pfn->bindParam('bfv', $totalBeforeVAT, PDO::PARAM_STR);
                    $pfn->bindParam('v', $vatAmount, PDO::PARAM_STR);
                    $pfn->bindParam('amtd', $sanitizeTotalAfterTax, PDO::PARAM_STR);
                    $pfn->bindParam('amtp', $sanitizeAmountPaid, PDO::PARAM_STR);
                    $pfn->bindParam('grt', $grandTotal, PDO::PARAM_STR);
                    $pfn->bindParam('pd', $po_ID, PDO::PARAM_STR);

                    $pfn->execute();

                    //delete old images
                    $delPFI     = $thisPDO->prepare("DELETE FROM pfi_images WHERE po_ID = :pd");
                    $delPFI->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delPFI->execute();

                    //delete all approvals for this Purchase Order
                    $delAPV     = $thisPDO->prepare("DELETE FROM po_approvals WHERE po_ID = :pd");
                    $delAPV->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delAPV->execute();

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


                    //delete old PO Items
                    $delPIT     = $thisPDO->prepare("DELETE FROM purchase_order_items WHERE po_ID = :pd");
                    $delPIT->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delPIT->execute();

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
                        $unitVATCost = number_format($cost / $sanitizeAmountDue * $vatAmount, 4);

                        $unitCost = (float)$cost + $unitFreightCost + $unitNhSCost + $unitGetFundCost + $unitVATCost;

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


        static public function UpdateSpecialTaxablePO($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta,
                                               $sanitizeFreight_type, $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                               $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt, $sanitizeAmountPaid,
                                               $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder, $purchase_order_type,
                                               $covidAmount, $vatAmount, $grandTotal, $po_ID, $lastUpdateBy)
    {

            $newPDO = new Connection();
            $thisPDO = $newPDO->Connect();

            if ($thisPDO->beginTransaction()) {

                try {
                    $tdy = Date('d');
                    $mnt = Date('m');
                    $yr = Date('Y');
                    $stmt = $thisPDO->prepare("UPDATE $tbl SET purchase_order_type = :pt, supp_ID = :sid, approval_limit = :apl, dy = :dy, mn = :mn, 
                    yr = :yr, ets = :ets, eta = :eta, sched_dt = :scd, instruction_details = :inst, lastUpdateBy = :lbd
                    WHERE po_ID = :pd
                   ");
                    $stmt->bindParam('pt', $purchase_order_type, PDO::PARAM_STR);
                    $stmt->bindParam('sid', $sanitizeSupplCode, PDO::PARAM_STR);
                    $stmt->bindParam('apl', $sanitizeTotal_approval, PDO::PARAM_STR);
                    $stmt->bindParam('dy', $tdy, PDO::PARAM_STR);
                    $stmt->bindParam('mn', $mnt, PDO::PARAM_STR);
                    $stmt->bindParam('yr', $yr, PDO::PARAM_STR);
                    $stmt->bindParam('ets', $sanitizeEts, PDO::PARAM_STR);
                    $stmt->bindParam('eta', $sanitizeEta, PDO::PARAM_STR);
                    $stmt->bindParam('scd', $sanitizePo_date, PDO::PARAM_STR);
                    $stmt->bindParam('scd', $sanitizePO_Details, PDO::PARAM_STR);
                    $stmt->bindParam('inst', $sanitizePO_Details, PDO::PARAM_STR);
                    $stmt->bindParam('lbd', $lastUpdateBy, PDO::PARAM_STR);
                    $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
                    $stmt->execute();


                    $pfn = $thisPDO->prepare("UPDATE po_financials SET curr = :cur, pmt_terms = :ptm, price_factor = :prf, freightType = :frt, 
                    freight_amt = :fra, covidAmount = :cvd, vat = :v, amtDue = :amtd, amt_paid = :amtp, grand_total = :grt
                    WHERE po_ID = :pd
                    ");
                    $pfn->bindParam('cur', $sanitizeCurr, PDO::PARAM_STR);
                    $pfn->bindParam('ptm', $sanitizeTerms, PDO::PARAM_STR);
                    $pfn->bindParam('prf', $sanitizeTpp, PDO::PARAM_STR);
                    $pfn->bindParam('frt', $sanitizeFreight_type, PDO::PARAM_STR);
                    $pfn->bindParam('fra', $sanitizeFreight_amt, PDO::PARAM_STR);
                    $pfn->bindParam('cvd', $covidAmount, PDO::PARAM_STR);
                    $pfn->bindParam('v', $vatAmount, PDO::PARAM_STR);
                    $pfn->bindParam('amtd', $sanitizeTotalAfterTax, PDO::PARAM_STR);
                    $pfn->bindParam('amtp', $sanitizeAmountPaid, PDO::PARAM_STR);
                    $pfn->bindParam('grt', $grandTotal, PDO::PARAM_STR);
                    $pfn->bindParam('pd', $po_ID, PDO::PARAM_STR);

                    $pfn->execute();

                    //delete old images
                    $delPFI     = $thisPDO->prepare("DELETE FROM pfi_images WHERE po_ID = :pd");
                    $delPFI->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delPFI->execute();

                    //delete all approvals for this Purchase Order
                    $delAPV     = $thisPDO->prepare("DELETE FROM po_approvals WHERE po_ID = :pd");
                    $delAPV->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delAPV->execute();

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


                    //delete old PO Items
                    $delPIT     = $thisPDO->prepare("DELETE FROM purchase_order_items WHERE po_ID = :pd");
                    $delPIT->bindParam("pd", $po_ID, PDO::PARAM_STR);
                    $delPIT->execute();


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

    static public function UpdateNonTaxablePurchaseOrderModel($sanitizeSupplCode, $sanitizeTerms, $sanitizeTpp, $sanitizeEts, $sanitizeEta, $sanitizeFreight_type,
                                                        $sanitizeTotal_approval, $sanitizePo_date, $sanitizePo_number, $sanitizeCurr, $sanitizeTotalAfterTax,
                                                        $sanitizeProductCode, $sanitizeItemName, $sanitizeQty, $sanitizePrice, $sanitizeTotal, $sanitizeFreight_amt,
                                                        $sanitizeAmountPaid, $sanitizeAmountDue, $sanitizePO_Details, $po_Key, $img_nm, $tbl, $folder,
                                                        $purchase_order_type, $po_ID, $lastUpdateBy)
    {
        $newPDO = new Connection();
        $thisPDO = $newPDO->Connect();

        if ($thisPDO->beginTransaction()) {

            try {
                $tdy = Date('d');
                $mnt = Date('m');
                $yr = Date('Y');
                $stmt = $thisPDO->prepare("UPDATE $tbl SET purchase_order_type = :pt, supp_ID = :sid, approval_limit = :apl, dy = :dy, mn = :mn, 
                    yr = :yr, ets = :ets, eta = :eta, sched_dt = :scd, instruction_details = :inst, lastUpdateBy = :lbd
                    WHERE po_ID = :pd");
                $stmt->bindParam('pt', $purchase_order_type, PDO::PARAM_STR);
                $stmt->bindParam('sid', $sanitizeSupplCode, PDO::PARAM_STR);
                $stmt->bindParam('apl', $sanitizeTotal_approval, PDO::PARAM_STR);
                $stmt->bindParam('dy', $tdy, PDO::PARAM_STR);
                $stmt->bindParam('mn', $mnt, PDO::PARAM_STR);
                $stmt->bindParam('yr', $yr, PDO::PARAM_STR);
                $stmt->bindParam('ets', $sanitizeEts, PDO::PARAM_STR);
                $stmt->bindParam('eta', $sanitizeEta, PDO::PARAM_STR);
                $stmt->bindParam('scd', $sanitizePo_date, PDO::PARAM_STR);
                $stmt->bindParam('scd', $sanitizePO_Details, PDO::PARAM_STR);
                $stmt->bindParam('inst', $sanitizePO_Details, PDO::PARAM_STR);
                $stmt->bindParam('lbd', $lastUpdateBy, PDO::PARAM_STR);
                $stmt->bindParam('pd', $po_ID, PDO::PARAM_STR);
                $stmt->execute();

                // save po Financial
                $pfn = $thisPDO->prepare("UPDATE po_financials SET curr = :cur, pmt_terms = :ptm, price_factor = :pft, freightType = :frt, freight_amt = :frmt, 
                amtDue = :amtd, amt_paid = :amtp, grand_total = :grt WHERE po_ID = :pid");
                $pfn->bindParam('cur', $sanitizeCurr, PDO::PARAM_STR);
                $pfn->bindParam('ptm', $sanitizeTerms, PDO::PARAM_STR);
                $pfn->bindParam('pft', $sanitizeTpp, PDO::PARAM_STR);
                $pfn->bindParam('frt', $sanitizeFreight_type, PDO::PARAM_STR);
                $pfn->bindParam('frmt', $sanitizeFreight_amt, PDO::PARAM_STR);
                $pfn->bindParam('amtd', $sanitizeTotalAfterTax, PDO::PARAM_STR);
                $pfn->bindParam('amtp', $sanitizeAmountPaid, PDO::PARAM_STR);
                $pfn->bindParam('grt', $sanitizeAmountDue, PDO::PARAM_STR);
                $pfn->bindParam('pid', $po_ID, PDO::PARAM_STR);

                $pfn->execute();

                //delete old images
                $delPFI     = $thisPDO->prepare("DELETE FROM pfi_images WHERE po_ID = :pd");
                $delPFI->bindParam("pd", $po_ID, PDO::PARAM_STR);
                $delPFI->execute();

                //delete all approvals for this Purchase Order
                $delAPV     = $thisPDO->prepare("DELETE FROM po_approvals WHERE po_ID = :pd");
                $delAPV->bindParam("pd", $po_ID, PDO::PARAM_STR);
                $delAPV->execute();

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
                $delPIT     = $thisPDO->prepare("DELETE FROM purchase_order_items WHERE po_ID = :pd");
                $delPIT->bindParam("pd", $po_ID, PDO::PARAM_STR);
                $delPIT->execute();

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
                echo $e->getMessage();
                //echo "Failed";
            }
        }
    }

}