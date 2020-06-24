<?php

function getIndianCurrency($number) {
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
        } else {
            $str[] = null;
        }
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return $Rupees . $paise;
}

tcpdf();

$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Order Invoice";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$obj_pdf->AddPage();
$obj_pdf->setJPEGQuality(75);
ob_start();
$html = '
<table width="100%" border="1" cellpadding="4">
    <tr style="border-bottom: 1px solid black">
        <td style="text-align: left; border-right: 1px solid black">
          
            NAME:' . $user['user_name'] . '<br>
            E-MAIL:' . $user['email'] . '<br>
            Phone:' . $user['phone_number'] . '<br>
        </td>
        <td>
            <table width="100%" cellpadding="1">
                <tr border="1" style="border-bottom: 1px solid black">
                    <td style="width: 50%; border-right: 1px solid black"><b>Booking Id:</b> ' . $bookingDetails['booking_id'] . '</td>
                    <td> <b> Service Date: </b> ' . $bookingDetails['service_date'] . '</td>
                </tr><br>
                <tr>
                    <td style="text-align: left"><b>Mode/Terms of Payment:</b>  </td>
                    <td>' . $bookingDetails['order_type'] . '</td>
                </tr>    
            </table>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid black">
        <td style="text-align: left">
            Billing Details:<br>
            <b>' . $bookingDetails['user_name'] . '</b><br>
            ';

    $html .= $bookingDetails['address_line_1'] . ',' . $bookingDetails['address_line_2'] . '-' . $bookingDetails['zipcode'] . '<br>
                    ';
$html .= '

            Phone: ' . $order['country_code'] . $user['phone_number'] . '<br>
            
        </td>
        <td>
            <table width="100%">
                <tr>
                    <td colspan="2" style="text-align: left"><b>Destination </b>' . $bookingDetails['state'] .','.$bookingDetails['city']. '</td>
                </tr> 
            </table>
        </td>
    </tr>
</table>
<br>
<table width="100%" border="1" cellpadding="4">
    <tr>
        <th>SI No.</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Rate</th>
    </tr>';
$i = 1;
$quantity = 0;
$total = 0;
foreach ($services as $service) {
    // $quantity += $unique_order_details['qty'];
//    $sub_total = $booking_order_details['quantity'] * $booking_order_details['price'];
//     $total += $sub_total;
    $html .= '
        <tr>
            <td>' . $i . '</td>
            <td><b>' . $service['service_title'] . '</b></td>
            <td><b>' . $service['quantity'] . '</b></td>    
            <td><b><span style="font-family:dejavusans;">&#8377;</span>' . number_format($service['price'],2) . '</b></td>
            
        </tr>';
    $i++;
}






$html .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Sub Total</b></td>
            <td><b> <span style="font-family:dejavusans;">&#8377;</span>' .number_format($bookingDetails['total_amount'], 2) . '</b></td>
        </tr>';

$html .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Convenience Charge</b></td>
            <td><b><span style="font-family:dejavusans;">&#8377;</span>' . number_format(round($bookingDetails['convenience_charge'], 2)) . '</b></td>
        </tr>';

$html .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Service Tax</b></td>
            <td><b><span style="font-family:dejavusans;">&#8377;</span>' . number_format(round($bookingDetails['service_tax'], 2)) . '</b></td>
        </tr>';
$html .= '
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total Amount</b></td>
            <td><b><span style="font-family:dejavusans;">&#8377;</span> ' . number_format(round($bookingDetails['payable_amount'], 2)) . '</b></td>
        </tr>';

$html .= '
    </table> <BR><BR>';
ob_end_clean();
$obj_pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$obj_pdf->Output('Ondemand_' . $bookingDetails['booking_id'] . 'pdf', 'I');
