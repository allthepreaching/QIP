<?php
include_once 'dbh-wamp.inc.php';
require_once '../vendor/autoload.php';
require_once('../fpdf/fpdf.php');
require_once('../fpdf/drawHeader.php');
require_once('../fpdf/drawFooter.php');
require_once('PHPMailer-master/src/PHPMailer.php');
require_once('PHPMailer-master/src/SMTP.php');
require_once('PHPMailer-master/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

$_SESSION['company_name'] = 'Northeast Pressure Vessel Testing';
$_SESSION['billto_name'] = 'Northeast Pressure Vessel Testing';
$_SESSION['billto_street1'] = '111 Boston Turnpike';
$_SESSION['billto_street2'] = '';
$_SESSION['billto_street3'] = '';
$_SESSION['billto_city'] = 'Westboro';
$_SESSION['billto_state'] = 'MA';
$_SESSION['billto_zip'] = '01234';
$_SESSION['billto_phone'] = '(508) 555-5555';

$_SESSION['shipto_name'] = 'Northeast Testing';
$_SESSION['shipto_street1'] = '222 Hartford Turnpike';
$_SESSION['shipto_street2'] = 'Unit 54';
$_SESSION['shipto_street3'] = 'Attn: Receiving';
$_SESSION['shipto_city'] = 'Marlboro';
$_SESSION['shipto_state'] = 'CT';
$_SESSION['shipto_zip'] = '23456';
$_SESSION['shipto_phone'] = '(202) 456-7890';

$_SESSION['customer_po'] = 'PO2023031001';
$_SESSION['order_number'] = 123456;
$_SESSION['salesperson'] = 'House';
$_SESSION['payment_terms'] = '2%10NET30';

$_SESSION['tracking'] = ['1ZW1X4056587416859456852', '1ZW1X4056577416859456852', '1ZW1X4956587416859456852'];
$_SESSION['ship_via'] = 'UPSGND';
$_SESSION['packages'] = 3;
$_SESSION['order_weight'] = 44;
$_SESSION['freight'] = 10;
$_SESSION['taxable'] = true;
$_SESSION['sub_total'] = 0;
$_SESSION['sales_tax'] = 0;
$_SESSION['order_total'] = 0;

$_SESSION['page_num'] = 1; // Initialize page number
$_SESSION['page_total'] = 1; // Initialize page number

// Check if the cart is empty
if (empty($_SESSION['cart'])) {

    // Redirect to cart page if cart is empty
    header('Location: ../cart/');
    exit();
} else {

    // Retrieve the cart items from the session
    $cart = $_SESSION['cart'];

    // Calculate the line totals
    $line_total = 0;
    foreach ($cart as $item) {
        $line_total += $item['qty'] * $item['price'];
    }

    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Get the active worksheet
    $worksheet = $spreadsheet->getActiveSheet();

    // Set the column headers
    $worksheet->setCellValue('A1', 'Product Code');
    $worksheet->setCellValue('B1', 'Quantity');
    $worksheet->setCellValue('C1', 'Price');
    $worksheet->setCellValue('D1', 'Total Price');

    // Iterate through the cart items and add them to the worksheet
    $row = 2;
    foreach ($cart as $item) {
        $worksheet->setCellValue('A' . $row, $item['code']);
        $worksheet->setCellValue('B' . $row, $item['qty']);
        $worksheet->setCellValue('C' . $row, $item['price']);
        $worksheet->setCellValue('D' . $row, $line_total);
        $row++;
    }

    // Set the directory
    if ($_SESSION['company_name'] == '') {
        $custName = $_SESSION['first_name'] . '_' . $_SESSION['last_name'];
    } else {
        $custName = $_SESSION['company_name'];
    }
    $directory = dirname(__DIR__) . '/confirmations/' . $custName . '/';
    if (!is_writable($directory)) {
        chmod($directory, 0777);
    }

    // Create the directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    // Set the filename and save the CSV file
    $filename_csv = $directory . 'Order_' . $_SESSION['order_number'] . '_' . date('Ymd') . '.csv';
    $writer = IOFactory::createWriter($spreadsheet, 'Csv');
    $writer->save($filename_csv);

    // Generate PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Loop through cart items and add to table
    $row_num = 0; // Initialize row number
    $total_rows = count($cart); // Get the total number of rows
    $max_rows = 15; // max number of rows
    $items_per_page = 15; // Maximum number of items per page
    $_SESSION['page_total'] = ceil($total_rows / $items_per_page);

    drawHeader($pdf); // Draw header

    foreach ($cart as $item) {

        // Check if the maximum number of items per page has been reached
        if ($row_num % $items_per_page == 0 && $row_num != 0) {
            $pdf->AddPage(); // Add a new PDF page
            $row_num = 0; // Reset row number
            $_SESSION['page_num']++; // Increment page number
            drawHeader($pdf); // Draw header on new page
        }

        // Check if the maximum number of items has been reached
        if ($row_num == $items_per_page) {
            break;
        }
        $line_total = $item['qty'] * $item['price'];
        $description = $item['desc'];
        $description_width = 100;
        $description_lines = substr_count(wordwrap($description, $description_width), "\n") + 1;
        $description_height = $description_lines * 5; // 5 is the default height of each line

        $y_position = $pdf->GetY(); // Save the current Y position to reset it later

        // Set fill for every other row
        if ($row_num % 2 == 0) {
            $pdf->SetFillColor(255, 255, 255);
        } else {
            $pdf->SetFillColor(249, 250, 224);
        }

        // Set top border for first row
        if ($row_num == 0) {
            $border = 'LTR';
        } else {
            $border = 'LR';
        }

        // Set bottom border for last row
        if ($row_num >= $max_rows - 1) {
            $border .= 'LRB';
        }

        // Get the Y position of the multicell and set the cell height to match it
        $description_y_position = $pdf->GetY();
        $pdf->SetXY(10, $description_y_position);
        $pdf->MultiCell(100, 5, $description, $border, 'J', true);
        $cell_height = $pdf->GetY() - $description_y_position;

        // Reset the Y position to the original value
        $pdf->SetXY(110, $y_position);
        $pdf->Cell(30, $cell_height, $item['code'], $border, 0, 'C', true);
        $pdf->SetXY(140, $pdf->GetY());
        $pdf->Cell(20, $cell_height, $item['qty'], $border, 0, 'C', true);
        $pdf->SetXY(160, $pdf->GetY());
        $pdf->Cell(20, $cell_height, number_format($item['price'], 2), $border, 0, 'C', true);
        $pdf->SetXY(180, $pdf->GetY());
        $pdf->Cell(20, $cell_height, number_format($line_total, 2), $border, 1, 'C', true);

        $row_num++; // Increment row number
        $_SESSION['sub_total'] += $line_total;
    }
    if (!$_SESSION['taxable'] === true) {
        $_SESSION['sales_tax'] = 0;
    } else {
        $_SESSION['sales_tax'] = $_SESSION['sub_total'] * 0.0625;
    }
    $_SESSION['order_total'] = ($_SESSION['sub_total'] + $_SESSION['sales_tax'] + $_SESSION['freight']);

    drawFooter($pdf); // Add table footer rows

    // Set the directory and filename for the PDF file
    $filename_pdf = $directory . 'Order_' . $_SESSION['order_number'] . date('Ymd') . '.pdf';

    // Create the directory if it doesn't exist
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true);
    }

    $pdf->Output('F', $filename_pdf); // Save the PDF to the specified directory and filename

    // Send email to qip
    $to = 'nickbetti@gmail.com';
    $from = 'weborders@qualityindustrialproducts.com';
    $subject = 'New Web Order - #' . $_SESSION['order_number'] . ' ' . $custName . ' P.O. #' . $_SESSION['customer_po'];
    $message = 'Please find new order attached.';
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    // SSL/TLS configuration
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587;
    $smtp_username = 'phynalcams@gmail.com';
    $smtp_password = 'gttufdxzadqylchn';

    // Set the mailer settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;

    // Set the message
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->isHTML(true);

    // Add attachment
    $mail->addAttachment($filename_csv, 'Order_' . $_SESSION['order_number']);

    // Send the email
    if ($mail->send()) {
        echo "Email sent successfully to $to";
    } else {
        echo "Failed to send email to $to";
    }

    // Send email to user
    $to = $_SESSION['email'];
    $from = 'weborders@qualityindustrialproducts.com';
    if ($_SESSION['customer_po'] == '') {
        $subject = 'Your Order Confirmation - #' . $_SESSION['order_number'];
    } else {
        $subject = 'Your Order Confirmation - #' . $_SESSION['order_number'] . ' P.O. #' . $_SESSION['customer_po'];
    }
    $message = 'Please find your order confirmation attached.';
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n";

    // SSL/TLS configuration
    $smtp_host = 'smtp.gmail.com';
    $smtp_port = 587;
    $smtp_username = 'phynalcams@gmail.com';
    $smtp_password = 'gttufdxzadqylchn';

    // Set the mailer settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;

    // Set the message
    $mail->setFrom($from);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->isHTML(true);

    // Add attachment
    $mail->addAttachment($filename_pdf, 'Order_' . $_SESSION['order_number']);

    // Send the email
    if ($mail->send()) {
        echo "Email sent successfully to $to";
    } else {
        echo "Failed to send email to $to";
    }

    // Clear the cart
    $_SESSION['cart'] = array();

    // Redirect to thank you page
    header('Location: ../thankyou-cart/');
    exit();
}
