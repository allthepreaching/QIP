<?php

session_start();

function drawHeader($pdf)
{
    $pdf->Image('../images/qip/header-logo-512.png', 10, 20, 20, 20);

    // Company & order information
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(20, 10, '', 0, 0);
    $pdf->Cell(68, 10, 'Quality Industrial Products', 0, 0);

    $pdf->SetFont('Arial', 'B', 17);

    $pdf->Cell(30, 10, '', 0, 0);
    $pdf->Cell(72, 10, 'ORDER CONFIRMATION', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(68, 5, '276 Boston Turnpike', 0, 0);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(153, 180, 201);

    $pdf->Cell(30, 5, '', 0, 0);
    $pdf->Cell(24, 5, 'DATE', 1, 0, 'C', true);
    $pdf->Cell(24, 5, 'ORDER NO.', 1, 0, 'C', true);
    $pdf->Cell(24, 5, 'PAGE', 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255, 255, 255);

    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(68, 5, 'Shrewsbury MA 01545', 0, 0);
    $pdf->Cell(30, 5, '', 0, 0);
    $pdf->Cell(24, 5, $_SESSION['order_date'], 1, 0, 'C');
    $pdf->Cell(24, 5, $_SESSION['order_number'], 1, 0, 'C');
    $pdf->Cell(24, 5, 'Page ' . $_SESSION['page_num'] . ' of ' . $_SESSION['page_total'], 1, 1, 'C');
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(68, 5, 'P: (508) 845-2935', 0, 1);
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(68, 5, 'F: (508) 845-2937', 0, 1);
    $pdf->Cell(20, 5, '', 0, 0);
    $pdf->Cell(68, 5, 'E: custserv@qualityindustrialproducts.com', 0, 1);

    //create space below company info
    $pdf->Ln(5);

    // customer information
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(90, 5, 'Bill To:', 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, 'Ship To:', 0, 1);

    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(90, 5, $_SESSION['billto_name'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_name'], 0, 1);
    $pdf->Cell(90, 5, $_SESSION['billto_street1'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_street1'], 0, 1);
    $pdf->Cell(90, 5, $_SESSION['billto_street2'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_street2'], 0, 1);
    $pdf->Cell(90, 5, $_SESSION['billto_street3'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_street3'], 0, 1);
    $pdf->Cell(90, 5, $_SESSION['billto_city'] . ', ' . $_SESSION['billto_state'] . ' ' . $_SESSION['billto_zip'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_city'] . ', ' . $_SESSION['shipto_state'] . ' ' . $_SESSION['shipto_zip'], 0, 1);
    $pdf->Cell(90, 5, $_SESSION['billto_phone'], 0, 0);
    $pdf->Cell(10, 5, '', 0, 0);
    $pdf->Cell(90, 5, $_SESSION['shipto_phone'], 0, 1);

    // set distance from page header and table header
    $pdf->Ln(5);

    // Add a table header rows
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(249, 250, 224);

    $pdf->Cell(60, 5, 'Customer P.O. #', 1, 0, 'C', true);
    $pdf->Cell(30, 5, 'Order Date', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Order #', 1, 0, 'C', true);
    $pdf->Cell(30, 5, 'Salesperson', 1, 0, 'C', true);
    $pdf->Cell(50, 5, 'Payment Terms', 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetFillColor(255, 255, 225);

    $pdf->Cell(60, 5, $_SESSION['customer_po'], 1, 0, 'C');
    $pdf->Cell(30, 5, $_SESSION['order_date'], 1, 0, 'C');
    $pdf->Cell(20, 5, $_SESSION['order_number'], 1, 0, 'C');
    $pdf->Cell(30, 5, $_SESSION['salesperson'], 1, 0, 'C');
    $pdf->Cell(50, 5, $_SESSION['payment_terms'], 1, 1, 'C');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(153, 180, 201);

    $pdf->Cell(100, 5, 'Description', 1, 0, 'C', true);
    $pdf->Cell(30, 5, 'Product Code', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Quantity', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Price', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Ext Price', 1, 1, 'C', true);

    $pdf->SetFont('Arial', '', 10);
}
