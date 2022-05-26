<?php
session_start();
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require '../mailings/src/Exception.php';
require '../mailings/src/PHPMailer.php';
require '../mailings/src/SMTP.php';

class SendPOToSupplierCtrl
{
    static public function emailPOToSupplier(){
        $getToken   = trim($_POST['tkn']);
        if (isset($_SESSION['emailPOToken'] ) && $_SESSION['emailPOToken']  == $getToken) {
            require_once '../../controller/purchases/SupportEmailThisPO.php';

            $po_ID          = $_POST['po_ID'];
            $emailSubject   = trim($_POST['emailSubject']);
            $emailBody      = trim($_POST['emailBody']);
            $supp_email     = $_POST['supplier_email'];

            $getPOItems = SupportEmailThisPO::supportThisApprovedPOToEmail($po_ID);
            $fetchPOItems = $getPOItems->fetchAll();

            $fetchAssocPO = SupportEmailThisPO::supportThisApprovedPOToEmail($po_ID);
            $fetchThis = $fetchAssocPO->fetch(PDO::FETCH_ASSOC);
            $po_num = $fetchThis['po_num'];
            $supp_name = $fetchThis['supp_name'];
            $supplierAddress1 = $fetchThis['address1'];
            //$supp_email = $_POST['supplier_email'];
            $supp_phone = $fetchThis['supp_phone'];

            require_once 'PODetailsForEmail.php';
            $callPO = PODetailsForEmail::detailPO($po_ID);
            $pdt = $callPO->fetch(PDO::FETCH_ASSOC);

            $po_type = '';
            $this_po_type = $pdt['purchase_order_type'];

            switch ($this_po_type) {
                case 1:
                    $po_type .= 'Taxable PO';
                    break;

                case 2:
                    $po_type .= 'Non-Taxable PO';
                    break;
            }

// for taxes
            require_once '../purchases/PODetailsForEmail.php';
//individual tax
            $vat = PODetailsForEmail::doCallVAT();
            $vtx = $vat->fetch(PDO::FETCH_ASSOC);
            $vatPercent = $vtx['tax_percent'] / 100;

            $nhl = PODetailsForEmail::doCallNHIL();
            $nhx = $nhl->fetch(PDO::FETCH_ASSOC);
            $nhxPercent = $nhx['tax_percent'] / 100;

            $gtfn = PODetailsForEmail::doCallGetFund();
            $gfx = $gtfn->fetch(PDO::FETCH_ASSOC);
            $gfxPercent = $gfx['tax_percent'] / 100;

            require_once '../../view/assets/tcpdf/tcpdf.php';

// create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Rails ERP');
            $pdf->SetTitle('Purchase Order');
            $pdf->SetSubject('Purchase Order');
            $pdf->SetKeywords('Purchase Order, Rails ERP');


            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' ', PDF_HEADER_STRING, array(0, 7, 24), array(0, 64, 128));
            $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
            $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }

            $pdf->setFontSubsetting(true);


            $pdf->SetFont('dejavusans', '', 14, '', true);


            $pdf->AddPage('P');

// set text shadow effect
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

            $output = "";
            $output .= '<div class="row" style="padding: 10px; margin-bottom: 15px;">
    <div class="col-md-12">
        <h5 style="font-weight: bold">PO No.: ' . $po_num . '</h5>
        <h5>Currency: ' . ($pdt["curr"]) . '</h5>
        
        <hr />
        <h5 style="text-transform: uppercase;">Supplier</h5><p>' . $supp_name . '
        <br />
        ' . $supplierAddress1 . '
        <br />
        ' . $supp_phone . '
        <br />
        ' . $supp_email . '
        
        </p>
        <table class="table table-striped table-no-bordered table-hover thisTable"
                               style="width:100%; border: #666666; #fff0b3 solid thin 1px; padding: 5px; text-align: center;" border="2">
                            <thead class="thead-dark">
                            <tr style="border-bottom: #0f6674 solid 5px; font-size: small;">
                                <th>ITEM</th>
                                <th>QUANTITY</th>
                                <th>UNIT PRICE</th>
                                <th>TOTAL</th>
                                
                            </tr>
                            </thead>

