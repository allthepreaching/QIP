<?php

function drawFooter($pdf)
{

    $pdf->SetLineWidth(.5);

    $pdf->SetFont('Arial', '', 10);

    $pdf->Cell(150, 5, '', 'T', 0);
    $pdf->Cell(20, 5, 'Sub Total: ', 'TL', 0, 'J');
    $pdf->Cell(20, 5, number_format($_SESSION['sub_total'], 2), 'TR', 1, 'R');
    $pdf->Cell(150, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'Sales Tax: ', 'TL', 0, 'J');
    $pdf->Cell(20, 5, number_format($_SESSION['sales_tax'], 2), 'TR', 1, 'R');
    $pdf->Cell(150, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'Freight: ', 'TL', 0, 'J');
    $pdf->Cell(20, 5, number_format($_SESSION['freight'], 2), 'TR', 1, 'R');

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(255, 255, 0);

    $pdf->Cell(150, 5, '', 0, 0);
    $pdf->Cell(20, 5, 'Total: ', 'LTB', 0, 'J', true);
    $pdf->Cell(20, 5, number_format($_SESSION['order_total'], 2), 'RTB', 1, 'R', true);

    $pdf->SetLineWidth(.2);

    //tracking ship via weights
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(153, 180, 201);

    // Print header row
    $pdf->Cell(80, 5, 'Tracking Number', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Ship Via', 1, 0, 'C', true);
    $pdf->Cell(20, 5, '# Pkgs', 1, 0, 'C', true);
    $pdf->Cell(20, 5, 'Weight', 1, 0, 'C', true);
    $pdf->Cell(50, 5, 'Payment Terms', 1, 1, 'C', true);

    // Print data rows
    foreach ($_SESSION['tracking'] as $tracking_number) {
        $pdf->Cell(80, 5, $tracking_number, 1, 0, 'C');
        if ($tracking_number === $_SESSION['tracking'][0]) {

            // Print ship via, packages, and weight only in the first row
            $pdf->Cell(20, 5, $_SESSION['ship_via'], 1, 0, 'C');
            $pdf->Cell(20, 5, $_SESSION['packages'], 1, 0, 'C');
            $pdf->Cell(20, 5, $_SESSION['order_weight'], 1, 0, 'C');
            $pdf->Cell(50, 5, $_SESSION['payment_terms'], 1, 1, 'C');
        } else {

            // For all other rows, leave ship via, packages, and weight cells empty
            $pdf->Cell(20, 5, '', 1, 0, 'C');
            $pdf->Cell(20, 5, '', 1, 0, 'C');
            $pdf->Cell(20, 5, '', 1, 0, 'C');
            $pdf->Cell(50, 5, '', 1, 1, 'C');
        }
    }
}