                            <tbody>
                            ';
            foreach ($fetchPOItems as $mt) {
                $output .= '<tr style="border-right-color:#666; border-weight:thin; border-right-width:1px; font-size: small">
                                   
                                    <td>' . $mt["inventory_name"] . '</td>
                                    <td>' . $mt["orij_qty"] . '</td>
                                    <td>' . $mt["unit_price"] . '</td>
                                    <td>' . $mt["sub_total"] . '</td>
                                   </tr>
                                   ';
            }
            $output .= '
</table>
<p></p>

<table class="table table-striped table-no-bordered table-hover thisTable"
                               style="width:100%; text-align: center; padding: 5px;">
<tr>
<td colspan="2"></td>
<td style="text-align: left">Sub Total</td>
<td style="border: #666666 1px solid;">' . number_format($pdt["amtDue"], 4) . '</td>
</tr>
<tr>
                <td colspan="2"></td>
                <td style="text-align: left">Freight Amount</td>
               
                <td>' . number_format($pdt["freight_amt"], 4) . '</td>
            </tr>
            
            

';


//show if PO is local PO

            if ($this_po_type == 1) {

                $output .= '<tr>
<td colspan="2"></td>
<td style="text-align: left">NHIL (' . $nhx["tax_percent"] . '%)</td>
<td>' . $pdt["nhil"] . '</td>
</tr>
<tr>
<td colspan="2"></td>
<td style="text-align: left">GetFund (' . $gfx["tax_percent"] . '%)</td>
<td>' . $pdt["getFund"] . '</td>
</tr>

            <tr>
            <td colspan="2"></td>
                <td style="text-align: left"><span style="font-weight: bolder;">Sub Total</span></td>
                <td>
                   
                    ' . $pdt["before_vat"] . '
                </td>
            </tr>

            <tr>
            <td colspan="2"></td>
                <td style="text-align: left">VAT ( ' . $vtx["tax_percent"] . '%)</td>
                <td>' . number_format($pdt["vat"], 4) . '</td>
            </tr>


            <tr>
                <td colspan="2"></td>
                <td style="text-align: left"><span style="font-weight: bolder;">Grand Total</span></td>
                <td><span style="font-weight: bolder;">' . number_format($pdt["grand_total"] + $pdt["freight_amt"], 4) . '</span></td>
            </tr>
            ';
            } else {

                $output .= '     
            <tr>
            <td colspan="2"></td>
                <td style="text-align: left"><span style="font-weight: bolder;">Grand Total</span></td>
                <td>' . number_format($pdt["grand_total"], 2) . '</td>
            </tr>
            ';

            }
            $output .= '     
        </table>
    </div>
';

// Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $output, 0, 1, 0, true, '', true);

            $attach_pdf = $pdf->Output('purchase_order.pdf', 'S');
            if ($attach_pdf) {
                $mail = new PHPMailer\PHPMailer;                          // Passing `true` enables exceptions
                //try {
                //Server settings
                $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = "mail.bahrimainfosystems.com ";
                //$mail->Host = gethostbyname('smtp.gmail.com');  	  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = "routemail@bahrimainfosystems.com";              // SMTP username
                $mail->Password = "vb~-fBp*^qffZYL2}E";             // SMTP password
                $mail->SMTPSecure = "ssl";                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                   // TCP port to connect to


                //Recipients
                $mail->setFrom('routemail@bahrimainfosystems.com', '');
                $mail->addAddress($supp_email);
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                $mail->AddStringAttachment($attach_pdf, 'purchase_order.pdf');        // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);   // Set email format to HTML
                $mail->Subject = $emailSubject;
                $mail->Body = $emailBody;
                $mail->AltBody = $emailBody;

                if ($mail->send()) {
                    echo 'Purchase Order Emailed Successfully';
                } else {
                    echo '<span style="color: #ffffff;">Purchase Order Could not be Sent. Please contact System Admin</span>';
                }

            }
        }
        else{
            echo "<span style='color: #ffffff;'>Action Not Permitted</span>";
        }
    }
}
$callClass  = new SendPOToSupplierCtrl;
$callMethod = $callClass->emailPOToSupplier();